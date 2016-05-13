<?php  
	class GiftMobile extends CI_Controller{
		function __construct(){
			parent::__construct();

			$this->load->helper(array('form', 'url'));
			$this->load->helper('date');
			$this->load->helper('html');
		    $this->load->library("pagination");
		    $this->load->library('form_validation');
		    $this->load->library('email');

		    $this->load->library('upload');
		    $this->load->model("SGift_model");
		    $this->load->model("TGift_model");
		    $this->load->model('SAccount_model');
		    $this->load->model('User_model');
		    $this->load->library("Authentication");
		    $this->load->model("GiftCategory_model");
		}

		function giftListAjax($start=1){
			$userID = $this->input->post('userID');

			$num_per_page = 10;
        	$start = ($start - 1)* $num_per_page;
        	$limit = $num_per_page;

			if($userID!=null){
        		$gift_list = $this->SGift_model->getGiftList($start, $limit);
        		$count_gift = $this->SGift_model->getCountGiftList();
        		$pages = ceil($count_gift/$num_per_page);
        		echo json_encode(array('count' => $pages, 'data' => $gift_list));
        	}
        	else{
        		$gift_list="empty";
        		echo json_encode($gift_list);
        	}
		}

		function doClaimGift(){
			$datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil
			$giftID = $this->input->post('giftID');
			$userID = $this->input->post('userID');
			$username = $this->input->post('username');
			$verifyGift = $this->SGift_model->getGiftDetail($giftID);
			$userSenderPoin = $this->SAccount_model->getMyAccount($userID);

			if($userID!=null){
				if($giftID == null || $giftID == ""){
					$status = 'error';
					$msg = "Gift Claim fail, Gift ID isn't available !";
				}else if($verifyGift == null || $verifyGift == ""){
					$status = 'error';
					$msg = "Gift Claim fail, Gift isn't available !";
				}else if($userSenderPoin->poin < $verifyGift->poin){
					$status = 'error';
					$msg = "Gift Claim fail, insufficient poin !";
				}else{
					$data_gift = array(
						'giftID' => $giftID,
						'giftName' => $verifyGift->giftName,
						'giftCategory' => $verifyGift->giftCategory,
						'poin' => $verifyGift->poin,
						'reward' => $verifyGift->reward,
						'isActive' => '1',
						'created' => $datetime,
						'createdBy' => $userID,
						'lastUpdated' => $datetime,
						'lastUpdatedBy' => $userID
					);

					$this->db->trans_begin();
					$query = $this->TGift_model->createClaimGiftsLog($data_gift);

					if ($this->db->trans_status() === FALSE) {
		                // Failed to save Data to DB
		                $this->db->trans_rollback();
		                $status = 'error';
						$msg = "Gift Claim fail, something went wrong when adding transaction data. Please try again !";
		            }else{
		            	$query2 = $this->SAccount_model->subtractionPoin($userID, $verifyGift->poin);
			            	
			            if ($this->db->trans_status() === FALSE) {
			                // Failed to save Data to DB
			                $this->db->trans_rollback();
			                $status = 'error';
							$msg = "Gift Claim fail, something went wrong when substracting your poin. Please try again !";
			            }else{

			            	if($verifyGift->giftCategory == "TopponCoin"){
			            		$query3 = $this->SAccount_model->additionCoin($userID, $verifyGift->reward);
			            		if ($this->db->trans_status() === FALSE) {
					                // Failed to save Data to DB
					                $this->db->trans_rollback();
					                $status = 'error';
									$msg = "Gift Claim fail, something went wrong when your friend coin. Please try again !";
					            }
					            else{
					            	$giftDetail = $this->TGift_model->getTGiftDetail($query);
				            		if(!$this->sendEmailGiftClaim($username, $giftDetail)){
						            		show_error($this->email->print_debugger());
						            		$this->db->trans_rollback();
						            		$status = 'error';
											$msg = "Gift Claim fail, something went wrong when sending email !";
						            	}
						            	else{
					            			$this->db->trans_commit();
					            			$status = 'success';
											$msg = "Gift Claim success !";
										}
					            }
			            	}
			            	else{
			            		$giftDetail = $this->TGift_model->getTGiftDetail($query);
			            		if(!$this->sendEmailGiftClaim($username, $giftDetail)){
					            		show_error($this->email->print_debugger());
					            		$this->db->trans_rollback();
					            		$status = 'error';
										$msg = "Gift Claim fail, something went wrong when sending email !";
					            	}
					            	else{
				            			$this->db->trans_commit();
				            			$status = 'success';
										$msg = "Gift Claim success !";
									}
			            		
			            	}

			            }
		            }
				}
				echo json_encode(array('status' => $status, 'msg' => $msg));
			}
			else{
        		echo json_encode("empty");
			}
			
		}

		function sendEmailGiftClaim($username, $giftDetail){

			$user = $this->User_model->getUserDetailByUsername($username);
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

            $data['detail_user'] = $user;
            $data['detail_gift_claim'] = $giftDetail;
            $data['title'] = "TOPPON - Konfirmasi Gift Claim";
            $data['content']="email/gift_email_view";
            $message = $this->load->view('email/template_view',$data,true);

            
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('no-reply@toppon.co.id', 'Feedback System'); // nanti diganti dengan email sistem toppon
            $this->email->to($user->email); // email user

            $this->email->subject('[TOPPON] GIFT CLAIM CONFIRMATION');
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