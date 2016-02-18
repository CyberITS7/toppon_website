<?php  
	class Transfer extends CI_Controller{
		function __construct(){
			parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->helper('html');
	    $this->load->library("pagination");
	    $this->load->library('form_validation');
	    	    
	    $this->load->model('Transfer_model');
	    $this->load->model('User_model');
		}

		function index(){
			if(!$this->session->userdata('logged_in')){
            	site_url("user/loginAndRegister");
	        }
	        else{
	            $data['data_content']="member/transfer_view";
            	$this->load->view('includes/member_area_template_view',$data);
	        }
		}

		function doTransfer(){
			$datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

			$username = $this->input->post("username-tujuan");
			$toppon_coin = $this->input->post("toppon-coin");
			$password = $this->input->post("password");

			$userVerify = $this->User_model->getUserIDbyUsername($username);

			$data_transfer = array(
				'coin' => $toppon_coin,
				'userPengirim' => $this->session->userdata('user_id'),
				'userPenerima' => $userVerify->userID,				
				'isActive' => '1',
				'created' => $datetime,
				'createdBy' => $this->session->userdata('user_id'),
				'lastUpdated' => $datetime,
				'lastUpdatedBy' => $this->session->userdata('user_id')
			);

			$this->db->trans_begin();
			$query = $this->Transfer_model->createTransfer($data_transfer);

			if ($this->db->trans_status() === FALSE) {
                // Failed to save Data to DB
                $this->db->trans_rollback();
                echo "error bro";
            }
            else{
            	// update koin username pengirim dan penerima

            	$this->db->trans_commit();
                echo "bisa bro";
            }

		}
	}
?>