<?php  
	class GiftCategory extends CI_Controller{
		function __construct(){
			parent::__construct();

			$this->load->helper(array('form', 'url'));
			$this->load->helper('date');
			$this->load->helper('html');
		    $this->load->library("pagination");
		    $this->load->library('form_validation');
		    
		    $this->load->library("Authentication");
		    $this->load->model("User_model");
		    $this->load->model("GiftCategory_model");
		}

		function index($start=1){
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

            	$config['base_url']= site_url('GiftCategory/index');

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

		function createGiftCategory(){
	        $status = "";
	        $msg="";

	        $datetime = date('Y-m-d H:i:s', time());
	        $name = $this->input->post('name');        
	        $userID = $this->session->userdata('user_id'); 
	        $check_name = $this->GiftCategory_model->checkGiftCategory($name);

	        if(!$check_name){
	            $data_post=array(
	                'giftCategory'=>$name,
	                'isActive'=>1,
	                "created" => $datetime,
	                "createdBy" => $userID,
	                "lastUpdated"=>$datetime,
	                "lastUpdatedBy"=>$userID
	            );

	            $this->db->trans_begin();
	            $query = $this->GiftCategory_model->createGiftCategory($data_post);
	            if($query > 0){
					$this->db->trans_commit();
                	$status = 'success';
                	$msg = "Gift Category has been created successfully!";
                }
                else{
                	$this->db->trans_rollback();
                	$status = 'error';
                	$msg = "Something went wrong when saving Gift Category !";	
                }

	        }else{
	            $status = 'error';
	            $msg = $name." already exist";
	        }

	        echo json_encode(array('status' => $status, 'msg' => $msg));
	    }

	    function updateGiftCategory(){
	        $status = "";
	        $msg="";

	        $datetime = date('Y-m-d H:i:s', time());
	        $name = $this->input->post('name');
	        $userID = $this->session->userdata('user_id');
	        $giftCategoryID = $this->input->post('id');
	        $check_name = $this->GiftCategory_model->checkGiftCategory($name);

	        if(!$check_name){
	            $data_post=array(
	                'giftCategory'=>$name,
	                "lastUpdated"=>$datetime,
	                "lastUpdatedBy"=>$userID
	            );

	            $this->db->trans_begin();
	            $update = $this->GiftCategory_model->updateGiftCategory($data_post,$giftCategoryID);

	            if($update){
	                $this->db->trans_commit();
	                $status = 'success';
	                $msg = "Gift Category has been updated successfully!";
	            }else{
	                $this->db->trans_rollback();
	                $status = 'error';
	                $msg = "Something went wrong when updating Gift Category !";
	            }

	        }else{
	            $status = 'error';
	            $msg = $name." already exist";
	        }

	        echo json_encode(array('status' => $status, 'msg' => $msg));
	    }

	    function deleteGiftCategory(){
	        $status = "";
	        $msg="";

	        $datetime = date('Y-m-d H:i:s', time());
	        $giftCategoryID = $this->input->post('id');
	        $userID = $this->session->userdata('user_id');

	        $data_post=array(
	            'isActive'=>0,
	            "lastUpdated"=>$datetime,
	            "lastUpdatedBy"=>$userID
	        );

	        $this->db->trans_begin();
	        $update = $this->GiftCategory_model->updateGiftCategory($data_post,$giftCategoryID);

	        if($update){
	            $this->db->trans_commit();
	            $status = 'success';
	            $msg = "Gift Category has been updated successfully!";
	        }else{
	            $this->db->trans_rollback();
	            $status = 'error';
	            $msg = "Something went wrong when updating Gift Category !";
	        }

	        echo json_encode(array('status' => $status, 'msg' => $msg));
	    }
	}
?>