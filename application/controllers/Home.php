<?php
class Home extends CI_Controller
{
	function __construct(){
			parent::__construct();

		$this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->library('email');

        $this->load->library('upload');
        $this->load->library("Authentication");

        $this->load->model('User_model');
        $this->load->model('Home_model');
	}

	function index()
	{
        $data['data_content'] = $this->Home_model->getHomeList();
		$this->load->view('parallax_view.php', $data);
	}
	

	
	function send_email_contactus(){
		$this->load->library('email');

		$config = Array
                (
                    'protocol' => 'mail',
                    'smtp_host' => 'toppon.co.id',
                    'smtp_port' => 25,
                    'smtp_user' => 'no-reply@toppon.co.id',
                    'smtp_pass' => 'Pass@word1',
                    'mailtype'  => 'html',
                    'charset' => 'iso-8859-1',
                    'wordwrap' => TRUE
                );

        $data['contact_detail']= Array(
                'name' => $this->input->post('contactName'),
                'email'=> $this->input->post('contactEmail'),
                'subject'=> $this->input->post('contactSubject'),
                'message'=>$this->input->post('contactMessage')
            );
		$data['title'] = "TOPPON - Hubungi";
        $data['content']="email/contact_email_view";
        $message = $this->load->view('email/template_view', $data, true);

		$this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('no-reply@toppon.co.id', 'Feedback System'); // nanti diganti dengan email sistem toppon
        $this->email->to('amartuis@gmail.com'); // email user

        $this->email->subject('[TOPPON] CONTACT US');
        $this->email->message($message);

		if($this->email->send())
        {
            //echo '1';
            $status = 'Success';
            $msg = 'Thank you for your feedback.';
        }

        else
        {
            show_error($this->email->print_debugger());
            $status = 'failed';
            $msg = 'Sorry your message wont reach us any time soon. We will fix it as soon as posible';
        }

        echo json_encode(array( 'status' => $status, 'msg' => $msg));
    }

     function homeContentList($start=1){
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

            $filename = $_FILES['img']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            $img = $_FILES['img'];
            $dir = "./img/home";
            //config upload Image
            $config['upload_path'] = $dir;
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024 * 2;
            $config['overwrite'] = 'TRUE';
            $config['file_name'] = $data_content;
            $this->upload->initialize($config);

            $this->db->trans_begin();
            
            $data_post = array(
                    $data_content => $data_content.".".$ext,
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
                    $msg = $data_content." has been updated successfully!";
                }
            } else {
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Cannot Save to Database";
            }
                
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function updateHomeAbout(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $data_content = $this->input->post('data_column');
            $userID = $this->session->userdata('user_id');

            $data_post = array(
                    "aboutUsContent" => $data_content,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $userID
                );

            $update = $this->Home_model->updateHome($data_post, 1);

            if ($update) {
                // Upload Success
                $data = $this->upload->data();
                $this->db->trans_commit();
                $status = 'success';
                $msg = "About Us Content has been updated successfully!";
            }else{
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Cannot Save to Database";
            }

        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function updateAdsImg(){
        $status = "";
        $msg="";

        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }else {
            $datetime = date('Y-m-d H:i:s', time());
            $data_content = $this->input->post('data_column');
            $userID = $this->session->userdata('user_id');

            $filename = $_FILES['img']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $img = $_FILES['img'];
            $dir = "./img/home";
            //config upload Image
            $config['upload_path'] = $dir;
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024 * 2;
            $config['overwrite'] = 'TRUE';
            $config['file_name'] = $data_content;
            $this->upload->initialize($config);

            $this->db->trans_begin();

            $data_post = array(
                $data_content => $data_content.".".$ext,
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
                    $msg = $data_content." has been updated successfully!";
                }
            } else {
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Cannot Save to Database";
            }

        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

}

?>
