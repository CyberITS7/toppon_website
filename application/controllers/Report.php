<?php
class Report extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library("Authentication");

        $this->load->model('User_model');
        $this->load->model('Nominal_model');
        $this->load->model('TGamePurchase_model');
        $this->load->model('TDeposit_model');
        $this->load->model('TGift_model');
        $this->load->model('Transfer_model');
    }

    // Game Purchase
    function gamePurchaseReport(){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));

        if($this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['game_purchase_list'] = $this->TGamePurchase_model->getTransGamePurchaseList(null, null, null,null);
            $data['data_content'] = "report/game_purchase_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else if($this->session->userdata('logged_in')){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['game_purchase_list'] = $this->TGamePurchase_model->getTransGamePurchaseList(null, null, $userID,null);
            $data['data_content'] = "report/game_purchase_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }
        else {
            redirect(site_url("User/dashboard"));
        }
    }
    // Game Purchase Periode
    function gamePurchaseReportSearchByPeriode($startDate, $endDate){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if($this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            //END DATE + 1
            $endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
            $data['game_purchase_list'] = $this->TGamePurchase_model->getTransGamePurchaseByPeriode(null, null,null,$startDate, $endDate,null);
            $data['data_content'] = "report/game_purchase_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else if($this->session->userdata('logged_in')){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            //END DATE + 1
            $endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
            $data['game_purchase_list'] = $this->TGamePurchase_model->getTransGamePurchaseByPeriode(null, null,$userID,$startDate, $endDate,null);
            $data['data_content'] = "report/game_purchase_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else {
            redirect(site_url("User/dashboard"));
        }
    }
    // Game Purchase Date
    function gamePurchaseReportSearchByDate($date){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if($this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['game_purchase_list'] = $this->TGamePurchase_model->getTransGamePurchaseByDate(null, null, null, $date,null);
            $data['data_content'] = "report/game_purchase_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else if($this->session->userdata('logged_in')){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['game_purchase_list'] = $this->TGamePurchase_model->getTransGamePurchaseByDate(null, null, $userID, $date,null);
            $data['data_content'] = "report/game_purchase_report_view";
            $this->load->view('includes/member_area_template_view', $data);

        }else {
            redirect(site_url("User/dashboard"));
        }
    }

    // Deposit
    function depositReport(){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if($this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['deposit_list'] = $this->TDeposit_model->getTransDepositList(null, null, null, null);
            $data['data_content'] = "report/deposit_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else if($this->session->userdata('logged_in')){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['deposit_list'] = $this->TDeposit_model->getTransDepositList(null, null, $userID,null);
            $data['data_content'] = "report/deposit_report_view";
            $this->load->view('includes/member_area_template_view', $data);

        }else {
            redirect(site_url("User/dashboard"));
        }
    }

    // Deposit Periode
    function depositReportSearchByPeriode($startDate, $endDate){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if($this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            //END DATE + 1
            $endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
            $data['deposit_list'] = $this->TDeposit_model->getTransDepositByPeriode(null, null,null,$startDate, $endDate,null);
            $data['data_content'] = "report/deposit_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else if($this->session->userdata('logged_in')){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            //END DATE + 1
            $endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
            $data['deposit_list'] = $this->TDeposit_model->getTransDepositByPeriode(null, null,$userID,$startDate, $endDate,null);
            $data['data_content'] = "report/deposit_report_view";
            $this->load->view('includes/member_area_template_view', $data);

        }else {
            redirect(site_url("User/dashboard"));
        }
    }
    // Deposit Date
    function depositReportSearchByDate($date){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if($this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['deposit_list'] = $this->TDeposit_model->getTransDepositByDate(null, null, null, $date,null);
            $data['data_content'] = "report/deposit_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else if($this->session->userdata('logged_in')){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['deposit_list'] = $this->TDeposit_model->getTransDepositByDate(null, null, $userID, $date,null);
            $data['data_content'] = "report/deposit_report_view";
            $this->load->view('includes/member_area_template_view', $data);

        }else {
            redirect(site_url("User/dashboard"));
        }
    }

    // Gift
    function giftReport(){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if($this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['gift_list'] = $this->TGift_model->getTransGiftList(null, null, null,null);
            $data['data_content'] = "report/gift_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else if($this->session->userdata('logged_in')){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['gift_list'] = $this->TGift_model->getTransGiftList(null, null, $userID,null);
            $data['data_content'] = "report/gift_report_view";
            $this->load->view('includes/member_area_template_view', $data);

        }else{
            redirect(site_url("User/dashboard"));
        }
    }
	// Gift Periode
    function giftReportSearchByPeriode($startDate, $endDate){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if($this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            //END DATE + 1
            $endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
            $data['gift_list'] = $this->TGift_model->getTransGiftByPeriode(null, null,null,$startDate, $endDate,null);
            $data['data_content'] = "report/gift_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else if($this->session->userdata('logged_in')){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            //END DATE + 1
            $endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
            $data['gift_list'] = $this->TGift_model->getTransGiftByPeriode(null, null,$userID,$startDate, $endDate,null);
            $data['data_content'] = "report/gift_report_view";
            $this->load->view('includes/member_area_template_view', $data);

        }else {
            redirect(site_url("User/dashboard"));
        }
    }
	
	// Gift Date
    function giftReportSearchByDate($date){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if($this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['gift_list'] = $this->TGift_model->getTransGiftByDate(null, null, null, $date,null);
            $data['data_content'] = "report/gift_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else if($this->session->userdata('logged_in')){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['gift_list'] = $this->TGift_model->getTransGiftByDate(null, null, $userID, $date,null);
            $data['data_content'] = "report/gift_report_view";
            $this->load->view('includes/member_area_template_view', $data);

        }else {
            redirect(site_url("User/dashboard"));
        }
    }

    //Transfer
    function transferReport(){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if($this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['transfer_list'] = $this->Transfer_model->getTransferList(null, null, null,null);
            $data['data_content'] = "report/transfer_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else if($this->session->userdata('logged_in')){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['transfer_list'] = $this->Transfer_model->getTransferList(null, null, $userID,null);
            $data['data_content'] = "report/transfer_report_view";
            $this->load->view('includes/member_area_template_view', $data);

        }else{
            redirect(site_url("User/dashboard"));
        }
    }
	//Transfer Periode
    function transferReportSearchByPeriode($startDate, $endDate){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if($this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            //END DATE + 1
            $endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
            $data['transfer_list'] = $this->Transfer_model->getTransferByPeriode(null, null,null,$startDate, $endDate,null);
            $data['data_content'] = "report/transfer_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else if($this->session->userdata('logged_in')){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            //END DATE + 1
            $endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
            $data['transfer_list'] = $this->Transfer_model->getTransferByPeriode(null, null,$userID,$startDate, $endDate,null);
            $data['data_content'] = "report/transfer_report_view";
            $this->load->view('includes/member_area_template_view', $data);

        }else {
            redirect(site_url("User/dashboard"));
        }
    }
	//Transfer Date
    function transferReportSearchByDate($date){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if($this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['transfer_list'] = $this->Transfer_model->getTransferByDate(null, null, null, $date,null);
            $data['data_content'] = "report/transfer_report_view";
            $this->load->view('includes/member_area_template_view', $data);
        }else if($this->session->userdata('logged_in')){
            //get Games List data
            $userID = $this->session->userdata('user_id');
            $data['transfer_list'] = $this->Transfer_model->getTransferByDate(null, null, $userID, $date,null);
            $data['data_content'] = "report/transfer_report_view";
            $this->load->view('includes/member_area_template_view', $data);

        }else {
            redirect(site_url("User/dashboard"));
        }
    }
}
?>