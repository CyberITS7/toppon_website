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

		/*Transaction Purposes*/
		function index($start=1){
			if(!$this->session->userdata('logged_in')){
            	redirect(site_url("User/loginAndRegister"));
	        }
	        else{
	        	$num_per_page = 10;
            	$start = ($start - 1)* $num_per_page;
            	$limit = $num_per_page;

            	$gift_page = $this->SGift_model->getGiftList($start, $limit);
            	$count_gift = $this->SGift_model->getCountGiftList();

            	$config['base_url']= site_url('Gift/index');

            	$config['total_rows'] = $count_gift;
		        $config['per_page']=$num_per_page;
		        $config['use_page_numbers']=TRUE;
		        $config['uri_segment']=3;
		        $this->pagination->initialize($config);
		        $data['pages'] = $this->pagination->create_links();
				
				$data['gifts']= $gift_page;
				if ($this->input->post('ajax')){
	                $this->load->view('member/gift_view', $data);
	            }else{
	            	$data['data_content']="member/gift_view";
	                $this->load->view('includes/member_area_template_view',$data);
	            }	            
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
		/*Transaction Purposes end here*/

		/*Setting Purposes to Gift Category*/
		function settingGiftList($start=1){
			$user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
			if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
				redirect(site_url("User/loginAndRegister"));	
			}
			else{
				$num_per_page = 10;
            	$start = ($start - 1)* $num_per_page;
            	$limit = $num_per_page;

            	$giftCategory_page = $this->GiftCategory_model->getGiftCategoryList($start, $limit);
            	$count_giftCategory = $this->GiftCategory_model->getCountGiftCategoryList();

            	$config['total_rows'] = $count_giftCategory;
		        $config['per_page']=$num_per_page;
		        $config['use_page_numbers']=TRUE;
		        $config['uri_segment']=3;
		        $this->pagination->initialize($config);
		        $data['pages'] = $this->pagination->create_links();
				
				$data['giftCategory']= $giftCategory_page;
				if ($this->input->post('ajax')){
	                $this->load->view('admin/gift_category_list_view', $data);
	            }else{
	            	$data['data_content']="admin/gift_category_list_view";
	                $this->load->view('includes/member_area_template_view',$data);
	            }
			}
		}

	}
?>