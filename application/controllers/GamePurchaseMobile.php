<?php
class GamePurchaseMobile extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("Authentication");
        $this->load->library("Indomogapi");
        $this->load->library('email');

        $this->load->model('User_model');
        $this->load->model('GameCategory_model');
        $this->load->model('SGameCategory_model');
        $this->load->model('SPublisher_model');
        $this->load->model('SGame_model');
        $this->load->model('TGamePurchase_model');
        $this->load->model('SAccount_model');
    }

    function getGameCategoryData($start=1){
        $data = $this->GameCategory_model->getGameCategoryList(null, null);
        echo json_encode($data);
    }

    function getPublisherData($gameCategory){
        $data = $this->SGameCategory_model->getPublisherListByCategory($gameCategory);
        echo json_encode($data);
    }
    function getGameData($publisher){
        //$publisher_id = $this->input->post('id');
        $data = $this->SPublisher_model->getGameListByPublisher($publisher);
        echo json_encode($data);
    }
    function getNominalData($game,$username){
        //$game_id = $this->input->post('id');
        $data = "";

        $user = $this->User_model->getUserLevelbyUsername($username);
        if($this->authentication->isAuthorizeAgent($user->userLevel)){
            $data = $this->SGame_model->getGameListByPublisher($game, true);
        }else if($this->authentication->isAuthorizeMember($user->userLevel)){
            $data = $this->SGame_model->getGameListByPublisher($game, false);
        }
        echo json_encode($data);
    }
	
    function buyGame()
    {
        $status = '';
        $msg = "";
        $prefixID = "Test";
        $datetime = date('Y-m-d H:i:s', time());
        $settingID = $this->input->post('settingID');
		$userID = $this->input->post('userID');
//        $settingID = $param1;
//		$userID = $param2;
        $data_game = $this->SGame_model->getGameDetail($settingID);       
        $account = $this->SAccount_model->getMyAccount($userID);

        // Coin Agent or Member
        $user_level = $account->userLevel;
        if ($user_level == "member") {
            $coin_payment = $data_game->paymentValue;
        } else {
            $coin_payment = $data_game->agentValue;
        }

        //Check Data Publisher Game
        if ($data_game != null) {
            // Check coin for purchasing Game
            if ($coin_payment > $account->coin) {
                $status = 'error';
                $msg = "Not enough coin to buy this games !";
            } else {
                $this->db->trans_begin();
                $data_transaction = array(
                    'publisherName' => $data_game->publisherName,
                    'prefixCode' => $prefixID,
                    'gameName' => $data_game->gameName,
                    'currency' => $data_game->currency,
                    'nominalName' => $data_game->nominalName,
                    'productCode' => $data_game->productCode,
                    'paymentValue' => $data_game->paymentValue,
                    'coin' => $account->coin,
                    'userLevel' => $user_level,
                    'isActive' => 1,
                    "created" => $datetime,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                //TEMP Save Trasaction Game Purchase
                $transaction_id = $this->TGamePurchase_model->createTransactionGamePurchase($data_transaction);

                //Check when save transaction
                if ($transaction_id != null || $transaction_id != "") {
                    // Substarct Coin
                    $coin_subtraction = $this->SAccount_model->subtractionCoin($userID, $coin_payment);
                    //Check when save coin subtraction
                    if ($coin_subtraction != 1) {
                        $status = 'error';
                        $msg = "Purchasing fail, please try again! ".$coin_payment;
                        $this->db->trans_rollback();
                    } else {
                        //SENDING TO INDOMOG API
                        $generateID = $prefixID.$transaction_id;
                        $email = $account->email;
                        $prodId = $data_game->productCode;
                        $return_code = $this->indomogapi->sendIndomog($generateID, $prodId);

                        if ($return_code == '000') {
                            $voucher =  $data_game->currency." ".number_format($data_game->nominalName,0,",",".");
                            $send_email = $this->sendEmailToppon($generateID, $coin_payment, $account->name,$email,
                                $data_game->gameName, $voucher);
                            if (!$send_email) {
                                $this->indomogapi->cancelPurchaseGame($generateID);
                                $status = 'error';
                                $msg = "Purchasing fail, please try again!";
                                $this->db->trans_rollback();
                            } else {
                                $status = 'success';
                                $msg = "Game Purchase Success !";
                                $this->db->trans_commit();
                            }

                        } else {
                            $status = 'error';
                            $msg = "Purchasing fail, please try again!";
                            $this->db->trans_rollback();
                        }
                    }

                } else {
                    $status = 'error';
                    $msg = "Purchasing fail, please try again!";
                    $this->db->trans_rollback();
                }
            }

        }
		echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function sendEmailToppon($generateID,$coin_payment,$name,$email, $gameName, $voucher){
        $data_email = $this->indomogapi->getRequestPurchaseGame($generateID,$coin_payment);

        $data['data_api'] = $data_email;
        $data['title'] = "TOPPON - Bukti Pembelian Game";
        $data['name'] = $name;
        $data['game_name'] = $gameName;
        $data['voucher'] = $voucher;
        $data['content'] = "email/game_purchase_email_view";
        $message = $this->load->view("email/template_view",$data,true);

        $config = Array
        (
            'protocol' => 'mail',
            'smtp_host' => 'toppon.co.id',
            'smtp_port' => 25,
            'smtp_user' => 'no-reply@toppon.co.id',
            'smtp_pass' => 'Pass@word1',
            'mailtype'  => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('no-reply@toppon.co.id', 'Feedback System'); // nanti diganti dengan email sistem toppon
        $this->email->to($email); // email user

        $this->email->subject('[TOPPON] TOP UP GAME PURCHASE');
        $this->email->message($message);

        if($this->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


}
?>