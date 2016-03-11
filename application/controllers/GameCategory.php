<?php
class GameCategory extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->library("Authentication");

        $this->load->model('User_model');
        $this->load->model('GameCategory_model');
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

            $game_category_page = $this->GameCategory_model->getGameCategoryList($start, $limit);
            $count_game_category = $this->GameCategory_model ->getCountGameCategoryList();

            $config['base_url']= site_url('GameCategory/index');
            $config ['total_rows'] = $count_game_category;
            $config ['per_page']=$num_per_page;
            $config['use_page_numbers']=TRUE;
            $config['uri_segment']=3;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['game_category']= $game_category_page;

            if ($this->input->post('ajax')){
                $this->load->view('admin/game_category_list_view', $data);
            }else{
                $data['data_content'] = 'admin/game_category_list_view';
                $this->load->view('includes/member_area_template_view',$data);
            }
        }
    }

    function createGameCategory(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $name = $this->input->post('name');
            $userID = $this->session->userdata('user_id');
            $check_name = $this->GameCategory_model->checkGameCategory($name);

            if (!$check_name) {
                $data_post = array(
                    'gameCategoryName' => $name,
                    'isActive' => 1,
                    "created" => $datetime,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );

                $this->db->trans_begin();
                $id = $this->GameCategory_model->createGameCategory($data_post);

                if ($id != null || $id != "") {
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "Game Category has been create successfully!";

                } else {
                    $this->db->trans_rollback();
                    $status = 'error';
                    $msg = "Cannot Save to Database";
                }


            } else {
                $status = 'error';
                $msg = $name . " already exist";
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function updateGameCategory(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $name = $this->input->post('name');
            $userID = $this->session->userdata('user_id');
            $gameCategoryID = $this->input->post('id');
            $check_name = $this->GameCategory_model->checkGameCategoryEdit($name, $gameCategoryID);

            if (!$check_name) {
                $data_post = array(
                    'gameCategoryName' => $name,
                    'isActive' => 1,
                    "created" => $datetime,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );

                $this->db->trans_begin();
                $update = $this->GameCategory_model->updateGameCategory($data_post, $gameCategoryID);

                if ($update) {
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "Game Category has been updated successfully!";
                } else {
                    $this->db->trans_rollback();
                    $status = 'error';
                    $msg = "Game Category can't be updated!";
                }
            } else {
                $status = 'error';
                $msg = $name . " already exist";
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function deleteGameCategory(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $gameCategoryID = $this->input->post('id');
            $userID = $this->session->userdata('user_id');

            $data_post = array(
                'isActive' => 0,
                "created" => $datetime,
                "lastUpdated" => $datetime,
                "lastUpdatedBy" => $userID
            );

            $this->db->trans_begin();
            $update = $this->GameCategory_model->updateGameCategory($data_post, $gameCategoryID);

            if ($update) {
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Game Category has been delete successfully!";
            } else {
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Game can't be delete!";
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }


    function getGameCategory(){
        $data = $this->GameCategory_model->getGameCategoryList(null, null);
        echo json_encode($data);
    }


}
?>