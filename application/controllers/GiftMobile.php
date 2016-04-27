<?php  
	class GiftMobile extends CI_Controller{
		function __construct(){
			parent::__construct();

			$this->load->helper(array('form', 'url'));
			$this->load->helper('date');
			$this->load->helper('html');
		    $this->load->library("pagination");
		    $this->load->library('form_validation');
		    $this->load->library('email');

		    $this->load->library('upload');
		    $this->load->model("SGift_model");
		    $this->load->model("TGift_model");
		    $this->load->model('SAccount_model');
		    $this->load->model('User_model');
		    $this->load->library("Authentication");
		    $this->load->model("GiftCategory_model");
		}

		function giftListAjax(){
			$userID = $this->input->post('userID');

			if($userID!=null){
        		$gift_list = $this->SGift_model->getGiftList(null, null);
        	}
        	else{
        		$gift_list="empty";
        	}

        	echo json_encode($gift_list);
		}
	}
?>