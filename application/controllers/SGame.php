<?php
class SGame extends CI_Controller{
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
        $this->load->model('Game_model');
        $this->load->model('Nominal_model');
        $this->load->model('SGame_model');
    }

    function index($start=1){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }
        else{
            //get Nominal List data
            $num_per_page = 10;
            $start = ($start - 1)* $num_per_page;
            $limit = $num_per_page;

            $setting_game_page = $this->SGame_model->getSGameList($start, $limit);
            $count_setting_game = $this->SGame_model ->getCountSGameList();

            $config['base_url']= site_url('SGame/index');
            $config ['total_rows'] = $count_setting_game;
            $config ['per_page']=$num_per_page;
            $config['use_page_numbers']=TRUE;
            $config['uri_segment']=3;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['setting_game']= $setting_game_page;

            if ($this->input->post('ajax')){
                $this->load->view('admin/setting/setting_game_list_view', $data);
            }else{
                $data['data_content'] = 'admin/setting/setting_game_list_view';
                $this->load->view('includes/member_area_template_view',$data);
            }
        }
    }

    function goToAddDetailSGame(){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $game_list = $this->Game_model->getGameSettingList(null, null);
            $nominal_list = $this->Nominal_model->getNominalList(null, null);

            $data['setting_id'] = null;
            $data['nominal_list_edit'] = [];
            $data['game'] = $game_list;
            $data['nominal'] = $nominal_list;
            $data['data_content'] = 'admin/setting/setting_game_detail_view';
            $this->load->view('includes/member_area_template_view', $data);
        }
    }
    function goToEditDetailSGame($id){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $game_list = $this->Game_model->getGameSettingList(null, null);
            $game_edit = $this->Game_model->getGameById($id);
            $nominal_list = $this->Nominal_model->getNominalList(null, null);
            $nominal_setting_list = $this->SGame_model->getNominalSettingListByGame($id);

            $data['setting_id'] = $id;
            //For Combobox
            $data['game'] = $game_list;
            $data['nominal'] = $nominal_list;
            //From Setting
            $data['nominal_list_edit'] = $nominal_setting_list;
            $data['game_edit'] = $game_edit;

            $data['data_content'] = 'admin/setting/setting_game_detail_view';
            $this->load->view('includes/member_area_template_view', $data);
        }
    }

    function createSGame(){
        $status = "";
        $msg="";
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $userID = $this->session->userdata('user_id');
            $game_id = $this->input->post('game_id');
            $nominal_list = json_decode($this->input->post('nominal_add'), true);
            //$nominal_list = explode(",",$this->input->post('nominal_list'));

            //INSERT to DB
            $this->db->trans_begin();
            foreach ($nominal_list as $row) {
                $data_post = array(
                    'gameID' => $game_id,
                    'nominalID' => $row['nominalID'],
                    'productCode' => $row['productCode'],
                    'paymentValue' => $row['coinVal'],
                    'isActive' => 1,
                    "created" => $datetime,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $id = $this->SGame_model->createSGame($data_post);
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $status = "error";
                $msg = "Error while saved data!";
            } else {
                $this->db->trans_commit();
                $status = "success";
                $msg = "Setting has been saved successfully!";
            }
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function updateSGame(){
        $status = "";
        $msg="";
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $userID = $this->session->userdata('user_id');

            $game_id = $this->input->post('game_id');
            $update_header = $this->input->post('update_header');
            $update_game = $this->input->post('update_game');
            $nominal_add = json_decode($this->input->post('nominal_add'), true);
            $nominal_update = json_decode($this->input->post('nominal_edit'), true);
            $nominal_delete = json_decode($this->input->post('nominal_delete'), true);

            $this->db->trans_begin();
            //Delete Nominal Detail
            foreach ($nominal_delete as $row) {
                $data_post = array(
                    'isActive' => 0,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $delete = $this->SGame_model->updateSGame($data_post, $game_id, $row['settingID']);
            }

            //Update Nominal Detail
            foreach ($nominal_update as $row) {
                $data_post = array(
                    'nominalID' => $row['nominalID'],
                    'productCode' => $row['productCode'],
                    'paymentValue' => $row['coinVal'],
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $update = $this->SGame_model->updateSGame($data_post, $game_id, $row['settingID']);
            }

            //INSERT New Nominal
            foreach ($nominal_add as $row) {
                $data_post = array(
                    'gameID' => $game_id,
                    'nominalID' => $row['nominalID'],
                    'productCode' => $row['productCode'],
                    'paymentValue' => $row['coinVal'],
                    'isActive' => 1,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $insert = $this->SGame_model->createSGame($data_post);
            }

            //Update Header
            if ($update_header == 1) {
                $data_post = array(
                    'gameID' => $update_game,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $update = $this->SGame_model->updateSGame($data_post, $game_id, null);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $status = "error";
                $msg = "Error while saved data!";
            } else {
                $this->db->trans_commit();
                $status = "success";
                $msg = "Setting has been saved successfully!";
            }
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function deleteSGame(){
        $status = "";
        $msg="";
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $userID = $this->session->userdata('user_id');

            $game = $this->input->post('id');
            $data_post = array(
                'isActive' => 0,
                "createdBy" => $userID,
                "lastUpdated" => $datetime,
                "lastUpdatedBy" => $userID
            );
            $delete = $this->SGame_model->updateSGame($data_post, $game, null);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $status = "error";
                $msg = "Error while saved data!";
            } else {
                $this->db->trans_commit();
                $status = "success";
                $msg = "Setting has been deleted successfully!";
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

}
?>