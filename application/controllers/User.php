<?php  
	class User extends CI_Controller{
		function __construct(){
			parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->helper('html');
	    $this->load->library("pagination");
	    $this->load->library('form_validation');
	    
	    $this->load->library('Hash');
	    $this->load->model('User_model');
		}

		function index(){
			if(!$this->session->userdata('logged_in')){
            	$this->loginAndRegister();
        	}
        	else{
        		$this->dashboard();
        	}
        	
		}
		function loginAndRegister($errorParam = null, $whereAt = null){
			if(!$this->session->userdata('logged_in')){
				if($errorParam == null){
					$data['error_param']="";
					$data['where_at']="";
					$this->load->view('login_view', $data);
				}
				else{
					$data['error_param']=$errorParam;
					$data['where_at']=$whereAt;
					$this->load->view('login_view', $data);
				}
			}
			else{
				redirect($this->dashboard());
			}
		}

		function dashboard(){
			if(!$this->session->userdata('logged_in')){
				redirect($this->loginAndRegister());
			}
			else{
                $data['data_content']="member/dashboard_view";
				$this->load->view('includes/member_area_template_view',$data);
			}
			
		}

		function doRegisMember(){
			$datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

			$username = $this->input->post('username-regis');
			$name = $this->input->post("name-regis");
			$email = $this->input->post("email-regis");
			$phone = $this->input->post("phone-regis");
			$password = $this->input->post("conf-password-regis");

			$userVerify = $this->User_model->checkUsername($username);
			$emailVerify = $this->User_model->checkEmail($email);
			$phoneVerify = $this->User_model->checkPhone($phone);

			if($userVerify == 0 && $emailVerify == 0 && $phoneVerify == 0){
				$data_regis = array(
						'username' => $username,
						'name' => $name,
						'email' => $email,
						'phoneNumber' => $phone,
						'password' => $this->hash->hashPass($password),
						'userLevel' => "member",
						'isActive' => '1',
						'created' => $datetime,
						'createdBy' => $username,
						'lastUpdated' => $datetime,
						'lastUpdatedBy' => $username
					);

				$this->db->trans_begin();
				$query = $this->User_model->createUser($data_regis);

				if ($this->db->trans_status() === FALSE) {
	                // Failed to save Data to DB
	                $this->db->trans_rollback();
	                $this->loginAndRegister('Error while saved Tag data!','register');
	            }
	            else{
	            	$this->db->trans_commit();
	                $status = 'success';
	                $msg = "user has been created successfully";

	                redirect($this->dashboard());
	            }
        	}
        	else if($userVerify == 1){
        		$this->loginAndRegister('Username already exists','register');
        	}else if($emailVerify == 1){
        		$this->loginAndRegister('Email already exists','register');
        	}else if($phoneVerify == 1){
        		$this->loginAndRegister('Phone already exists','register');
        	}
		}

		function doLoginMember(){
			$datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

			$username = $this->input->post('username-login');
			$password = $this->input->post('password-login');

			$userVerifier = $this->User_model->checkUsername($username);
	        $passVerifier = $this->User_model->getUsernamePassword($username);
	        
	        if(!$userVerifier){
	            $result = 0;
	            //echo "username ga ada";
	            $this->loginAndRegister("Username / Password wrong", "login"); 
	        }
	        else if($this->hash->verifyPass($password, $passVerifier->password)){
	            $result = 1; 
	           // echo "username ada dan password benar"; 
	            $newdata = array(
                   'username'  => $passVerifier->userName,
                   'user_id'  => $passVerifier->userID,
                   'level'     => $passVerifier->userLevel,
                   'logged_in' => TRUE
               );
				$this->session->set_userdata($newdata);

	            $this->dashboard();
	        }else{
	            $result = 0; 
	            //echo "username ada tapi password salah"; 
	         	$this->loginAndRegister("Username / Password wrong", "login");
	        }
		}

		function doLogoutMember(){
			$this->session->sess_destroy();
         	redirect($this->index());
		}

		function doForgotPassword(){
			$datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

			$username = $this->input->post('username-forgot');
			$userVerifier = $this->User_model->checkUsername($username);

			if(!$userVerifier){
	            $result = 0;
	            //echo "username ga ada";
	            $this->loginAndRegister("Username doesn't exists", "forgot"); 
	        }
	        else{
	        	//kirim email disini

	        	$this->loginAndRegister("Please Check Your Email", "forgot"); 
	        }

		}

	}
?>