<?php
class Game extends CI_Controller{
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
        $this->load->model('SPublisher_model');
        $this->load->model('SGame_model');
        $this->load->model('Game_model');
    }

    function index($start=1){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }
        else{
            //get Publisher List data         
            $game_page = $this->Game_model->getGameList(null, null);          
            $data['game']= $game_page;

            if ($this->input->post('ajax')){
                $this->load->view('admin/game_list_view', $data);
            }else{
                $data['data_content'] = 'admin/game_list_view';
                $this->load->view('includes/member_area_template_view',$data);
            }
        }
    }

    function createGame(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $name = $this->input->post('name');
            $userID = $this->session->userdata('user_id');
            $check_name = $this->Game_model->checkGame($name);

            if (!$check_name) {
                $data_post = array(
                    'gameName' => $name,
                    'isActive' => 1,
                    "created" => $datetime,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );

                $this->db->trans_begin();
                $id = $this->Game_model->createGame($data_post);

                if ($id != null || $id != "") {
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "Game has been create successfully!";

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

    function updateGame(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $name = $this->input->post('name');
            $userID = $this->session->userdata('user_id');
            $gameID = $this->input->post('id');
            $check_name = $this->Game_model->checkGameEdit($name, $gameID);

            if (!$check_name) {
                $data_post = array(
                    'gameName' => $name,
                    'isActive' => 1,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );

                $this->db->trans_begin();
                $update = $this->Game_model->updateGame($data_post, $gameID);

                if ($update) {
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "Game has been updated successfully!";
                } else {
                    $this->db->trans_rollback();
                    $status = 'error';
                    $msg = "Game can't be updated!";
                }
            } else {
                $status = 'error';
                $msg = $name . " already exist";
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function deleteGame(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $gameID = $this->input->post('id');
            $userID = $this->session->userdata('user_id');

            $used_setting = $this->Game_model->checkUsedBySetting($gameID);

            if(!$used_setting){
                $data_post = array(
                    'isActive' => 0,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );

                $this->db->trans_begin();
                $update = $this->Game_model->updateGame($data_post, $gameID);

                if ($update) {
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "Game has been delete successfully!";
                } else {
                    $this->db->trans_rollback();
                    $status = 'error';
                    $msg = "Game can't be delete!";
                }
            }else{
                $status = 'error';
                $msg = "This Game still used in Setting Publisher OR Setting Game!";
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function getGameList(){
        $publisher_id = $this->input->post('id');
        $data = $this->SPublisher_model->getGameListByPublisher($publisher_id);
        echo json_encode($data);
    }
    function getNominalGameList(){

        $game_id = $this->input->post('id');
        $data = "";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if($this->authentication->isAuthorizeAgent($user->userLevel)){
            $data = $this->SGame_model->getGameListByPublisher($game_id, true);
        }else if($this->authentication->isAuthorizeMember($user->userLevel)){
            $data = $this->SGame_model->getGameListByPublisher($game_id, false);
        }

        echo json_encode($data);
    }

}
?>