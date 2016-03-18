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
        $this->load->view("email/template_view");
    }
}
?>