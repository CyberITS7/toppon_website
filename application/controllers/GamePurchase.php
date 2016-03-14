<?php
class GamePurchase extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->library("Authentication");

        $this->load->model('User_model');
        $this->load->model('SGameCategory_model');
        $this->load->model('SGame_model');
        $this->load->model('GamePurchase_model');
        $this->load->model('TGamePurchase_model');
        $this->load->model('SAccount_model');
    }

    function index($id){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeMember($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }
        else{
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['categoryId']=$id;
            $data['account'] = $this->SAccount_model->getMyAccount($userID);
            $data['publisher_list'] = $this->SGameCategory_model->getPublisherListByCategory($id);
            $data['data_content']="member/games_purchase_view";
            $this->load->view('includes/member_area_template_view',$data);
        }
    }

    function buyGames(){

        $status = '';
        $msg = "";
        $prefixID = "TOPPON";
        $datetime = date('Y-m-d H:i:s', time());
        $id=$this->input->post('id');
        $data_game = $this->SGame_model->getGameDetail($id);
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
                    'prefixCode'=>$prefixID,
                    'gameName'=>$data_game->gameName,
                    'nominalName'=>$data_game->nominalName,
                    'productCode'=>$data_game->productCode,
                    'paymentValue'=>$data_game->paymentValue,
                    'coin'=>$account->coin,
                    'isActive'=>1,
                    "created" => $datetime,
                    "createdBy" => $userID,
                    "lastUpdated"=>$datetime,
                    "lastUpdatedBy"=>$userID
                );
                //TEMP Save Trasaction Game Purchase
                $transaction_id = $this->TGamePurchase_model->createTransactionGamePurchase($data_transaction);

                //Check when save transaction
                if($transaction_id != null || $transaction_id!=""){

                    $coin_subtraction = $this->SAccount_model->subtractionCoin($userID, $data_game->paymentValue);
                    //Check when save coin subtraction
                    if($coin_subtraction != 1){
                        $status = 'error';
                        $msg = "Purchasing fail, please try again!";
                        $this->db->trans_rollback();
                    }else{
                        //SENDING TO INDOMOG API
                        $generateID = $prefixID.$transaction_id;
                        $email = $account->email;
                        $prodId = $data_game->productCode;
                        $return_code = $this->sendIndomog($generateID,$email,$prodId);
                        if($return_code == '000'){
                            $status = 'success';
                            $msg = "Purchasing success! ";
                            $this->db->trans_commit();
                        }else{
                            $status = 'error';
                            $msg = "Purchasing fail, please try again! ";
                            $this->db->trans_rollback();
                        }
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

    function sendIndomog($qid, $email, $proId){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeMember($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }
        else{
        //SET DATA
        $vsRMID = '0910403545';
        $vsQID= $qid;
        $vsRC='5003';
        $vsIPD= '192.168.63.2';
        $vsEmailHP= $email;
        $vsProdID = $proId;
        $vsQty='1';
        $vsSecret='123456';

        $date = new DateTime();
        $now = date_format($date,"Ymd\TH:i:s");
        $gateway = "http://dev.indomog.com/indomog2/new_core/index.php/h2h_rpc/server";

        // mid.qid.reqc.ipd.emailhp.prodid.qty.prodaccid.prodbillid.remark.now
        $data= $vsRMID.$vsQID.$vsRC.$vsIPD.$vsEmailHP.$vsProdID.$vsQty.$now;
        $vsSignature = sha1($data.$vsSecret);

        //$vsSignature= '6b3d5f6912b1c63494f09302f826528377899de8';
    //Create xml request
        $req = '
        <methodCall>
          <methodName>Shop</methodName>
          <params>
            <param>
              <value>
                <struct>
                  <member>
                    <name>RMID</name>
                    <value>
                      <string>'.$vsRMID.'</string>
                    </value>
                  </member>
                  <member>
                    <name>QID</name>
                    <value>
                      <string>'.$vsQID.'</string>
                    </value>
                  </member>
                  <member>
                    <name>RC</name>
                    <value>
                      <string>'.$vsRC.'</string>
                    </value>
                  </member>
                  <member>
                    <name>IPD</name>
                    <value>
                      <string>'.$vsIPD.'</string>
                    </value>
                  </member>
                  <member>
                    <name>EmailHP</name>
                    <value>
                      <string>'.$vsEmailHP.'</string>
                    </value>
                  </member>
                  <member>
                    <name>ProdID</name>
                    <value>
                      <string>'.$vsProdID.'</string>
                    </value>
                  </member>
                  <member>
                    <name>Qty</name>
                    <value>
                      <string>1</string>
                    </value>
                  </member>
                  <member>
                    <name>ProdAccID</name>
                    <value><string></string></value>
                    </member>
                <member>
                <name>ProdBillID</name>
                <value><string></string></value>
                </member>
                  <member>
                    <name>Remark</name>
                    <value>
                      <string></string>
                    </value>
                  </member>
                  <member>
                    <name>Now</name>
                    <value>
                      <datetime.iso8601>'.$now.'</datetime.iso8601>
                    </value>
                  </member>
                  <member>
                    <name>Signature</name>
                    <value>
                      <string>'.$vsSignature.'</string>
                    </value>
                  </member>
                </struct>
              </value>
            </param>
          </params>
        </methodCall>';

        //Send XML request with curl
            $ch = curl_init();

            curl_setopt($ch,CURLOPT_URL,$gateway);
            curl_setopt($ch,CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$req);

            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);

            $result = curl_exec($ch); //get the response

            if(curl_errno($ch)) {
                print "Error: " . curl_error($ch);
            } else {
                curl_close($ch);
            }

            //echo htmlentities($result);

        $xml = simplexml_load_string($result);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        //Return Message From IndoMog API
        return $this->checkGamePurchase($array);
        }
    }

    function checkGamePurchase($result){
        $return = "empty";
        //echo $array['params']['param']['value']['struct']['member'][1]['name'];
        foreach($result['params']['param']['value']['struct']['member'] as $row){
            if($row['name'] == 'RspCode'){
                $return = $row['value']['string'] ;
            }
        }
        return $return;
    }

    // Function to get the client ip address
    function get_real_ip() {
        $clientip      = isset( $_SERVER['HTTP_CLIENT_IP'] )       && $_SERVER['HTTP_CLIENT_IP']       ?
            $_SERVER['HTTP_CLIENT_IP']         : false;
        $xforwarderfor = isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && $_SERVER['HTTP_X_FORWARDED_FOR'] ?
            $_SERVER['HTTP_X_FORWARDED_FOR']   : false;
        $xforwarded    = isset( $_SERVER['HTTP_X_FORWARDED'] )     && $_SERVER['HTTP_X_FORWARDED']     ?
            $_SERVER['HTTP_X_FORWARDED']       : false;
        $forwardedfor  = isset( $_SERVER['HTTP_FORWARDED_FOR'] )   && $_SERVER['HTTP_FORWARDED_FOR']   ?
            $_SERVER['HTTP_FORWARDED_FOR']     : false;
        $forwarded     = isset( $_SERVER['HTTP_FORWARDED'] )       && $_SERVER['HTTP_FORWARDED']       ?
            $_SERVER['HTTP_FORWARDED']         : false;
        $remoteadd     = isset( $_SERVER['REMOTE_ADDR'] )          && $_SERVER['REMOTE_ADDR']          ?
            $_SERVER['REMOTE_ADDR']            : false;

        // Function to get the client ip address
        if ( $clientip          !== false ) {
            $ipaddress = $clientip;
        }
        elseif( $xforwarderfor  !== false ) {
            $ipaddress = $xforwarderfor;
        }
        elseif( $xforwarded     !== false ) {
            $ipaddress = $xforwarded;
        }
        elseif( $forwardedfor   !== false ) {
            $ipaddress = $forwardedfor;
        }
        elseif( $forwarded      !== false ) {
            $ipaddress = $forwarded;
        }
        elseif( $remoteadd      !== false ) {
            $ipaddress = $remoteadd;
        }
        else{
            $ipaddress = false; # unknown
        }
        return $ipaddress;
    }
}
?>