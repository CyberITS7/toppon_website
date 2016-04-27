<?php  
	class TransferMobile extends CI_Controller{
		function __construct(){
			parent::__construct();

			$this->load->helper(array('form', 'url'));
			$this->load->helper('date');
			$this->load->helper('html');
		    $this->load->library("pagination");
		    $this->load->library('form_validation');
		    $this->load->library('email');

			$this->load->library('Hash');	    	    
		    $this->load->model('Transfer_model');
		    $this->load->model('User_model');
		    $this->load->model('SAccount_model');
		    $this->load->model('Coin_model');
		}

		function coinListAjax(){
			$userID = $this->input->post('userID');
			if($userID!=null){
        		$coin_list = $this->Coin_model->getCoin();
        	}
        	else{
        		$coin_list = "empty";
        	}

        	echo json_encode($coin_list);
		}

		function doTransfer(){
			$datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil


			$user_id = $this->input->post("user-id");
			$username_tujuan = $this->input->post("username-tujuan");
			$username_pengirim = $this->input->post("username-pengirim");
			$toppon_coin = $this->input->post("toppon-coin");
			$password = $this->input->post("password");

			$userIdFromUsername = $this->User_model->getUserIDbyUsername($username_tujuan);	
			$passVerifier = $this->User_model->getPasswordbyUsername($username_pengirim);
			$userSenderCoin = $this->SAccount_model->getMyAccount($user_id);			
			
			if($username_tujuan == null || $username_tujuan == ""){
				$status = 'error';
				$msg = "Transfer fail, username empty !";
			}
			else if($password == null || $password == ""){
				$status = 'error';
				$msg = "Transfer fail, password empty !";	
			}
			else if($userIdFromUsername == "" || $userIdFromUsername == null){
				$status = 'error';
				$msg = "Transfer fail, username doesn't exists !";
			}
			else if($userIdFromUsername->userID == $user_id){
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
					'userPengirim' => $user_id,
					'userPenerima' => $userIdFromUsername->userID,				
					'isActive' => '1',
					'created' => $datetime,
					'createdBy' => $user_id,
					'lastUpdated' => $datetime,
					'lastUpdatedBy' => $user_id
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
					$query2 = $this->SAccount_model->subtractionCoin($user_id, $toppon_coin);
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
			            	$transferDetail = $this->Transfer_model->getTransferDetailByID($query);
			            	if(!$this->sendEmailTransferPengirim($username_pengirim, $transferDetail)){
			            		show_error($this->email->print_debugger());
			            		$this->db->trans_rollback();
			            		$status = 'error';
								$msg = "Transfer fail, something went wrong when sending email !";
			            	}
			            	else{
			            		if(!$this->sendEmailTransferTujuan($username_tujuan, $transferDetail)){
				            		show_error($this->email->print_debugger());
				            		$this->db->trans_rollback();
				            		$status = 'error';
									$msg = "Transfer fail, something went wrong when sending email !";
				            	}
				            	else{
			            			$this->db->trans_commit();
		                			$status = 'success';
									$msg = "Transfer success !";
								}
			            	}
			            }			            	
		            }						
	            }
        	}
        	echo json_encode(array('status' => $status, 'msg' => $msg));
		}

		function sendEmailTransferPengirim($usernamePengirim, $transferDetail){
			$userPengirim = $this->User_model->getUserDetailByUsername($usernamePengirim);
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

            $data['detail_user'] = $userPengirim;
            $data['detail_transfer'] = $transferDetail;
            $data['title'] = "TOPPON - Konfirmasi Transfer Coin";
            $data['content']="email/transfer_pengirim_email_view";
            $message = $this->load->view('email/template_view',$data,true);

            
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('no-reply@toppon.co.id', 'Feedback System'); // nanti diganti dengan email sistem toppon
            $this->email->to($userPengirim->email); // email user

            $this->email->subject('[TOPPON] TRANSFER COIN CONFIRMATION');
            $this->email->message($message);

            if($this->email->send())
            {
               return TRUE;
            }

            else
            {
                return FALSE;
            }

        }

        function sendEmailTransferTujuan($usernameTujuan, $transferDetail){
			$userTujuan = $this->User_model->getUserDetailByUsername($usernameTujuan);
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

            $data['detail_user'] = $userTujuan;
            $data['detail_transfer'] = $transferDetail;
            $data['title'] = "TOPPON - Konfirmasi Transfer Coin";
            $data['content']="email/transfer_tujuan_email_view";
            $message = $this->load->view('email/template_view',$data,true);

            
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('no-reply@toppon.co.id', 'Feedback System'); // nanti diganti dengan email sistem toppon
            $this->email->to($userTujuan->email); // email user

            $this->email->subject('[TOPPON] TRANSFER COIN CONFIRMATION');
            $this->email->message($message);

            if($this->email->send())
            {
               return TRUE;
            }

            else
            {
                return FALSE;
            }

        }
	}
?>