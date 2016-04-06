<?php
class GamePurchaseMobile extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("Authentication");

        $this->load->model('User_model');
        $this->load->model('GameCategory_model');
        $this->load->model('SGameCategory_model');
        $this->load->model('SPublisher_model');
        $this->load->model('SGame_model');
    }

    function getGameCategoryData($start=1){
        $data = $this->GameCategory_model->getGameCategoryList(null, null);
        echo json_encode($data);
    }

    function getPublisherData($gameCategory){
        $data = $this->SGameCategory_model->getPublisherListByCategory($gameCategory);
        echo json_encode($data);
    }
    function getGameData($publisher){
        //$publisher_id = $this->input->post('id');
        $data = $this->SPublisher_model->getGameListByPublisher($publisher);
        echo json_encode($data);
    }
    function getNominalData($game,$username){
        //$game_id = $this->input->post('id');
        $data = "";

        $user = $this->User_model->getUserLevelbyUsername($username);
        if($this->authentication->isAuthorizeAgent($user->userLevel)){
            $data = $this->SGame_model->getGameListByPublisher($game, true);
        }else if($this->authentication->isAuthorizeMember($user->userLevel)){
            $data = $this->SGame_model->getGameListByPublisher($game, false);
        }
        echo json_encode($data);

    }


}
?>