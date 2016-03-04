<?php 
	class Gift extends CI_Controller{
		function __construct(){
			parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->helper('html');
	    $this->load->library("pagination");
	    $this->load->library('form_validation');

	    $this->load->model("SGift_model");
	    $this->load->model("TGift_model");
	    $this->load->model('SAccount_model');	    
		}

		function index(){
			if(!$this->session->userdata('logged_in')){
            	redirect(site_url("User/loginAndRegister"));
	        }
	        else{
	        	$data['gifts']=$this->SGift_model->getGiftList();
	            $data['data_content']="member/gift_view";
            	$this->load->view('includes/member_area_template_view',$data);
	        }
		}		

		function doClaimGift(){
			$datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil
			$giftID = $this->input->post('giftID');
			$verifyGift = $this->SGift_model->getGiftDetail($giftID);
			$userSenderPoin = $this->SAccount_model->getMyAccount($this->session->userdata('user_id'));

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
					'createdBy' => $this->session->userdata('user_id'),
					'lastUpdated' => $datetime,
					'lastUpdatedBy' => $this->session->userdata('user_id')
				);

				$this->db->trans_begin();
				$query = $this->TGift_model->createClaimGiftsLog($data_gift);

				if ($this->db->trans_status() === FALSE) {
	                // Failed to save Data to DB
	                $this->db->trans_rollback();
	                $status = 'error';
					$msg = "Gift Claim fail, something went wrong when adding transaction data. Please try again !";
	            }else{
	            	$query2 = $this->SAccount_model->subtractionPoin($this->session->userdata('user_id'), $verifyGift->poin);
		            	
		            if ($this->db->trans_status() === FALSE) {
		                // Failed to save Data to DB
		                $this->db->trans_rollback();
		                $status = 'error';
						$msg = "Gift Claim fail, something went wrong when substracting your poin. Please try again !";
		            }else{

		            	if($verifyGift->giftCategory == "TopponCoin"){
		            		$query3 = $this->SAccount_model->additionCoin($this->session->userdata('user_id'), $verifyGift->reward);
		            		if ($this->db->trans_status() === FALSE) {
				                // Failed to save Data to DB
				                $this->db->trans_rollback();
				                $status = 'error';
								$msg = "Gift Claim fail, something went wrong when your friend coin. Please try again !";
				            }
				            else{
				            	$this->db->trans_commit();
				            	$status = 'success';
								$msg = "Gift Claim success !";
				            }
		            	}
		            	else{
		            		$this->db->trans_commit();
			            	$status = 'success';
							$msg = "Gift Claim success !";
		            	}

		            }
	            }
				
			}			
			echo json_encode(array('status' => $status, 'msg' => $msg));
		}

	}
?>