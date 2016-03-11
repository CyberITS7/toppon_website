<?php
class Deposit extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->library("Authentication");

        $this->load->library('Hash');
        $this->load->model('Deposit_model');
        $this->load->model('Bank_model');
        $this->load->model('Coin_model');
        $this->load->model('TDeposit_model');
        $this->load->model('User_model');

    }

    function index(){
        if(!$this->session->userdata('logged_in')){
            $this->loginAndRegister();
        }
        else{
            $this->depositList();
        }
    }

    function depositList(){
        if(!$this->session->userdata('logged_in')){
            redirect(site_url("User/loginAndRegister"));
        }
        else{
            $data['deposit_list']=$this->TDeposit_model->getListTDeposit($this->session->userdata('user_id'));
            $data['data_content']="member/deposit_list_view";
            $this->load->view('includes/member_area_template_view',$data);
        }

    }

    function depositInsertForm() {
        if(!$this->session->userdata('logged_in')){
            redirect(site_url("User/loginAndRegister"));
        }
        else{
            $data['bank_list']=$this->Bank_model->getBankName();
            $data['coin_list']=$this->Coin_model->getCoin();
            $data['data_content']="member/deposit_insert_view";
            $this->load->view('includes/member_area_template_view',$data);
        }
    }

    function depositDetail($id) {
        if(!$this->session->userdata('logged_in')){
            redirect(site_url("User/loginAndRegister"));
        }
        else{
            $data['deposit_detail']=$this->TDeposit_model->getTDepositDetail($id);
            $data['data_content']="member/deposit_detail_view";
            $this->load->view('includes/member_area_template_view',$data);
        }
    }

    function topUpDeposit() {
            $datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil

            $noRekening = $this->input->post('Nomor-Rekening');
            $namaRekening = $this->input->post("Nama-Rekening");
            $namaBank = $this->input->post("Nama-Bank");
            $topponCoin = $this->input->post("Toppon-Coin");

            //Ambil data Coin dan Bank yang Asli
            $data_bank = $this->Bank_model->getBankByID($namaBank);
            $data_coin = $this->Coin_model->getCoinByID($topponCoin);

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
                        'bankName' => $data_bank->bankName,
                        'coin' => $data_coin->coin,
                        'coinConversion' => $data_coin->coinConversion,
                        'isVisible' => 1,
                        'isActive' => 1,
                        'poin' => $data_coin->poin,
                        'kodeUnik' => '111',
                        'status' => 'unpaid',
                        'created' => $datetime,
                        'createdBy' => $this->session->userdata('user_id'),
                        'lastUpdated' => $datetime,
                        'lastUpdatedBy' => $this->session->userdata('user_id')

                    );

                        $this->db->trans_begin();
                        $query = $this->TDeposit_model->insertDeposit($data);

                        if ($this->db->trans_status() === FALSE) {
                            // Failed to save Data to DB
                            $this->db->trans_rollback();
                            $status = 'error';
                            $msg = "Top Up fail, something went wrong when adding transaction data. Please try again !";
                        }
                        else{
                            $this->db->trans_commit();
                            redirect(site_url('Deposit/depositDetail/'.$query));
                            //$msg = "Top up successfully!";
                            //$status = 'success';

                        }
            }
            //echo json_encode(array('status' => $status, 'msg' => $msg)); -- Untuk Ajax
        }

        function deleteDeposit(){
            $status = "";
            $msg="";

            $datetime = date('Y-m-d H:i:s', time());
            $tDepositID = $this->input->post('id');
            $userID = $this->session->userdata('user_id');

            $data_post=array(
                'isVisible'=>0,
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            $this->db->trans_begin();
            $update = $this->TDeposit_model->updateDeposit($da4ta_post,$tDepositID);

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

        function updateStatusPendingDeposit(){
            $status = "";
            $msg="";

            $datetime = date('Y-m-d H:i:s', time());
            $tDepositID = $this->input->post('id');
            $userID = $this->session->userdata('user_id');

            $data_post=array(
                'status'=>'pending',
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            $this->db->trans_begin();
            $update = $this->TDeposit_model->updateDeposit($data_post,$tDepositID);

            if($update){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Status Updated successfully!";
            }else{
                $this->db->trans_rollback();
                $status = 'error';
                $msg = "Something went wrong when updating Status !";
            }

            echo json_encode(array('status' => $status, 'msg' => $msg));
        }

        function depositConfirmList(){
        $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
        if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
            redirect(site_url("User/loginAndRegister"));
        }
        else{
            $data['deposit_list']=$this->TDeposit_model->getListTDepositConfirm($this->session->userdata('user_id'));
            $data['data_content']="admin/deposit_list_view";
            $this->load->view('includes/member_area_template_view',$data);
            }

        }

        function depositConfirm(){
         $user = $this->User_model->getUserLevelbyUsername($this->session->userdata("username"));
            if(!$this->authentication->isAuthorizeSuperAdmin($user->userLevel)){
                redirect(site_url("User/loginAndRegister"));
            }
            else{
                $status = "";
                $msg="";

                $datetime = date('Y-m-d H:i:s', time());
                $tDepositID = $this->input->post('id');
                $userID = $this->session->userdata('user_id');

                $data_post=array(
                    'status'=>'paid',
                    "lastUpdated"=>$datetime,
                    "lastUpdatedBy"=>$userID
                );

                $this->db->trans_begin();
                $update = $this->TDeposit_model->confirmDeposit($data_post,$tDepositID);

                if($update){
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "Status Updated successfully!";
                }else{
                    $this->db->trans_rollback();
                    $status = 'error';
                    $msg = "Something went wrong when updating Status !";
                }

                echo json_encode(array('status' => $status, 'msg' => $msg));

            }
               
        }

    }

?>