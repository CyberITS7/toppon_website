<?php
class HomeBackend extends CI_Controller{
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
        $this->load->model('Home_model');
    }

    function index($start=1){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }
        else{

            $home_page = $this->Home_model->getHomeList();
            $data['home']= $home_page;//ambil data tidak menggunakan row
            $data['data_content'] = 'admin/home_list_view';
            $this->load->view('includes/member_area_template_view',$data);
        }
    }

    function createHome(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $name = $this->input->post('name');
            $currency = $this->input->post('currency');
            $userID = $this->session->userdata('user_id');
            $check_name = $this->Home_model->checkHome($name, $currency);

            if (!$check_name) {
                $data_post = array(
                    'homeName' => $name,
                    'currency' => $currency,
                    'isActive' => 1,
                    "created" => $datetime,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );

                $this->db->trans_begin();
                $id = $this->Home_model->createHome($data_post);

                if ($id != null || $id != "") {
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "Home has been create successfully!";

                } else {
                    $this->db->trans_rollback();
                    $status = 'error';
                    $msg = "Cannot Save to Database";
                }


            } else {
                $status = 'error';
                $msg = $currency . " " . $name . " already exist";
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function updateHome(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $name = $this->input->post('name');
            $currency = $this->input->post('currency');
            $userID = $this->session->userdata('user_id');
            $homeID = $this->input->post('id');
            $check_name = $this->Home_model->checkHomeEdit($name, $currency, $homeID);

            if (!$check_name) {
                $data_post = array(
                    'homeName' => $name,
                    'currency' => $currency,
                    'isActive' => 1,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );

                $this->db->trans_begin();
                $update = $this->Home_model->updateHome($data_post, $homeID);

                if ($update) {
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "Home has been updated successfully!";
                } else {
                    $this->db->trans_rollback();
                    $status = 'error';
                    $msg = "Home can't be updated!";
                }
            } else {
                $status = 'error';
                $msg = $currency . " " . $name . " already exist";
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function deleteHome(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $homeID = $this->input->post('id');
            $userID = $this->session->userdata('user_id');

            $data_post = array(
                'isActive' => 0,
                "lastUpdated" => $datetime,
                "lastUpdatedBy" => $userID
            );

            $this->db->trans_begin();
            $update = $this->Home_model->updateHome($data_post, $homeID);

            if ($update) {
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Home has been delete successfully!";
            } else {
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Home can't be delete!";
            }
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
}
?>