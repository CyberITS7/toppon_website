<?php
class DepositMobile extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->library("Authentication");
        $this->load->library('email');

        $this->load->library('Hash');
        $this->load->model('Bank_model');
        $this->load->model('Coin_model');
        $this->load->model('TDeposit_model');
        $this->load->model('User_model');
        $this->load->model('SAccount_model');

    }

   function coinListAjax(){
		$userID = $this->input->post('userID');
		if($userID!=null){
			$coin_list = $this->Coin_model->getCoin();
			$bank_list = $this->Bank_model->getBankName();
			echo json_encode(array('dataCoin' => $coin_list, 'dataBank' => $bank_list));
		}
		else{
			$coin_list = "empty";
			 echo json_encode($coin_list);
		}        
    }

    function depositListAjax(){
		$userID = $this->input->post('userID');

		if($userID!= null){
			$topUp_list = $this->TDeposit_model->getListTDepositMobile($userID);
			echo json_encode(array('dataTopUp' => $topUp_list));
		}
		else{
			$topUp_list="empty";
			echo json_encode($topUp_list);
		}
    }

    function depositInsertForm() {
        if(!$this->input>post('logged_in')){
            redirect(site_url("User/dashboard"));
        }
        else{
            $data['bank_list']=$this->Bank_model->getBankName();
            $data['coin_list']=$this->Coin_model->getCoin();
            $data['data_content']="member/deposit_insert_view";
            $this->load->view('includes/member_area_template_view',$data);
        }
    }

    function depositDetail($id) {
        if(!$this->input>post('logged_in')){
            redirect(site_url("User/dashboard"));
        }
        else{
            $data['deposit_detail']=$this->TDeposit_model->getTDepositDetail($id);
            $data['data_content']="member/deposit_detail_view";
            $this->load->view('includes/member_area_template_view',$data);
        }
    }

    function topUpDeposit() {
            $datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

            $username = $this->input->post("username");
            $userID = $this->input->post("userID");
            $noRekening = $this->input->post("postNoRekening");
            $namaRekening = $this->input->post("postNamaRekening");
            $namaBank = $this->input->post("postNamaBank");
            $topponCoinID = $this->input->post("postTopponCoinID");
            //$topponCoin = $this->input->post("postCoinConversion");

            //Ambil data Coin dan Bank yang Asli
            //$data_bank = $this->Bank_model->getBankByID($namaBank);
            $data_coin = $this->Coin_model->getCoinByID($topponCoinID);

            if($noRekening == null || $noRekening == ""){
                $status = 'error';
                $msg = "Top Up fail, Nomor Rekening empty !";
            }
            else if($namaRekening == null || $namaRekening == ""){
                $status = 'error';
                $msg = "Top Up fail, Nama Rekening empty !";   
            }
            else{

                $data = array(
                        'noRekening' => $noRekening,
                        'nameRekening' => $namaRekening,
                        'bankName' => $namaBank,
                        'coin' => $data_coin->coin,
                        'coinConversion' => $data_coin->coinConversion,
                        'isVisible' => 1,
                        'isActive' => 1,
                        'poin' => $data_coin->poin,
                        'kodeUnik' => '111',
                        'status' => 'unpaid',
                        'created' => $datetime,
                        'createdBy' => $userID,
                        'lastUpdated' => $datetime,
                        'lastUpdatedBy' => $userID

                    );

                        $this->db->trans_begin();
                        $query = $this->TDeposit_model->insertDeposit($data);
                        $topUpDetail = $this->TDeposit_model->getTDepositDetail($query);

                        if ($this->db->trans_status() === FALSE) {
                            // Failed to save Data to DB
                            $this->db->trans_rollback();
                            $status = 'error';
                            $msg = "Top Up fail, something went wrong when adding transaction data. Please try again !";
                        }
                        else{
                            if($this->sendEmailDeposit($username, $topUpDetail)){
                                $this->db->trans_commit();
                                $msg = "";
                                $status = 'success';

                            }else{
                            $this->db->trans_rollback();  
                            $msg = 'Cannot send email';
                            $status = 'error';
                        }
            }
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
    }

        function deleteDeposit(){
            $status = "";
            $msg="";

            $datetime = date('Y-m-d H:i:s', time());
            $tDepositID = $this->input->post('id');
            $userID = $this->input>post('userID');

            $data_post=array(
                'isVisible'=>0,
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            $this->db->trans_begin();
            $update = $this->TDeposit_model->updateDeposit($data_post,$tDepositID);

            if($update){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Top Up List has been updated successfully!";
            }else{
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Something went wrong when updating Top Up List !";
            }

            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
		
		function rejectDeposit(){
			$status = "";
            $msg="";

            $datetime = date('Y-m-d H:i:s', time());
            $tDepositID = $this->input->post('id');
            $userID = $this->input>post('userID');

            $data_post=array(
                'status'=>'rejected',
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            $this->db->trans_begin();
            $update = $this->TDeposit_model->updateDeposit($data_post,$tDepositID);

            if($update){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Top Up List has been updated successfully!";
            }else{
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Something went wrong when updating Top Up List !";
            }

            echo json_encode(array('status' => $status, 'msg' => $msg));
		}

        function updateStatusPendingDeposit(){
            $status = "error";
            $msg="error";
			
            $datetime = date('Y-m-d H:i:s', time());
            $tDepositID = $this->input->post('id');
            $userID = $this->input->post('userID');
			$username = $this->input->post('username');
			
			if($userID != null || $userID!=""){
				$data_post=array(
					'status'=>'pending',
					"lastUpdated"=>$datetime,
					"lastUpdatedBy"=>$userID
				);

				$this->db->trans_begin();
				$update = $this->TDeposit_model->updateDeposit($data_post,$tDepositID);
				$topUpDetail = $this->TDeposit_model->getTDepositDetail($tDepositID);

				if($update){
					 if($this->sendEmailUserConfirmDeposit($username, $topUpDetail)){
						$this->db->trans_commit();
						$status = 'success';
						$msg = "Status Updated successfully!";
					}else
					{
						$this->db->trans_rollback();  
						$msg = 'Cannot send email';
						$status = 'error';
					}
				}else{

					$this->db->trans_rollback();
					$status = 'error';
					$msg = "Something went wrong when updating Status !";
				}

				echo json_encode(array('status' => $status, 'msg' => $msg));
			}else{
				echo json_encode(array('status' => $status, 'msg' => $msg));
			}
            
        }

        function depositConfirmList(){
        $user = $this->User_model->getUserLevelbyUsername($this->input>post("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/dashboard"));
        }
        else{
            $data['deposit_list']=$this->TDeposit_model->getListTDepositConfirm($this->input>post('userID'));
            $data['data_content']="admin/deposit_list_view";
            $this->load->view('includes/member_area_template_view',$data);
            }

        }

        function depositConfirm(){
         $user = $this->User_model->getUserLevelbyUsername($this->input>post("username"));
            if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
                redirect(site_url("User/dashboard"));
            }
            else{
                $status = "";
                $msg="";

                $datetime = date('Y-m-d H:i:s', time());
                $tDepositID = $this->input->post('id');
                $userID = $this->input>post('userID');

                $data_post=array(
                    'status'=>'paid',
                    "lastUpdated"=>$datetime,
                    "lastUpdatedBy"=>$userID
                );

                $this->db->trans_begin();
                $update = $this->TDeposit_model->confirmDeposit($data_post,$tDepositID);

                if($update){

                    $detail = $this->TDeposit_model->getTDepositDetail($tDepositID);

                    $trans = $this->SAccount_model->additionPoinCoin($detail->createdBy, $detail->poin, $detail->coin);

                    if($trans==1){
                        $this->db->trans_commit();
                        $status = 'success';
                        $msg = "Status Updated successfully!";
                    }else{
                        $this->db->trans_rollback();
                        $status = 'error';
                        $msg = "Something went wrong when adding coin and poin !";    
                    }
                }else{
                    $this->db->trans_rollback();
                    $status = 'error';
                    $msg = "Something went wrong when updating Status !".$tDepositID;
                }

                echo json_encode(array('status' => $status, 'msg' => $msg));

            }
        }

        function sendEmailDeposit($username, $topUpDetail){

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
            $data['detail_topUp'] = $topUpDetail;
            $data['title'] = "TOPPON - Konfirmasi Top Up";
            $data['content']="email/deposit_email_view";
            $message = $this->load->view('email/template_view',$data,true);

            
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('no-reply@toppon.co.id', 'Feedback System'); // nanti diganti dengan email sistem toppon
            $this->email->to($user->email); // email user

            $this->email->subject('[TOPPON] TOP UP CONFIRMATION');
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

        function sendEmailUserConfirmDeposit($username, $topUpDetail){

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
            $data['detail_topUp'] = $topUpDetail;
            $data['title'] = "TOPPON - Konfirmasi Top Up";
            $data['content']="email/deposit_confirm_email_view";
            $message = $this->load->view('email/template_view',$data,true);

            
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('no-reply@toppon.co.id', 'Feedback System'); // nanti diganti dengan email sistem toppon
            $this->email->to($user->email); // email user

            $this->email->subject('[TOPPON] TOP UP CONFIRMATION');
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