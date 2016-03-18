<?php  
	class Transfer extends CI_Controller{
		function __construct(){
			parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->helper('html');
	    $this->load->library("pagination");
	    $this->load->library('form_validation');

		$this->load->library('Hash');	    	    
	    $this->load->model('Transfer_model');
	    $this->load->model('User_model');
	    $this->load->model('SAccount_model');
	    $this->load->model('Coin_model');
		}

		function index(){
			if(!$this->session->userdata('logged_in')){
            	redirect(site_url("user/dashboard"));
	        }
	        else{
	        	$data['coin_list']=$this->Coin_model->getCoin();
	            $data['data_content']="member/transfer_view";
            	$this->load->view('includes/member_area_template_view',$data);
	        }
		}

		function doTransfer(){
			$datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

			$username = $this->input->post("username_tujuan");
			$toppon_coin = $this->input->post("toppon_coin");
			$password = $this->input->post("password");

			$userIdFromUsername = $this->User_model->getUserIDbyUsername($username);	
			$passVerifier = $this->User_model->getPasswordbyUsername($this->session->userdata('username'));		
			$userSenderCoin = $this->SAccount_model->getMyAccount($this->session->userdata('user_id'));			
			
			if($username == null || $username == ""){
				$status = 'error';
				$msg = "Transfer fail, username empty !";
			}
			else if($password == null || $password == ""){
				$status = 'error';
				$msg = "Transfer fail, password empty !";	
			}
			else if($toppon_coin > 100 || $toppon_coin < 10){
				$status = 'error';
				$msg = "Transfer fail, coin not valid !";	
			}
			else if($userIdFromUsername == "" || $userIdFromUsername == null){
				$status = 'error';
				$msg = "Transfer fail, username doesn't exists !";
			}
			else if($userIdFromUsername->userID == $this->session->userdata('user_id')){
				$status = 'error';
				$msg = "Transfer fail, cannot transfer to your own account !";	
			}
			else if(!$this->hash->verifyPass($password, $passVerifier->password)){
				$status = 'error';
				$msg = "Transfer fail, password doesn't match !";
			}else if($userSenderCoin->coin < $toppon_coin){
				$status = 'error';
				$msg = "Transfer fail, insufficient coin !";
			}else{
				$data_transfer = array(
					'coin' => $toppon_coin,
					'userPengirim' => $this->session->userdata('user_id'),
					'userPenerima' => $userIdFromUsername->userID,				
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
	                $status = 'error';
					$msg = "Transfer fail, something went wrong when adding transaction data. Please try again !";
	            }
	            else{
	            	// update koin username pengirim dan penerima
					$query2 = $this->SAccount_model->subtractionCoin($this->session->userdata('user_id'), $toppon_coin);
					if ($this->db->trans_status() === FALSE) {
		                // Failed to save Data to DB
		                $this->db->trans_rollback();
		                $status = 'error';
						$msg = "Transfer fail, something went wrong when substracting your coin. Please try again !";
		            }else{
		            	$query3 = $this->SAccount_model->additionCoin($userIdFromUsername->userID, $toppon_coin);
		            	if ($this->db->trans_status() === FALSE) {
			                // Failed to save Data to DB
			                $this->db->trans_rollback();
			                $status = 'error';
							$msg = "Transfer fail, something went wrong when adding your friend coin. Please try again !";
			            }else{
			            	$this->db->trans_commit();
		                	$status = 'success';
							$msg = "Transfer success !";
			            }			            	
		            }						
	            }
        	}
        	echo json_encode(array('status' => $status, 'msg' => $msg));
		}
	}
?>