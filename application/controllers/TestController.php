<?php
class TestController extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $this->load->library('Hash');
        $this->load->model('User_model');
        $this->load->model('SAccount_model');
        $this->load->library("Authentication");
    }

    function index(){

        $api_send = $this->testRequest();
        $user = $this->User_model->getUserDetailByUsername($this->session->userdata("username"));

        $data['data_api'] = $api_send;
        $data['name'] = $user->name;
        $data['title'] = "TOPPON - Bukti Pembelian Game";
        $data['content'] = "email/game_purchase_email_view";
        $this->load->view("email/template_view",$data);
    }

    function testRequest(){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeMember($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }
        else{
            $gateway = "http://dev.indomog.com/indomog2/new_core/index.php/h2h_rpc/server";

            $vsRMID = '0910403545';
            $vsQID= 'TOPPON45';
            $vsRC='5006';
            $vsIPD= '202.58.180.46';
            $vsSecret='123456';

            $date = new DateTime();
            $now = date_format($date,"Ymd\TH:i:s");
            $gateway = "http://dev.indomog.com/indomog2/new_core/index.php/h2h_rpc/server";

            // mid.qid.reqc.ipd.emailhp.prodid.qty.prodaccid.prodbillid.remark.now
            $data= $vsRMID.$vsQID.$vsRC.$vsIPD.$now;
            $vsSignature = sha1($data.$vsSecret);

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
			
			$send_xml = $this->sendXmlApi($gateway,$req,FALSE,0);
            //Return Message From IndoMog API
            return $send_xml;
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

            $xml = simplexml_load_string($result);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);

            $returnAPI= $this->checkGamePurchase($array,TRUE);
            $returnAPI['IPD'] = $vsIPD;
            $returnAPI['QID'] = $vsQID;
            $returnAPI['date'] = date_format($date,"d-M-Y H:i:s");
            $returnAPI['Coin'] = "10";
            return $returnAPI;
        }//else
    }

	function getRequestPurchaseGame($qid,$coin_payment){
        $vsRMID = '0910403545';
        $vsSecret='123456';       
        $vsQID= $qid;
        $vsRC='5006';
        $vsIPD= $this->get_real_ip();

        $date = new DateTime();
        $now = date_format($date,"Ymd\TH:i:s");
        $gateway = "http://dev.indomog.com/indomog2/new_core/index.php/h2h_rpc/server";       

        // mid.qid.reqc.ipd.emailhp.prodid.qty.prodaccid.prodbillid.remark.now
        $data= $vsRMID.$vsQID.$vsRC.$vsIPD.$now;
        $vsSignature = sha1($data.$vsSecret);

//Create xml request
        $req = '
            <methodCall>
            <methodName>Inquiry</methodName>
                <params>
                <param>
            <value>
                <struct>
                    <member>
                        <name>RMID</name>
                        <value><string>'.$vsRMID.'</string></value>
                    </member>
                    <member>
                        <name>QID</name>
                        <value><string>'.$vsQID.'</string></value>
                    </member>
                    <member>
                        <name>RC</name>
                        <value><string>5006</string></value>
                    </member>
                    <member>
                        <name>IPD</name>
                        <value><string>'.$vsIPD.'</string></value>
                    </member>
                    <member>
                        <name>Now</name>
                        <value> <datetime.iso8601>'.$now.'</datetime.iso8601> </value>
                    </member>
                    <member>
                        <name>Signature</name>
                        <value><string>'.$vsSignature.'</string></value>
                    </member>
                </struct>
            </value>
                </param>
                </params>
            </methodCall> ';

        $send_xml = $this->sendXmlApi($gateway,$req,TRUE,$coin_payment);
        $send_xml['IPD'] = $vsIPD;
        $send_xml['QID'] = $vsQID;
        $send_xml['date'] = date_format($date,"d-M-Y H:i:s");
        //Return Message From IndoMog API
        return $send_xml;

    }

	function sendEmailToppon($generateID,$coin_payment,$email){
        $user = $this->User_model->getUserDetailByUsername($this->session->userdata("username"));
        $data_email = $this->getRequestPurchaseGame($generateID,$coin_payment);

        $data['data_api'] = $data_email;
        $data['title'] = "TOPPON - Bukti Pembelian Game";
        $data['name'] = $user->name;
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


    function checkGamePurchase($result, $inquiry){
        $return = "empty";
        //echo $array['params']['param']['value']['struct']['member'][1]['name'];
        if($inquiry == TRUE){
            $return = array();
            foreach($result['params']['param']['value']['struct']['member'] as $row) {
                if ($row['name'] == 'RspCode') {
                    $return['RspCode'] = $row['value']['string'];
                }else if($row['name'] == 'TrxID'){
                    $return['TrxID'] = $row['value']['string'];
                }else if($row['name'] == 'TrxValue'){
                    $return['TrxValue'] = $row['value']['string'];
                }else if($row['name'] == 'SN'){
                    $return['SN'] = $row['value']['string'];
                }else if($row['name'] == 'SecretCode'){
                    $return['SecretCode'] = $row['value']['string'];
                }else if($row['name'] == 'ProdID'){
                    $return['ProdID'] = $row['value']['string'];
                }
            }
        }else{
            foreach($result['params']['param']['value']['struct']['member'] as $row) {
                if ($row['name'] == 'RspCode') {
                    $return = $row['value']['string'];
                }
            }
        }

        return $return;
    }

}
?>