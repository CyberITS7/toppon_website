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
            $num_per_page = 10;
            $start = ($start - 1)* $num_per_page;
            $limit = $num_per_page;

            $game_page = $this->Game_model->getGameList($start, $limit);
            $count_game = $this->Game_model ->getCountGameList();

            $config['base_url']= site_url('Game/index');
            $config ['total_rows'] = $count_game;
            $config ['per_page']=$num_per_page;
            $config['use_page_numbers']=TRUE;
            $config['uri_segment']=3;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
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
        $data = $this->SGame_model->getGameListByPublisher($game_id);
        echo json_encode($data);
    }

}
?>