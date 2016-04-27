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

		function giftListAjax($start=1){
			$userID = $this->input->post('userID');

			$num_per_page = 10;
        	$start = ($start - 1)* $num_per_page;
        	$limit = $num_per_page;

			if($userID!=null){
        		$gift_list = $this->SGift_model->getGiftList($start, $limit);
        		$count_gift = $this->SGift_model->getCountGiftList();
        		$pages = ceil($count_gift/$num_per_page);
        		echo json_encode(array('count' => $pages, 'data' => $gift_list));
        	}
        	else{
        		$gift_list="empty";
        		echo json_encode($gift_list);
        	}

        	
		}
	}
?>