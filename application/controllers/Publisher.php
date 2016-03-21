<?php
class Publisher extends CI_Controller{
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
    }

    function index($start=1){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }
        else{
            $publisher_page = $this->Publisher_model->getPublisherList(null, null);

            $data['publisher']= $publisher_page;

            if ($this->input->post('ajax')){
                $this->load->view('admin/publisher_list_view', $data);
            }else{
                $data['data_content'] = 'admin/publisher_list_view';
                $this->load->view('includes/member_area_template_view',$data);
            }
        }
    }

    function createPublisher(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $name = $this->input->post('name');
            $img = $_FILES['img'];
            $userID = $this->session->userdata('user_id');
            $check_name = $this->Publisher_model->checkPublisher($name);

            if (!$check_name) {
                $data_post = array(
                    'publisherName' => $name,
                    'publisherImage' => $img['name'],
                    'isActive' => 1,
                    "created" => $datetime,
                    "createdBy" => $userID,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );

                $dir = "./img/publisher";
                //config upload Image
                $config['upload_path'] = $dir;
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = 1024 * 5;
                $config['overwrite'] = 'TRUE';
                $this->upload->initialize($config);

                $this->db->trans_begin();
                $id = $this->Publisher_model->createPublisher($data_post);

                if ($id != null || $id != "") {
                    //Upload Image
                    if (!$this->upload->do_upload('img')) {
                        // Upload Failed
                        $this->db->trans_rollback();
                        $status = 'error';
                        $msg = $this->upload->display_errors('', '');
                    } else {
                        // Upload Success
                        $data = $this->upload->data();
                        $this->db->trans_commit();
                        $status = 'success';
                        $msg = "Publisher has been create successfully!";
                    }
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

    function updatePublisher(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $name = $this->input->post('name');
            $isUpdateImg = $this->input->post('isUpdateImg');
            $userID = $this->session->userdata('user_id');
            $publisherID = $this->input->post('id');
            $check_name = $this->Publisher_model->checkPublisherEdit($name, $publisherID);

            if (!$check_name) {
                $data_post = array(
                    'publisherName' => $name,
                    'isActive' => 1,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );

                if ($isUpdateImg == 1) {
                    $data_post['publisherImage'] = $_FILES['img']['name'];
                    $dir = "./img/publisher";
                    //config upload Image
                    $config['upload_path'] = $dir;
                    $config['allowed_types'] = 'jpg|png';
                    $config['max_size'] = 1024 * 5;
                    $config['overwrite'] = 'TRUE';
                    $this->upload->initialize($config);

                    $this->db->trans_begin();
                    $update = $this->Publisher_model->updatePublisher($data_post, $publisherID);

                    if ($update) {
                        //Upload Image
                        if (!$this->upload->do_upload('img')) {
                            // Upload Failed
                            $this->db->trans_rollback();
                            $status = 'error';
                            $msg = $this->upload->display_errors('', '');
                        } else {
                            // Upload Success
                            $data = $this->upload->data();
                            $this->db->trans_commit();
                            $status = 'success';
                            $msg = "Publisher has been updated successfully!";
                        }
                    } else {
                        $this->db->trans_rollback();
                        $status = 'error';
                        $msg = "Cannot Save to Database";
                    }
                } else {
                    $this->db->trans_begin();
                    $update = $this->Publisher_model->updatePublisher($data_post, $publisherID);

                    if ($update) {
                        $this->db->trans_commit();
                        $status = 'success';
                        $msg = "Publisher has been updated successfully!";
                    } else {
                        $this->db->trans_rollback();
                        $status = 'error';
                        $msg = "Publisher can't be updated!";
                    }
                }

            } else {
                $status = 'error';
                $msg = $name . " already exist";
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function deletePublisher(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $publisherID = $this->input->post('id');
            $userID = $this->session->userdata('user_id');

            $used_setting = $this->Publisher_model->checkUsedBySetting($publisherID);

            if(!$used_setting){
                $data_post = array(
                    'isActive' => 0,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );

                $this->db->trans_begin();
                $update = $this->Publisher_model->updatePublisher($data_post, $publisherID);

                if ($update) {
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "Publisher has been delete successfully!";
                } else {
                    $this->db->trans_rollback();
                    $status = 'error';
                    $msg = "Publisher can't be delete!";
                }
            }else{
                $status = 'error';
                $msg = "This Publisher still used in Setting Game Category OR Setting Publisher!";
            }

        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
}
?>