<?php
class Home extends CI_Controller
{
	function __construct(){
			parent::__construct();

		$this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');
	}
	function index()
	{

		$this->load->view('parallax_view.php');
	}
	
}
?>
