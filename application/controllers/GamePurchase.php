<?php
class GamePurchase extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $this->load->model('User_model');
        $this->load->model('GamePurchase_model');
        $this->load->model('TGamePurchase_model');
        $this->load->model('SAccount_model');
    }

    function index(){
        if(!$this->session->userdata('logged_in')){
            $this->loginAndRegister();
        }
        else{
            $this->dashboard();
        }
    }

    function dashboard(){
        if(!$this->session->userdata('logged_in')){
            redirect($this->loginAndRegister());
        }
        else{
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['account'] = $this->SAccount_model->getMyAccount($userID);
            $data['game_list'] = $this->GamePurchase_model->getGameList();
            $data['data_content']="member/games_purchase_view";
            $this->load->view('includes/member_area_template_view',$data);
        }
    }

    function buyGames(){

        $status = '';
        $msg = "";
        $datetime = date('Y-m-d H:i:s', time());
        $id=$this->input->post('id');
        $data_game = $this->GamePurchase_model->getGameByID($id);
        $userID = $this->session->userdata('user_id');
        $account = $this->SAccount_model->getMyAccount($userID);

        //Check Data Publisher Game
        if($data_game != null){
            // Check coin for purchasing Game
            if($data_game->paymentValue > $account->coin){
                $status = 'error';
                $msg = "Not enough coin to buy this games !";
            }else{
                $this->db->trans_begin();
                $data_transaction=array(
                    'publisherName'=>$data_game->publisherName,
                    'nominalName'=>$data_game->nominalName,
                    'paymentValue'=>$data_game->paymentValue,
                    'coin'=>$account->coin,
                    'isActive'=>1,
                    "created" => $datetime,
                    "createdBy" => $userID,
                    "lastUpdated"=>$datetime,
                    "lastUpdatedBy"=>$userID
                );
                $transaction_id = $this->TGamePurchase_model->createTransactionGamePurchase($data_transaction);

                //Check when save transaction
                if($transaction_id != null || $transaction_id!=""){
                    $coin_subtraction = $this->SAccount_model->subtractionCoin($userID, $data_game->paymentValue );
                    //Check when save coin subtraction
                    if($coin_subtraction != 1){
                        $status = 'error';
                        $msg = "Purchasing fail, please try again!";
                        $this->db->trans_rollback();
                    }else{
                        $status = 'success';
                        $msg = "Purchasing success!";
                        $this->db->trans_commit();
                    }

                }else{
                    $status = 'error';
                    $msg = "Purchasing fail, please try again!";
                    $this->db->trans_rollback();
                }
            }

        }else{
            $status = 'error';
            $msg = "This game is not valid !";
        }

        // return message to AJAX
        echo json_encode(array('status' => $status, 'msg' => $msg));

    }

    function loginAndRegister($errorParam = null, $whereAt = null){
        if(!$this->session->userdata('logged_in')){
            if($errorParam == null){
                $data['error_param']="";
                $data['where_at']="";
                $this->load->view('login_view', $data);
            }
            else{
                $data['error_param']=$errorParam;
                $data['where_at']=$whereAt;
                $this->load->view('login_view', $data);
            }
        }
        else{
            redirect($this->dashboard());
        }
    }

}
?>