<?php
class Deposit extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $this->load->library('Hash');
        $this->load->model('User_model');
    }

    function index(){
        if(!$this->session->userdata('logged_in')){
            $this->loginAndRegister();
        }
        else{
            $this->depositList();
        }
    }

    function depositList(){
        if(!$this->session->userdata('logged_in')){
            redirect($this->loginAndRegister());
        }
        else{
            $data['data_content']="member/deposit_list_view";
            $this->load->view('includes/member_area_template_view',$data);
        }

    }

    function depositInsertForm() {
        if(!$this->session->userdata('logged_in')){
            redirect($this->loginAndRegister());
        }
        else{
            $data['data_content']="member/deposit_insert_view";
            $this->load->view('includes/member_area_template_view',$data);
        }
    }

    function depositDetail() {
        if(!$this->session->userdata('logged_in')){
            redirect($this->loginAndRegister());
        }
        else{
            $data['data_content']="member/deposit_detail_view";
            $this->load->view('includes/member_area_template_view',$data);
        }
    }
}
?>