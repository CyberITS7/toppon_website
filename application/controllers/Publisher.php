<?php
class Publisher extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $this->load->model('User_model');
        $this->load->model('Publisher_model');
    }

    function index(){
        if(!$this->session->userdata('logged_in')){
            $this->loginAndRegister();
        }
        else{
            $this->dashboard();
        }
    }

    function dashboard($start=1){
        if(!$this->session->userdata('logged_in')){
            redirect($this->loginAndRegister());
        }
        else{
            //get Publisher List data
            $num_per_page = 10;
            $start = ($start - 1)* $num_per_page;
            $limit = $num_per_page;

            $publisher_page = $this->Publisher_model->getPublisherList($start, $limit);
            $count_publisher = $this->Publisher_model ->getCountPublisherList();

            $config['base_url']= site_url('Publisher/dashboard');

            $config ['total_rows'] = $count_publisher;
            $config ['per_page']=$num_per_page;
            $config['use_page_numbers']=TRUE;
            $config['uri_segment']=3;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['publisher']= $publisher_page;

            if ($this->input->post('ajax')){
                $this->load->view('admin/publisher_list_view', $data);
            }else{
                $data['data_content'] = 'admin/publisher_list_view';
                $this->load->view('includes/member_area_template_view',$data);
            }
        }
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

}
?>