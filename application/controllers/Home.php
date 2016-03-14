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
}
?>
