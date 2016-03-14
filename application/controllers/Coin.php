<?php
class Coin extends CI_Controller{
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
        $this->load->model('Coin_model');
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

            $coin_page = $this->Coin_model->getCoinList($start, $limit);
            $count_coin = $this->Coin_model ->getCountCoinList();

            $config['base_url']= site_url('Coin/index');
            $config ['total_rows'] = $count_coin;
            $config ['per_page']=$num_per_page;
            $config['use_page_numbers']=TRUE;
            $config['uri_segment']=3;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['coin']= $coin_page;

            if ($this->input->post('ajax')){
                $this->load->view('admin/coin_list_view', $data);
            }else{
                $data['data_content'] = 'admin/coin_list_view';
                $this->load->view('includes/member_area_template_view',$data);
            }
        }
    }

    function createCoin(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $name = $this->input->post('name');
        $coinConversion = $this->input->post('coinConversion');
        $poin = $this->input->post('poin');
        $userID = $this->session->userdata('user_id');
        $check_name = $this->Coin_model->checkCoin($name);

        if(!$check_name){
            $data_post=array(
                'coin'=>$name,
                'coinConversion'=>$coinConversion,
                'poin'=>$poin,
                'isActive'=>1,
                "created" => $datetime,
                "createdBy" => $userID,
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            $this->db->trans_begin();
            $id = $this->Coin_model->createCoin($data_post);

            if($id != null || $id != ""){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Coin has been create successfully!";

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

    function updateCoin(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $coinID = $this->input->post('id');
        $name = $this->input->post('name');
        $coinConversion = $this->input->post('coinConversion');
        $poin = $this->input->post('poin');
        $userID = $this->session->userdata('user_id');
        $check_name = $this->Coin_model->checkCoinEdit($name, $coinID);

        if(!$check_name){
            $data_post=array(
                'coin'=>$name,
                'coinConversion'=>$coinConversion,
                'poin'=>$poin,
                'isActive'=>1,
                "createdBy" => $userID,
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );


            $this->db->trans_begin();
            $update = $this->Coin_model->updateCoin($data_post,$coinID);

            if($update){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Coin has been updated successfully!";
            }else{
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Coin can't be updated!";
            }
        }else{
            $status = 'error';
            $msg = $name." already exist";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function deleteCoin(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $coinID = $this->input->post('id');
        $userID = $this->session->userdata('user_id');

        $data_post=array(
            'isActive'=>0,
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$userID
        );

        $this->db->trans_begin();
        $update = $this->Coin_model->updateCoin($data_post,$coinID);

        if($update){
            $this->db->trans_commit();
            $status = 'success';
            $msg = "Coin has been delete successfully!";
        }else{
            $this->db->trans_rollback();
            $status = 'error';
            $msg = "Coin can't be delete!";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

}
?>