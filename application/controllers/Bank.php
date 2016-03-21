<?php
class Bank extends CI_Controller{
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
        $this->load->model('Bank_model');
    }

    function index($start=1){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }
        else{
            //get Publisher List data
            $bank_page = $this->Bank_model->getBankList(null, null);
            $data['bank']= $bank_page;

            if ($this->input->post('ajax')){
                $this->load->view('admin/bank_list_view', $data);
            }else{
                $data['data_content'] = 'admin/bank_list_view';
                $this->load->view('includes/member_area_template_view',$data);
            }
        }
    }

    function createBank(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $name = $this->input->post('name');
        $userID = $this->session->userdata('user_id');
        $check_name = $this->Bank_model->checkBank($name);

        if(!$check_name){
            $data_post=array(
                'bankName'=>$name,
                'isActive'=>1,
                "created" => $datetime,
                "createdBy" => $userID,
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            $this->db->trans_begin();
            $id = $this->Bank_model->createBank($data_post);

            if($id != null || $id != ""){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Bank has been create successfully!";

            }else{
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Cannot Save to Database";
            }


        }else{
            $status = 'error';
            $msg = $name." already exist";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function updateBank(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $name = $this->input->post('name');
        $userID = $this->session->userdata('user_id');
        $bankID = $this->input->post('id');
        $check_name = $this->Bank_model->checkBankEdit($name,$bankID);

        if(!$check_name){
            $data_post=array(
                'bankName'=>$name,
                'isActive'=>1,
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            $this->db->trans_begin();
            $update = $this->Bank_model->updateBank($data_post,$bankID);

            if($update){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Bank has been updated successfully!";
            }else{
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Bank can't be updated!";
            }
        }else{
            $status = 'error';
            $msg = $name." already exist";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function deleteBank(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $bankID = $this->input->post('id');
        $userID = $this->session->userdata('user_id');

        $data_post=array(
            'isActive'=>0,
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$userID
        );

        $this->db->trans_begin();
        $update = $this->Bank_model->updateBank($data_post,$bankID);

        if($update){
            $this->db->trans_commit();
            $status = 'success';
            $msg = "Bank has been delete successfully!";
        }else{
            $this->db->trans_rollback();
            $status = 'error';
            $msg = "Bank can't be delete!";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

}
?>