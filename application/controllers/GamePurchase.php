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

    function sendIndomog(){
        echo "Sending XMLRPC Request with result :<br />";

        $vsRMID = '0910403545';
        $vsQID= 'T108000001';
        $vsRC='5003';
        $vsIPD='G001T001';
        //$vsIPD= 'G001T001';
        $vsEmailHP= '081388505363';
        $vsProdID = 'lyto v10';
        $vsQty='1';
        $vsSecret='123456';
        $vsnow='20141201T17:10:05';

        $dt = new DateTime();
        $dt->setTimeZone(new DateTimeZone('UTC'));
        $now = $dt->format('YYYYMMDDTHH:MM:SS');
        //$datetime = date('', time());
        $gateway = "http://dev.indomog.com/indomog2/new_core/index.php/h2h_rpc/server";

        $vsSignature=$vsRMID.$vsQID.$vsRC.$vsIPD.$vsEmailHP.$vsQty.$vsProdID.$vsnow.$vsSecret;
        $vsSignature= '6b3d5f6912b1c63494f09302f826528377899de8';
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
              <datetime.iso8601>'.$vsnow.'</datetime.iso8601>
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

        $inquiry = '
            <methodCall>
            <methodName>Inquiry</methodName>
            <params>
                <param>
                    <value>
                        <struct>
                            <member>
                              <name>RMID</name>
                              <value><string>0910403545</string></value>
                            </member>
                            <member>
                              <name>QID</name>
                              <value><string>T108000001</string></value>
                            </member>
                            <member>
                              <name>RC</name>
                              <value><string>5006</string></value>
                            </member>
                            <member>
                              <name>IPD</name>
                              <value><string>G001T001</string></value>
                            </member>
                            <member>
                              <name>Now</name>
                              <value><datetime.iso8601>20141201T17:10:05</datetime.iso8601></value>
                            </member>
                            <member>
                              <name>Signature</name>
                              <value><string>6b3d5f6912b1c63494f09302f826528377899de8</string></value>
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

            echo htmlentities($result);
    }
}
?>