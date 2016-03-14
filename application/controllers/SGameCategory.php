<?php
class SGameCategory extends CI_Controller{
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
        $this->load->model('GameCategory_model');
        $this->load->model('Publisher_model');
        $this->load->model('SGameCategory_model');
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

            $setting_category_game_page = $this->SGameCategory_model->getSGameCategoryList($start, $limit);
            $count_setting_category_game = $this->SGameCategory_model ->getCountSGameCategoryList();

            $config['base_url']= site_url('SGameCategory/index');
            $config ['total_rows'] = $count_setting_category_game;
            $config ['per_page']=$num_per_page;
            $config['use_page_numbers']=TRUE;
            $config['uri_segment']=3;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['setting_category_game']= $setting_category_game_page;

            if ($this->input->post('ajax')){
                $this->load->view('admin/setting/setting_category_game_list_view', $data);
            }else{
                $data['data_content'] = 'admin/setting/setting_category_game_list_view';
                $this->load->view('includes/member_area_template_view',$data);
            }
        }
    }

    function goToAddDetailSGameCategory(){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $game_category_list = $this->GameCategory_model->getGameCategorySettingList(null, null);
            $publisher_list = $this->Publisher_model->getComboPublisherSettingList(null, null);

            $data['setting_id'] = null;
            $data['publisher_list_edit'] = null;
            $data['game_category'] = $game_category_list;
            $data['publisher'] = $publisher_list;
            $data['data_content'] = 'admin/setting/setting_category_game_detail_view';
            $this->load->view('includes/member_area_template_view', $data);
        }
    }
    function goToEditDetailSGameCategory($id){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $game_category_list = $this->GameCategory_model->getGameCategorySettingList(null, null);
            $game_category_edit = $this->GameCategory_model->getGameCategoryById($id);
            $publisher_list = $this->Publisher_model->getComboPublisherSettingList(null, null);
            $publisher_setting_list = $this->SGameCategory_model->getPublisherSettingListByCategory($id);

            $data['setting_id'] = $id;
            //For Combobox
            $data['game_category'] = $game_category_list;
            $data['publisher'] = $publisher_list;
            //From Setting
            $data['publisher_list_edit'] = $publisher_setting_list;
            $data['game_category_edit'] = $game_category_edit;

            $data['data_content'] = 'admin/setting/setting_category_game_detail_view';
            $this->load->view('includes/member_area_template_view', $data);
        }
    }

    function createSGameCategory(){
        $status = "";
        $msg="";
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $userID = $this->session->userdata('user_id');
            $game_category = $this->input->post('game_category');
            $publisher_list = json_decode($this->input->post('publisher_list'), true);
            //$publisher_list = explode(",",$this->input->post('publisher_list'));

            //INSERT to DB
            $this->db->trans_begin();
            foreach ($publisher_list as $row) {
                $data_post = array(
                    'gameCategoryID' => $game_category,
                    'publisherID' => $row['id'],
                    'isActive' => 1,
                    "created" => $datetime,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $id = $this->SGameCategory_model->createSGameCategory($data_post);
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

    function updateSGameCategory(){
        $status = "";
        $msg="";
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $userID = $this->session->userdata('user_id');

            $game_category = $this->input->post('game_category');
            $update_header = $this->input->post('update_header');
            $update_category = $this->input->post('update_category');
            $publisher_list = json_decode($this->input->post('publisher_list'), true);
            $publisher_delete = json_decode($this->input->post('publisher_delete'), true);

            $this->db->trans_begin();
            //Delete Detail
            foreach ($publisher_delete as $row) {
                $data_post = array(
                    'isActive' => 0,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $delete = $this->SGameCategory_model->updateSGameCategory($data_post, $game_category, $row['id']);
            }

            //INSERT New Publisher
            foreach ($publisher_list as $row) {
                $data_post = array(
                    'gameCategoryID' => $game_category,
                    'publisherID' => $row['id'],
                    'isActive' => 1,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $insert = $this->SGameCategory_model->createSGameCategory($data_post);
            }

            //Update Header
            if ($update_header == 1) {
                $data_post = array(
                    'gameCategoryID' => $update_category,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
                $update = $this->SGameCategory_model->updateSGameCategory($data_post, $game_category, null);
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

    function deleteSGameCategory(){
        $status = "";
        $msg="";
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $userID = $this->session->userdata('user_id');

            $game_category = $this->input->post('id');
            $data_post = array(
                'isActive' => 0,
                "lastUpdated" => $datetime,
                "lastUpdatedBy" => $userID
            );
            $delete = $this->SGameCategory_model->updateSGameCategory($data_post, $game_category, null);

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