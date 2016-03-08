<?php
class Nominal extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library("Authentication");

        $this->load->model('User_model');
        $this->load->model('Nominal_model');
    }

    function index($start=1){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }
        else{
            //get Publisher List data
            $num_per_page = 10;
            $start = ($start - 1)* $num_per_page;
            $limit = $num_per_page;

            $nominal_page = $this->Nominal_model->getNominalList($start, $limit);
            $count_nominal = $this->Nominal_model ->getCountNominalList();

            $config['base_url']= site_url('Nominal/index');
            $config ['total_rows'] = $count_nominal;
            $config ['per_page']=$num_per_page;
            $config['use_page_numbers']=TRUE;
            $config['uri_segment']=3;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['nominal']= $nominal_page;

            if ($this->input->post('ajax')){
                $this->load->view('admin/nominal_list_view', $data);
            }else{
                $data['data_content'] = 'admin/nominal_list_view';
                $this->load->view('includes/member_area_template_view',$data);
            }
        }
    }

    function createNominal(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $name = $this->input->post('name');
        $currency = $this->input->post('currency');
        $userID = $this->session->userdata('user_id');
        $check_name = $this->Nominal_model->checkNominal($name,$currency);

        if(!$check_name){
            $data_post=array(
                'nominalName'=>$name,
                'currency'=>$currency,
                'isActive'=>1,
                "created" => $datetime,
                "createdBy" => $userID,
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            $this->db->trans_begin();
            $id = $this->Nominal_model->createNominal($data_post);

            if($id != null || $id != ""){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Nominal has been create successfully!";

            }else{
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Cannot Save to Database";
            }


        }else{
            $status = 'error';
            $msg = $currency." ".$name." already exist";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function updateNominal(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $name = $this->input->post('name');
        $currency = $this->input->post('currency');
        $userID = $this->session->userdata('user_id');
        $nominalID = $this->input->post('id');
        $check_name = $this->Nominal_model->checkNominalEdit($name,$currency,$nominalID);

        if(!$check_name){
            $data_post=array(
                'nominalName'=>$name,
                'currency'=>$currency,
                'isActive'=>1,
                "created" => $datetime,
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            $this->db->trans_begin();
            $update = $this->Nominal_model->updateNominal($data_post,$nominalID);

            if($update){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Nominal has been updated successfully!";
            }else{
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Nominal can't be updated!";
            }
        }else{
            $status = 'error';
            $msg = $currency." ".$name." already exist";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function deleteNominal(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $nominalID = $this->input->post('id');
        $userID = $this->session->userdata('user_id');

        $data_post=array(
            'isActive'=>0,
            "created" => $datetime,
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$userID
        );

        $this->db->trans_begin();
        $update = $this->Nominal_model->updateNominal($data_post,$nominalID);

        if($update){
            $this->db->trans_commit();
            $status = 'success';
            $msg = "Nominal has been delete successfully!";
        }else{
            $this->db->trans_rollback();
            $status = 'error';
            $msg = "Nominal can't be delete!";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
}
?>