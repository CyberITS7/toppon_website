<?php  
	class User extends CI_Controller{
		function __construct(){
			parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->helper('html');
	    $this->load->library("pagination");
	    $this->load->library('form_validation');
	    $this->load->library('email');
	    
	    $this->load->library('Hash');
	    $this->load->model('User_model');
	    $this->load->model('SAccount_model');
	    $this->load->library("Authentication");
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
                $this->load->model('GameCategory_model');
                $data['game_category'] = $this->GameCategory_model->getGameCategoryList(null, null);
                $data['data_content']="member/dashboard_view";
				$this->load->view('includes/member_area_template_view',$data);
			}
		}

		function editProfile(){
			if(!$this->session->userdata('logged_in')){
				redirect($this->loginAndRegister());
			}
			else{
				$data['data_detail']=$this->User_model->getUserDetailByUsername($this->session->userdata("username"));
                $data['data_content']="admin/edit_profile_view";
				$this->load->view('includes/member_area_template_view',$data);
			}
		}

		function resetPassword(){
			$user = $this->input->get('k');

			$i = 0;
			$flag = false;
			$userverify = $this->User_model->getMemberList(null, null);
			$userscount = $this->User_model->getCountMemberList();

			$thisUserID;
			while ($i != $userscount) {
				if($this->hash->verifyPass($userverify[$i]['userName'], $user)){
					$flag = true;
					$thisUserID = $userverify[$i]['userID'];

				}	
				$i++;
			}
			
			if($flag){
				$data['data_userID']=$thisUserID;
				$this->load->view('reset_password_view', $data);
			}
			else{
				$this->load->view('invalid_reset_password_view');
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
	                $this->loginAndRegister('Error while save data!','register');
	            }
	            else{

	            	$data_account= array(
	            		'userID' => $query,
	            		'poin' => 0,
	            		'coin' => 0,
	            		'isActive' => '1',
						'created' => $datetime,
						'createdBy' => $username,
						'lastUpdated' => $datetime,
						'lastUpdatedBy' => $username
	            	);

	            	$query2 = $this->SAccount_model->addSAccount($data_account);

	            	if ($this->db->trans_status() === FALSE) {
		                // Failed to save Data to DB
		                $this->db->trans_rollback();
		                $this->loginAndRegister('Error while save data!','register');
		            }
		            else{
		            	

		            	if(!$this->sendAfterRegistration($username)){
			        		//show_error($this->email->print_debugger());
			        		$this->loginAndRegister('There\'s soething wrong when sending email','register');
			        	}
			        	else{
			        		$this->db->trans_commit();
		                	$status = 'success';
		                	$msg = "user has been created successfully";
		                	$this->loginAndRegister();
		            	}
		            }
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

		function doRegisAjaxMember(){
			$status = "";
            $msg = "";
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
	                $status = 'error';
                	$msg = "Something went wrong when saving data";
	            }
	            else{

	            	$data_account= array(
	            		'userID' => $query,
	            		'poin' => 0,
	            		'coin' => 0,
	            		'isActive' => '1',
						'created' => $datetime,
						'createdBy' => $username,
						'lastUpdated' => $datetime,
						'lastUpdatedBy' => $username
	            	);

	            	$query2 = $this->SAccount_model->addSAccount($data_account);

	            	if ($this->db->trans_status() === FALSE) {
		                // Failed to save Data to DB
		                $this->db->trans_rollback();
		                $status = 'error';
                		$msg = "Something went wrong when saving data";
		            }
		            else{
		            	

		            	if(!$this->sendAfterRegistration($username)){
			        		$status = 'error';
                			$msg = "Something went wrong when sending email";
			        	}
			        	else{
			        		$this->db->trans_commit();
		                	$status = 'success';
		                	$msg = "user has been created successfully";
		            	}
		            }
	            }
        	}
        	else if($userVerify == 1){
        		$status = 'error';
                $msg = "Username already exists";
        	}else if($emailVerify == 1){
        		$status = 'error';
                $msg = "Email already exists";
        	}else if($phoneVerify == 1){
        		$status = 'error';
                $msg = "Phone Number already exists";
        	}
        	echo json_encode(array('status' => $status, 'msg' => $msg));
		}

		function doLoginMember(){
			$datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

			$username = $this->input->post('username-login');
			$password = $this->input->post('password-login');

			$userVerifier = $this->User_model->checkUsername($username);
	        $passVerifier = $this->User_model->getPasswordbyUsername($username);
	        
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

		function doLoginAjaxMember(){
			$datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

			$username = $this->input->post('username-login');
			$password = $this->input->post('password-login');
			$newdata = array(
                 'logged_in' => FALSE
				);

			$userVerifier = $this->User_model->checkUsername($username);
	        $passVerifier = $this->User_model->getPasswordbyUsername($username);
	        
	        if($username == "" || $username == null || $password == "" || $password == null){
	        	$status = 'error';
                $msg = "Username or Password null";
	        }
	        else if(!$userVerifier){
	            $status = 'error';
                $msg = "Username or Password wrong";
	        }
	        else if($this->hash->verifyPass($password, $passVerifier->password)){
	            
	            $newdata = array(
                   'username'  => $passVerifier->userName,
                   'user_id'  => $passVerifier->userID,
                   'level'     => $passVerifier->userLevel,
                   'logged_in' => TRUE
               );

	            $status = 'success';
                $msg = "Login Successfully";
	        }else{
	            
	         	$status = 'error';
                $msg = "Username or Password wrong";
	        }

	        echo json_encode(array('status' => $status, 'msg' => $msg, 'userdata' => $newdata));
	        //echo json_encode('msg' => $msg);
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
	        	if(!$this->sendEmailForgotPassword($username)){
	        		show_error($this->email->print_debugger());
	        	}
	        	
	        	$this->loginAndRegister("Please Check Your Email", "forgot"); 
	        }

		}
		
		function doForgotPasswordAjax(){
			$datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

			$username = $this->input->post('username-forgot');
			$userVerifier = $this->User_model->checkUsername($username);

			if(!$userVerifier){
	            $status = 'error';
                $msg = "Username doesn't exists ";
	        }
	        else{
	        	//kirim email disini
	        	if(!$this->sendEmailForgotPassword($username)){
	        		$status = 'error';
                	$msg = "Something went wrong when sending email";
	        		//show_error($this->email->print_debugger());
	        	}else{
	        		$status = 'success';
                	$msg = "PLease check your email";
	        	}
	        }
	        echo json_encode(array('status' => $status, 'msg' => $msg));
		}

		function doResetPassword(){
			$datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

			$userID = $this->input->post("userID");
			$password = $this->input->post("conf-password-reset-password");
			$data_user = array(
				'password' => $this->hash->hashPass($password),
				'lastUpdated' => $datetime,
				'lastUpdatedBy' => $userID
			);

			$this->db->trans_begin();
			$query = $this->User_model->updateUser($data_user, $userID);

			if ($this->db->trans_status() === FALSE) {
                // Failed to save Data to DB
                $this->db->trans_rollback();
                $this->loginAndRegister('Error while save data!','forgot');
            }
            else{
            	$this->db->trans_commit();
            	$this->loginAndRegister('Password has been reset!','login');
            }


		}

		function doUpdateUserProfile(){
			$status = "";
	        $msg="";

	        $datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

			$username = $this->input->post('username');
			$name = $this->input->post("name");
			$email = $this->input->post("email");
			$phone = $this->input->post("phone");
			$isUpdatePassword = $this->input->post("is_update_pass");
			$oldPassword = $this->input->post("old_pass");
			$newPassword = $this->input->post("new_pass");

			$userVerify = $this->User_model->checkUsernameExceptSelf($username, $this->session->userdata("user_id"));
			$emailVerify = $this->User_model->checkEmailExceptSelf($email, $this->session->userdata("user_id"));
			$phoneVerify = $this->User_model->checkPhoneExceptSelf($phone, $this->session->userdata("user_id"));
			$passVerifier = $this->User_model->getPasswordbyUsername($this->session->userdata("username"));

			if($userVerify == 1){
				$status = 'error';
                $msg = "Username already exists";
        	}else if($emailVerify == 1){
        		$status = 'error';
                $msg = "Email already exists";
        	}else if($phoneVerify == 1){
        		$status = 'error';
                $msg = "Phone already exists";
        	}else if($isUpdatePassword == "TRUE"){
        		if(!$this->hash->verifyPass($oldPassword, $passVerifier->password)){
        			$status = 'error';
                	$msg = "Old Password doesn't match";
        		}else{
        			$data_user = array(
						'username' => $username,
						'name' => $name,
						'email' => $email,
						'phoneNumber' => $phone,
						'password' => $this->hash->hashPass($newPassword),
						'lastUpdated' => $datetime,
						'lastUpdatedBy' => $this->session->userdata("user_id")
					);

					$this->db->trans_begin();
					$query = $this->User_model->updateUser($data_user, $this->session->userdata('user_id'));

					if ($this->db->trans_status() === FALSE) {
		                // Failed to save Data to DB
		                $this->db->trans_rollback();
		                $status = 'error';
                		$msg = "Something went wrong when updating profile";
		            }
		            else{
		            	$this->db->trans_commit();
		            	$status = 'success';
                		$msg = "Successfully update your profile";
		            }
        		}
        	}
        	else{
        		$data_user = array(
						'username' => $username,
						'name' => $name,
						'email' => $email,
						'phoneNumber' => $phone,						
						'lastUpdated' => $datetime,
						'lastUpdatedBy' => $this->session->userdata("user_id")
					);

					$this->db->trans_begin();
					$query = $this->User_model->updateUser($data_user, $this->session->userdata('user_id'));

					if ($this->db->trans_status() === FALSE) {
		                // Failed to save Data to DB
		                $this->db->trans_rollback();
		                $status = 'error';
                		$msg = "Something went wrong when updating profile";
		            }
		            else{
		            	$this->db->trans_commit();
		            	$status = 'success';
                		$msg = "Successfully update your profile";
		            }
        	}

        	echo json_encode(array('status' => $status, 'msg' => $msg));
		}

		function sendEmailForgotPassword($username){
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
            $data['hashkey'] = $this->hash->hashPass($user->userName);
            $data['title'] = "TOPPON - Konfirmasi Reset Password";
            $data['content']="email/reset_password_view";
            $message = $this->load->view('email/template_view',$data,true);

            
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('no-reply@toppon.co.id', 'Feedback System'); // nanti diganti dengan email sistem toppon
            $this->email->to($user->email); // email user

            $this->email->subject('[TOPPON] FORGOT PASSWORD CONFIRMATION');
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

        function sendAfterRegistration($username){
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
            $data['title'] = "TOPPON - Selamat Datang";
            $data['content']="email/after_create_user_email_view";
            $message = $this->load->view('email/template_view',$data,true);

            
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('no-reply@toppon.co.id', 'Feedback System'); // nanti diganti dengan email sistem toppon
            $this->email->to($user->email); // email user

            $this->email->subject('[TOPPON] WELCOME');
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

		function getUserCoins(){
			
            $userID = $this->session->userdata("user_id");
            $akunku = $this->SAccount_model->getMyAccount($userID);

            echo json_encode(array('toppon_coin' => $akunku->coin, 'toppon_poin' => $akunku->poin));
		}

		/*Super Admin Section*/
		function memberList($start=1){
			$user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
			if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
				redirect(site_url("User/loginAndRegister"));	
			}
			else{
		        $member_page = $this->User_model->getMemberList(null, null);
		        $data['members']= $member_page;

		        if ($this->input->post('ajax')){
		            $this->load->view('admin/member_list_view', $data);
		        }else{
		            $data['data_content'] = 'admin/member_list_view';
		            $this->load->view('includes/member_area_template_view',$data);
		        }
			}
		}

		function sAccountList($start=1){
			$user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
			if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
				redirect(site_url("User/loginAndRegister"));	
			}
			else{
				//get S Account List data
				//$this->output->enable_profiler(TRUE);
		        $account_page = $this->SAccount_model->getSAccountList(null, null);
		        $data['accounts']= $account_page;

		        if ($this->input->post('ajax')){
		            $this->load->view('admin/setting/setting_account_list_view', $data);
		        }else{
		            $data['data_content'] = 'admin/setting/setting_account_list_view';
		            $this->load->view('includes/member_area_template_view',$data);
		        }
			}
		}

		function doUpdateMember(){
			$status = "";
	        $msg="";

	        $datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

	        $userID = $this->input->post("id");
			$username = $this->input->post('username');
			$level = $this->input->post('level');
			$name = $this->input->post("name");
			$email = $this->input->post("email");
			$phone = $this->input->post("phone_number");			

			$userVerify = $this->User_model->checkUsernameExceptSelf($username, $userID);
			$emailVerify = $this->User_model->checkEmailExceptSelf($email, $userID);
			$phoneVerify = $this->User_model->checkPhoneExceptSelf($phone, $userID);

			if($userVerify == 1){
				$status = 'error';
                $msg = "Username already exists";
        	}else if($emailVerify == 1){
        		$status = 'error';
                $msg = "Email already exists";
        	}else if($phoneVerify == 1){
        		$status = 'error';
                $msg = "Phone already exists";
        	}
        	else{
        		$data_user = array(
						'username' => $username,
						'userLevel' => $level,
						'name' => $name,
						'email' => $email,
						'phoneNumber' => $phone,						
						'lastUpdated' => $datetime,
						'lastUpdatedBy' => $this->session->userdata("user_id")
					);

					$this->db->trans_begin();
					$query = $this->User_model->updateUser($data_user, $userID);

					if ($this->db->trans_status() === FALSE) {
		                // Failed to save Data to DB
		                $this->db->trans_rollback();
		                $status = 'error';
                		$msg = "Something went wrong when updating member info";
		            }
		            else{
		            	$this->db->trans_commit();
		            	$status = 'success';
                		$msg = "Successfully update member info";
		            }
        	}

        	echo json_encode(array('status' => $status, 'msg' => $msg));
		}

		function doUpdateSAccount(){
			$status = "";
	        $msg="";

	        $datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

	        $accountID = $this->input->post("id");
			$username = $this->input->post('username');
			$poin = $this->input->post("poin");
			$coin = $this->input->post("coin");

			$userVerify = $this->SAccount_model->checkUsernameBySACoountID($accountID, $username);			

			if($userVerify != 1){
				$status = 'error';
                $msg = "Username dosen't match account id";
        	}
        	else{
        		$data_user = array(						
						'coin' => $coin,
						'poin' => $poin,
						'lastUpdated' => $datetime,
						'lastUpdatedBy' => $this->session->userdata("user_id")
					);

					$this->db->trans_begin();
					$query = $this->SAccount_model->updateAccount($data_user, $accountID);

					if ($this->db->trans_status() === FALSE) {
		                // Failed to save Data to DB
		                $this->db->trans_rollback();
		                $status = 'error';
                		$msg = "Something went wrong when updating account info";
		            }
		            else{
		            	$this->db->trans_commit();
		            	$status = 'success';
                		$msg = "Successfully update account info";
		            }
        	}

        	echo json_encode(array('status' => $status, 'msg' => $msg));
		}

		function doDeleteMember(){
			$status = "";
	        $msg="";

	        $datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

	        $userID = $this->input->post("id");

	        $data_user = array(
				'isActive' => 0,						
				'lastUpdated' => $datetime,
				'lastUpdatedBy' => $this->session->userdata("user_id")
			);

			$this->db->trans_begin();
			$query = $this->User_model->updateUser($data_user, $userID);

			if ($this->db->trans_status() === FALSE) {
                // Failed to save Data to DB
                $this->db->trans_rollback();
                $status = 'error';
        		$msg = "Something went wrong when deleting member";
            }
            else{
            	$this->db->trans_commit();
            	$status = 'success';
        		$msg = "Successfully delete member";
            }

            echo json_encode(array('status' => $status, 'msg' => $msg));
		}
		/*Super Admin Section*/
		
		  //Mobile
		function getUserAccountMobile(){
			$userID = $this->input->post("userID");
			$akunku = $this->SAccount_model->getMyAccount($userID);

            //print_r($akunku);
			echo json_encode(array('coin' => $akunku->coin, 'poin' => $akunku->poin));
		}
	}
?>