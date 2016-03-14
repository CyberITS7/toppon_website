<?php
class Payment extends CI_Controller{
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
        $this->load->model('Payment_model');
    }

    function index($start=1){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }
        else{
            //get Publisher List data
            $num_per_page = 10;
            $start = ($start - 1)* $num_per_page;
            $limit = $num_per_page;

            $payment_page = $this->Payment_model->getPaymentList($start, $limit);
            $count_payment = $this->Payment_model ->getCountPaymentList();

            $config['base_url']= site_url('Payment/index');
            $config ['total_rows'] = $count_payment;
            $config ['per_page']=$num_per_page;
            $config['use_page_numbers']=TRUE;
            $config['uri_segment']=3;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['payment']= $payment_page;

            if ($this->input->post('ajax')){
                $this->load->view('admin/payment_list_view', $data);
            }else{
                $data['data_content'] = 'admin/payment_list_view';
                $this->load->view('includes/member_area_template_view',$data);
            }
        }
    }

    function createPayment(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $name = $this->input->post('name');
        $userID = $this->session->userdata('user_id');
        $check_name = $this->Payment_model->checkPayment($name);

        if(!$check_name){
            $data_post=array(
                'paymentMethodName'=>$name,
                'isActive'=>1,
                "created" => $datetime,
                "createdBy" => $userID,
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            $this->db->trans_begin();
            $id = $this->Payment_model->createPayment($data_post);

            if($id != null || $id != ""){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Payment has been create successfully!";

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

    function updatePayment(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $name = $this->input->post('name');
        $userID = $this->session->userdata('user_id');
        $paymentID = $this->input->post('id');
        $check_name = $this->Payment_model->checkPaymentEdit($name,$paymentID);

        if(!$check_name){
            $data_post=array(
                'paymentMethodName'=>$name,
                'isActive'=>1,
                "created" => $datetime,
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            $this->db->trans_begin();
            $update = $this->Payment_model->updatePayment($data_post,$paymentID);

            if($update){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Payment has been updated successfully!";
            }else{
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Payment can't be updated!";
            }
        }else{
            $status = 'error';
            $msg = $name." already exist";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function deletePayment(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $paymentID = $this->input->post('id');
        $userID = $this->session->userdata('user_id');

        $data_post=array(
            'isActive'=>0,
            "created" => $datetime,
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$userID
        );

        $this->db->trans_begin();
        $update = $this->Payment_model->updatePayment($data_post,$paymentID);

        if($update){
            $this->db->trans_commit();
            $status = 'success';
            $msg = "Payment has been delete successfully!";
        }else{
            $this->db->trans_rollback();
            $status = 'error';
            $msg = "Payment can't be delete!";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

}
?>