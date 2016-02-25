<?php 
	class Gift extends CI_Controller{
		function __construct(){
			parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->helper('html');
	    $this->load->library("pagination");
	    $this->load->library('form_validation');

	    $this->load->model("SGift_model");
		}

		function index(){
			if(!$this->session->userdata('logged_in')){
            	redirect(site_url("User/loginAndRegister"));
	        }
	        else{
	        	$data['gifts']=$this->SGift_model->getGiftList();
	            $data['data_content']="member/gift_view";
            	$this->load->view('includes/member_area_template_view',$data);
	        }
		}
	}
?>