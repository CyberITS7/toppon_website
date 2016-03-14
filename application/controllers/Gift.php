<?php 
	class Gift extends CI_Controller{
		function __construct(){
			parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->helper('html');
	    $this->load->library("pagination");
	    $this->load->library('form_validation');

	    $this->load->library('upload');
	    $this->load->model("SGift_model");
	    $this->load->model("TGift_model");
	    $this->load->model('SAccount_model');
	    $this->load->model('User_model');
	    $this->load->library("Authentication");
	    $this->load->model("GiftCategory_model");
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
				//get Setting gift data
	            $num_per_page = 10;
	            $start = ($start - 1)* $num_per_page;
	            $limit = $num_per_page;

	            $gift_page = $this->SGift_model->getAdminGiftList($start, $limit);
            	$count_gift = $this->SGift_model->getCountAdminGiftList();

	            $config['base_url']= site_url('Gift/settingGiftList');
	            $config ['total_rows'] = $count_gift;
	            $config ['per_page']=$num_per_page;
	            $config['use_page_numbers']=TRUE;
	            $config['uri_segment']=3;

	            $this->pagination->initialize($config);
	            $data['pages'] = $this->pagination->create_links();
	            $data['gifts']= $gift_page;

	            // for gift category combo
		        $data['gift_categories']=$this->GiftCategory_model->getAllGiftCategory();

	            if ($this->input->post('ajax')){
	                $this->load->view('admin/setting/setting_gift_list_view', $data);
	            }else{
	                $data['data_content'] = 'admin/setting/setting_gift_list_view';
	                $this->load->view('includes/member_area_template_view',$data);
	            }
			}
		}

		function createGift(){
	        $status = "";
	        $msg="";

	        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
	        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
	            redirect(site_url("User/loginAndRegister"));
	        }else {
	            $datetime = date('Y-m-d H:i:s', time());
	            $gift_category = $this->input->post('gift_category');
	            $gift_name = $this->input->post('gift_name');
	            $gift_desc = $this->input->post('gift_desc');
	            $poin = $this->input->post('gift_poin');
	            $img = $_FILES['img'];
	            $reward = $this->input->post('gift_reward');
	            $userID = $this->session->userdata('user_id');

	            $data_post = array(
	                'giftCategoryID' => $gift_category,
	                'giftName' => $gift_name,
	                'giftDescription' => $gift_desc	,
	                'poin' => $poin,
	                'image' => $img['name'],
	                'reward' => $reward,
	                'isActive' => 1,
	                "created" => $datetime,
	                "createdBy" => $userID,
	                "lastUpdated" => $datetime,
	                "lastUpdatedBy" => $userID
	            );

	            $dir = "./img/gifts";
	            //config upload Image
	            $config['upload_path'] = $dir;
	            $config['allowed_types'] = 'jpg|png';
	            $config['max_size'] = 1024 * 5;
	            $config['overwrite'] = 'TRUE';
	            $this->upload->initialize($config);

	            $this->db->trans_begin();
	            $id = $this->SGift_model->createGift($data_post);

	            if ($id != null || $id != "") {
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
	                    $msg = "Gift has been created successfully!";
	                }
	            } else {
	                $this->db->trans_rollback();
	                $status = 'error';
	                $msg = "Cannot Save to Database";
	            }
	            
	        }

	        echo json_encode(array('status' => $status, 'msg' => $msg));
	    }

	    function updateGift(){
	        $status = "";
	        $msg="";

	        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
	        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
	            redirect(site_url("User/loginAndRegister"));
	        }else {
	            $datetime = date('Y-m-d H:i:s', time());
	            $gift_category = $this->input->post('gift_category');
	            $gift_name = $this->input->post('gift_name');
	            $gift_desc = $this->input->post('gift_desc');
	            $poin = $this->input->post('gift_poin');
	            $isUpdateImg = $this->input->post('isUpdateImg');
	            $userID = $this->session->userdata('user_id');
	            $reward = $this->input->post('gift_reward');
	            $giftID = $this->input->post('id');

                $data_post = array(
	                'giftCategoryID' => $gift_category,
	                'giftName' => $gift_name,
	                'giftDescription' => $gift_desc	,
	                'poin' => $poin,
	                'reward' => $reward,
	                "lastUpdated" => $datetime,
	                "lastUpdatedBy" => $userID
	            );

                if ($isUpdateImg == 1) {
                    $data_post['image'] = $_FILES['img']['name'];
                    $dir = "./img/gifts";
                    //config upload Image
                    $config['upload_path'] = $dir;
                    $config['allowed_types'] = 'jpg|png';
                    $config['max_size'] = 1024 * 5;
                    $config['overwrite'] = 'TRUE';
                    $this->upload->initialize($config);

                    $this->db->trans_begin();
                    $update = $this->SGift_model->updateGift($data_post, $giftID);

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
                            $msg = "Gift has been updated successfully!";
                        }
                    } else {
                        $this->db->trans_rollback();
                        $status = 'error';
                        $msg = "Cannot Save to Database";
                    }
                } else {
                    $this->db->trans_begin();
                    $update = $this->SGift_model->updateGift($data_post, $giftID);

                    if ($update) {
                        $this->db->trans_commit();
                        $status = 'success';
                        $msg = "Gift has been updated successfully!";
                    } else {
                        $this->db->trans_rollback();
                        $status = 'error';
                        $msg = "Gift can't be updated!";
                    }
                }
	        }
	        echo json_encode(array('status' => $status, 'msg' => $msg));
	    }

    	function deleteGift(){
	        $status = "";
	        $msg="";

	        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
	        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
	            redirect(site_url("User/loginAndRegister"));
	        }else {
	            $datetime = date('Y-m-d H:i:s', time());
	            $giftID = $this->input->post('id');
	            $userID = $this->session->userdata('user_id');

	            $data_post = array(
	                'isActive' => 0,
	                "created" => $datetime,
	                "lastUpdated" => $datetime,
	                "lastUpdatedBy" => $userID
	            );

	            $this->db->trans_begin();
	            $update = $this->SGift_model->updateGift($data_post, $giftID);

	            if ($update) {
	                $this->db->trans_commit();
	                $status = 'success';
	                $msg = "Gift has been deleted successfully!";
	            } else {
	                $this->db->trans_rollback();
	                $status = 'error';
	                $msg = "Gift can't be delete!";
	            }
	        }
	        echo json_encode(array('status' => $status, 'msg' => $msg));
	    }
	}
?>