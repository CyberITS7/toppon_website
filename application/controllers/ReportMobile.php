<?php

class ReportMobile extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("Authentication");
        $this->load->library("Indomogapi");
        $this->load->library('email');

        $this->load->model('User_model');
        $this->load->model('TGift_model');
        $this->load->model('TDeposit_model');
        $this->load->model('Transfer_model');
        $this->load->model('TGamePurchase_model');
        $this->load->model('SAccount_model');
    }
	
	//Game Purchase All
    function getGamePurchaseReport($start=1){

        $userID = $this->input->post('userID');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){
			$game_purchase_page = $this->TGamePurchase_model->getTransGamePurchaseList($start,$limit,$userID);
			$count_game_purchase = $this->TGamePurchase_model->getCountTransGamePurchaseList($userID);
			$pages = ceil($count_game_purchase/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $game_purchase_page));
		}else{
			echo json_encode("empty");
		}
    }
	
	//Game Purchase by Date
	function getGamePurchaseReportSearchByDate($start=1){
        $userID = $this->input->post('userID');
		$date = $this->input->post('date');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){
			//get Games List data
            $game_purchase_page = $this->TGamePurchase_model->getTransGamePurchaseByDate($start, $limit, $userID, $date);
			$count_game_purchase = $this->TGamePurchase_model->getCountTransGamePurchaseByDate($userID,$date);
			$pages = ceil($count_game_purchase/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $game_purchase_page));
		}else{
			echo json_encode("empty");
		}
    }
	
	//Game Purchase by Periode
	function getGamePurchaseReportSearchByPeriode($start=1){
        $userID = $this->input->post('userID');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){
			//get Games List data
			$endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
			
            $game_purchase_page = $this->TGamePurchase_model->getTransGamePurchaseByPeriode($start, $limit, $userID, $startDate, $endDate);
			$count_game_purchase = $this->TGamePurchase_model->getCountTransGamePurchaseByPeriode($userID,$startDate, $endDate);
			$pages = ceil($count_game_purchase/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $game_purchase_page));
		}else{
			echo json_encode("empty");
		}
    }
	
	// TOPUP ALL
    function getTopupReport($start=1){

        $userID = $this->input->post('userID');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;

        if($userID!=null){
            $topup_page = $this->TDeposit_model->getTransDepositList($start,$limit,$userID);
			$count_topup = $this->TDeposit_model->getCountTransDepositList($userID,null,null,null);
			$pages = ceil($count_topup/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $topup_page));
        }else{
            echo json_encode("empty");
        }
    }
	
	// TOPUP PERIODE
	function getDepositReportSearchByPeriode($start=1){
        $userID = $this->input->post('userID');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){
			//get Games List data
			$endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
			
            $topup_page = $this->TDeposit_model->getTransDepositByPeriode($start, $limit,$userID,$startDate, $endDate);
			$count_topup = $this->TDeposit_model->getCountTransDepositList($userID,null,$startDate, $endDate);
			$pages = ceil($count_topup/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $topup_page));
		}else{
			echo json_encode("empty");
		}
    }
	
	// TOPUP DATE
    function getDepositReportSearchByDate($start=1){
        $userID = $this->input->post('userID');
		$date = $this->input->post('date');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){
			//get Games List data
            $topup_page = $this->TDeposit_model->getTransDepositByDate($start, $limit, $userID, $date);
			$count_topup = $this->TDeposit_model->getCountTransDepositList($userID,$date,null,null);
			$pages = ceil($count_topup/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $topup_page));
		}else{
			echo json_encode("empty");
		}
    }
	
	// Transfer ALL
    function getTransferReport($start=1){

        $userID = $this->input->post('userID');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;

        if($userID!=null){
            $transfer_page = $this->Transfer_model->getTransferList($start,$limit,$userID);
			$count_transfer = $this->Transfer_model->getCountTransferList($userID,null,null,null);
			$pages = ceil($count_transfer/$num_per_page);
			
            echo json_encode(array('count' => $pages, 'data' => $transfer_page));
        }else{
            echo json_encode("empty");
        }
    }
	// Transfer PERIODE
	function getTransferReportSearchByPeriode($start=1){
        $userID = $this->input->post('userID');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){            
            //END DATE + 1
            $endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
            $transfer_page = $this->Transfer_model->getTransferByPeriode($start, $limit, $userID, $startDate, $endDate);
            $count_transfer = $this->Transfer_model->getCountTransferList($userID,null,$startDate, $endDate);
			$pages = ceil($count_transfer/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $transfer_page));
        }else{
            echo json_encode("empty");
        }
		
    }
	// Transfer DATE
    function getTransferReportSearchByDate($start=1){
        $userID = $this->input->post('userID');
		$date = $this->input->post('date');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){

            $transfer_page = $this->Transfer_model->getTransferByDate($start, $limit, $userID, $date);
            $count_transfer = $this->Transfer_model->getCountTransferList($userID,$date,null,null);
			$pages = ceil($count_transfer/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $transfer_page));
        }else{
            echo json_encode("empty");
        }
    }
	
    function getGiftReport($start=1){

        $userID = $this->input->post('userID');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;

        if($userID!=null){
            $gift_page = $this->TGift_model->getTransGiftList($start,$limit,$userID);
            echo json_encode($gift_page);
        }else{
            echo json_encode("empty");
        }
    }
}
?>
