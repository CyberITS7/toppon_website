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
	}
	function index()
	{

		$this->load->view('parallax_view.php');
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
}
?>
