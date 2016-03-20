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
        $this->load->library('upload');
        $this->load->library("Authentication");

        $this->load->model('User_model');
        $this->load->model('Home_model');
	}

	function index()
    	{

    		$this->load->view('parallax_view.php');
    	}
	

	
	function Send_email_contactus(){
		$this->load->library('email');

		$config = Array (
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'christiansan36@gmail.com',
                'smtp_pass' => 'christiansan123',
                'mailtype'  => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            );
		$message =  'Name          		= '.$this->input->post('contactName').
                '<br>Alamat Email = '.$this->input->post('contactEmail').
                '<br>Subject = '.$this->input->post('contactSubject').
                '<br>Pesan				= '.$this->input->post('contactMessage');

		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
        $this->email->from('blackzur@gmail.com', 'System'); // nanti diganti dengan email sistem pintubaja
        $this->email->to('vzheng92@gmail.com'); // nanti diganti dengan admin yang ngurusin order

        $this->email->subject('[TOPPON] CONTACT US');
		$this->email->message($message);

		if($this->email->send())
        {
            //echo '1';
            $status = 'Success';
            $msg = 'Please see the detail on your email address.';
        }

        else
        {
            show_error($this->email->print_debugger());
            $status = 'failed';
            $msg = 'Thankyou for your message, but we are sorry your message wont reach us any time soon. We will fix it as soon as posible';
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

}

?>
