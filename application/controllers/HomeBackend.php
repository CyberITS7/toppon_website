<?php
class HomeBackend extends CI_Controller{
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
        $this->load->model('Home_model');
    }

    function index($start=1){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }
        else{

            $home_page = $this->Home_model->getHomeList();
            $data['home']= $home_page;//ambil data tidak menggunakan row
            $data['data_content'] = 'admin/home_list_view';
            $this->load->view('includes/member_area_template_view',$data);
        }
    }


    function updateHomeImg(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $data_content = $this->input->post('data_column');
            $userID = $this->session->userdata('user_id');

            $img = $_FILES['img'];
            $dir = "./img/home";
            //config upload Image
            $config['upload_path'] = $dir;
            $config['allowed_types'] = 'png';
            $config['max_size'] = 1024 * 2;
            $config['overwrite'] = 'TRUE';
            $this->upload->initialize($config);

            $this->db->trans_begin();
            
            $data_post = array(
                    $data_content => $data_content,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );
            $update = $this->Home_model->updateHome($data_post, 1);

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
                    $msg = "Slider has been updated successfully!";
                }
            } else {
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Cannot Save to Database";
            }
                
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

function cek()
{
    $data_content = "fghjk";

            $data_post = array(
                    $data_content => $data_content
                );
            print_r ($data_post);
            echo $data_post[$data_content];

}
   
}
?>