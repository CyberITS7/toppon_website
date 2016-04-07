<?php
class IndomogAPI
{
    // Game Purchase API
    function sendIndomog($qid,$proId){
        //SET DATA
        $vsRMID = '0910403545';
        $vsSecret='123456';
//        $vsRMID = '1603413887';
//        $vsSecret='pOyNeinswa61hv';
        $vsQID= $qid;
        $vsRC='5003';
        $vsIPD= $this->get_real_ip();
        $vsEmailHP= 'admin@toppon.co.id';
        $vsProdID = $proId;
        $vsQty='1';

        $date = new DateTime();
        $now = date_format($date,"Ymd\TH:i:s");
        $gateway = "http://dev.indomog.com/indomog2/new_core/index.php/h2h_rpc/server";
        //$gateway = "https://www.indomog.com/indomog2/new_core/index.php/h2h_rpc/server";

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

        $send_xml = $this->sendXmlApi($gateway,$req,FALSE,0);
        //Return Message From IndoMog API
        return $send_xml;
    }

    // API return XML message to Array
    function sendXmlApi($gateway,$req,$inquiry,$coin_payment){

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
        $array_xml = json_decode($json,TRUE);

        $return = "empty";
        if($inquiry == TRUE){
            // INQURY
            $return = array();
            foreach($array_xml['params']['param']['value']['struct']['member'] as $row) {
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
            $return['Coin']=$coin_payment;
        }else{
            foreach($array_xml['params']['param']['value']['struct']['member'] as $row) {
                if ($row['name'] == 'RspCode') {
                    $return = $row['value']['string'];
                }
            }
        }
        return $return;
    }

    // Cancel Game Purchasae
    function cancelPurchaseGame($qid){

        //$vsRMID = '0910403545';
        //$vsSecret='123456';
        $vsRMID = '1603413887';
        $vsSecret='pOyNeinswa61hv';
        $vsQID= $qid;
        $vsRC='5007';
        $vsIPD= $this->get_real_ip();


        $date = new DateTime();
        $now = date_format($date,"Ymd\TH:i:s");
        //$gateway = "http://dev.indomog.com/indomog2/new_core/index.php/h2h_rpc/server";
        $gateway = "https://www.indomog.com/indomog2/new_core/index.php/h2h_rpc/server";

        // mid.qid.reqc.ipd.emailhp.prodid.qty.prodaccid.prodbillid.remark.now
        $data= $vsRMID.$vsQID.$vsRC.$vsIPD.$now;
        $vsSignature = sha1($data.$vsSecret);


//Create xml request
        $req = '
            <methodCall>
            <methodName>Cancel</methodName>
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
                        <value><string>'.$vsRC.'</string></value>
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

        $send_xml = $this->sendXmlApi($gateway,$req,FALSE,0);
        //Return Message From IndoMog API
        return $send_xml;
    }

    // Get Inquiry
    function getRequestPurchaseGame($qid,$coin_payment){
        $vsRMID = '0910403545';
        $vsSecret='123456';
//        $vsRMID = '1603413887';
//        $vsSecret='pOyNeinswa61hv';
        $vsQID= $qid;
        $vsRC='5006';
        $vsIPD= $this->get_real_ip();


        $date = new DateTime();
        $now = date_format($date,"Ymd\TH:i:s");
        $gateway = "http://dev.indomog.com/indomog2/new_core/index.php/h2h_rpc/server";
        //$gateway = "https://www.indomog.com/indomog2/new_core/index.php/h2h_rpc/server";

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