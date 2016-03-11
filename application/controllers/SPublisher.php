<?php
class SPublisher extends CI_Controller{
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
        $this->load->model('Publisher_model');
        $this->load->model('Game_model');
        $this->load->model('SPublisher_model');
    }

    function index($start=1){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }
        else{
            //get Game List data
            $num_per_page = 10;
            $start = ($start - 1)* $num_per_page;
            $limit = $num_per_page;

            $setting_publisher_page = $this->SPublisher_model->getSPublisherList($start, $limit);
            $count_setting_publisher = $this->SPublisher_model ->getCountSPublisherList();

            $config['base_url']= site_url('SPublisher/index');
            $config ['total_rows'] = $count_setting_publisher;
            $config ['per_page']=$num_per_page;
            $config['use_page_numbers']=TRUE;
            $config['uri_segment']=3;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['setting_publisher']= $setting_publisher_page;

            if ($this->input->post('ajax')){
                $this->load->view('admin/setting/setting_publisher_list_view', $data);
            }else{
                $data['data_content'] = 'admin/setting/setting_publisher_list_view';
                $this->load->view('includes/member_area_template_view',$data);
            }
        }
    }

    function goToAddDetailSPublisher(){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $publisher_list = $this->Publisher_model->getPublisherSettingList(null, null);
            $game_list = $this->Game_model->getComboGameSettingList(null, null);

            $data['setting_id'] = null;
            $data['game_list_edit'] = null;
            $data['publisher'] = $publisher_list;
            $data['game'] = $game_list;
            $data['data_content'] = 'admin/setting/setting_publisher_detail_view';
            $this->load->view('includes/member_area_template_view', $data);
        }
    }
    function goToEditDetailSPublisher($id){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $publisher_list = $this->Publisher_model->getPublisherSettingList(null, null);
            $publisher_edit = $this->Publisher_model->getPublisherById($id);
            $game_list = $this->Game_model->getComboGameSettingList(null, null);
            $game_setting_list = $this->SPublisher_model->getGameSettingListByPublisher($id);

            $data['setting_id'] = $id;
            //For Combobox
            $data['publisher'] = $publisher_list;
            $data['game'] = $game_list;
            //From Setting
            $data['game_list_edit'] = $game_setting_list;
            $data['publisher_edit'] = $publisher_edit;

            $data['data_content'] = 'admin/setting/setting_publisher_detail_view';
            $this->load->view('includes/member_area_template_view', $data);
        }
    }

    function createSPublisher(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $userID = $this->session->userdata('user_id');
            $publisher = $this->input->post('publisher');
            $game_list = json_decode($this->input->post('game_list'), true);
            //$game_list = explode(",",$this->input->post('game_list'));

            //INSERT to DB
            $this->db->trans_begin();
            foreach ($game_list as $row) {
                $data_post = array(
                    'publisherID' => $publisher,
                    'gameID' => $row['id'],
                    'isActive' => 1,
                    "created" => $datetime,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $id = $this->SPublisher_model->createSPublisher($data_post);
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

    function updateSPublisher(){
        $status = "";
        $msg="";
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $userID = $this->session->userdata('user_id');

            $publisher = $this->input->post('publisher');
            $update_header = $this->input->post('update_header');
            $update_publisher = $this->input->post('update_publisher');
            $game_list = json_decode($this->input->post('game_list'), true);
            $game_delete = json_decode($this->input->post('game_delete'), true);

            $this->db->trans_begin();
            //Delete Detail
            foreach ($game_delete as $row) {
                $data_post = array(
                    'isActive' => 0,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $delete = $this->SPublisher_model->updateSPublisher($data_post, $publisher, $row['id']);
            }

            //INSERT New Game
            foreach ($game_list as $row) {
                $data_post = array(
                    'publisherID' => $publisher,
                    'gameID' => $row['id'],
                    'isActive' => 1,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $insert = $this->SPublisher_model->createSPublisher($data_post);
            }

            //Update Header
            if ($update_header == 1) {
                $data_post = array(
                    'publisherID' => $update_publisher,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $update = $this->SPublisher_model->updateSPublisher($data_post, $publisher, null);
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

    function deleteSPublisher(){
        $status = "";
        $msg="";
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $userID = $this->session->userdata('user_id');

            $publisher = $this->input->post('id');
            $data_post = array(
                'isActive' => 0,
                "createdBy" => $userID,
                "lastUpdated" => $datetime,
                "lastUpdatedBy" => $userID
            );
            $delete = $this->SPublisher_model->updateSPublisher($data_post, $publisher, null);

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