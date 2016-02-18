<?php
class Deposit extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $this->load->library('Hash');
        $this->load->model('Deposit_model');
        $this->load->model('Bank_model');
        $this->load->model('Coin_model');
        $this->load->model('TDeposit_model');
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
            redirect($this->loginAndRegister());
        }
        else{
            $data['deposit_list']=$this->Deposit_model->getListDeposit();
            $data['data_content']="member/deposit_list_view";
            $this->load->view('includes/member_area_template_view',$data);
        }

    }

    function depositInsertForm() {
        if(!$this->session->userdata('logged_in')){
            redirect($this->loginAndRegister());
        }
        else{
            $data['bank_list']=$this->Bank_model->getBankName();
            $data['coin_list']=$this->Coin_model->getCoin();
            $data['data_content']="member/deposit_insert_view";
            $this->load->view('includes/member_area_template_view',$data);
        }
    }

    function depositDetail() {
        if(!$this->session->userdata('logged_in')){
            redirect($this->loginAndRegister());
        }
        else{
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

                $data = array(
                        'noRekening' => $noRekening,
                        'nameRekening' => $namaRekening,
                        'bankName' => $data_bank->bankName,
                        'coin' => $data_coin->coin,
                        'coinConversion' => $data_coin->coinConversion,
                        'isActive' => 1,
                        'poin' => $data_coin->poin,
                        'kodeUnik' => '111',
                        'status' => 0,
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
                    echo "ga bisa broo";
                    //$this->loginAndRegister('Error while saved Tag data!','register');
                }
                else{
                    $this->db->trans_commit();
                    echo "bisa coy";
                    /*$msg = "user has been created successfully";

                    redirect($this->dashboard());*/
                }
            }
    }

?>