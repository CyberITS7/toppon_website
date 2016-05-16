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
        $searchText = $this->input->post('searchText');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		//$this->output->enable_profiler(TRUE);
		if($userID!=null){
			$game_purchase_page = $this->TGamePurchase_model->getTransGamePurchaseList($start,$limit,$userID,$searchText);
			$count_game_purchase = $this->TGamePurchase_model->getCountTransGamePurchaseList($userID,$searchText);
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
        $searchText = $this->input->post('searchText');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){
			//get Games List data
            $game_purchase_page = $this->TGamePurchase_model->getTransGamePurchaseByDate($start, $limit, $userID, $date,$searchText);
			$count_game_purchase = $this->TGamePurchase_model->getCountTransGamePurchaseByDate($userID,$date,$searchText);
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
        $searchText = $this->input->post('searchText');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){
			//get Games List data
			$endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
			
            $game_purchase_page = $this->TGamePurchase_model->getTransGamePurchaseByPeriode($start, $limit, $userID, $startDate, $endDate,$searchText);
			$count_game_purchase = $this->TGamePurchase_model->getCountTransGamePurchaseByPeriode($userID,$startDate, $endDate,$searchText);
			$pages = ceil($count_game_purchase/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $game_purchase_page));
		}else{
			echo json_encode("empty");
		}
    }
	
	// TOPUP ALL
    function getDepositReport($start=1){

        $userID = $this->input->post('userID');
        $status = $this->input->post('status');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;

        if($userID!=null){
            $topup_page = $this->TDeposit_model->getTransDepositList($start,$limit,$userID,$status);
			$count_topup = $this->TDeposit_model->getCountTransDepositList($userID,null,null,null,$status);
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
        $status = $this->input->post('status');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){
			//get Games List data
			$endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
			
            $topup_page = $this->TDeposit_model->getTransDepositByPeriode($start, $limit,$userID,$startDate, $endDate,$status);
			$count_topup = $this->TDeposit_model->getCountTransDepositList($userID,null,$startDate, $endDate,$status);
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
        $status = $this->input->post('status');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){
			//get Games List data
            $topup_page = $this->TDeposit_model->getTransDepositByDate($start, $limit, $userID, $date,$status);
			$count_topup = $this->TDeposit_model->getCountTransDepositList($userID,$date,null,null,$status);
			$pages = ceil($count_topup/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $topup_page));
		}else{
			echo json_encode("empty");
		}
    }
	
	// Transfer ALL
    function getTransferReport($start=1){

        $userID = $this->input->post('userID');
		$sender = $this->input->post('sender');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		$this->output->enable_profiler(TRUE);
        if($userID!=null){
            $transfer_page = $this->Transfer_model->getTransferList($start,$limit,$userID,$sender);
			$count_transfer = $this->Transfer_model->getCountTransferList($userID,null,null,null,$sender);
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
		$sender = $this->input->post('sender');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){            
            //END DATE + 1
            $endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
            $transfer_page = $this->Transfer_model->getTransferByPeriode($start, $limit, $userID, $startDate, $endDate,$sender);
            $count_transfer = $this->Transfer_model->getCountTransferList($userID,null,$startDate, $endDate,$sender);
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
		$sender = $this->input->post('sender');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){

            $transfer_page = $this->Transfer_model->getTransferByDate($start, $limit, $userID, $date,$sender);
            $count_transfer = $this->Transfer_model->getCountTransferList($userID,$date,null,null,$sender);
			$pages = ceil($count_transfer/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $transfer_page));
        }else{
            echo json_encode("empty");
        }
    }
	
	// GIFT ALL
    function getGiftReport($start=1){

        $userID = $this->input->post('userID');
		$searchText = $this->input->post('searchText');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;

        if($userID!=null){
            $gift_page = $this->TGift_model->getTransGiftList($start,$limit,$userID,$searchText);
			$count_gift = $this->TGift_model->getCountTransGiftList($userID,null,null,null,$searchText);
			$pages = ceil($count_gift/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $gift_page));
        }else{
            echo json_encode("empty");
        }
    }
	
	// GIFT PERIODE
	function getGiftReportSearchByPeriode($start=1){
        $userID = $this->input->post('userID');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$searchText = $this->input->post('searchText');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){
			//END DATE + 1
            $endDate = strtotime ( '1 day' , strtotime ( $endDate ) ) ;
            $endDate = date ( 'Y-m-d' , $endDate );
			
            $gift_page = $this->TGift_model->getTransGiftByPeriode($start, $limit, $userID,$startDate, $endDate,$searchText);
			$count_gift = $this->TGift_model->getCountTransGiftList($userID,null,$startDate, $endDate,$searchText);
			$pages = ceil($count_gift/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $gift_page));
        }else{
            echo json_encode("empty");
        }
    }
	
	//GIFT DATE
    function getGiftReportSearchByDate($start=1){
        $userID = $this->input->post('userID');
		$date = $this->input->post('date');
		$searchText = $this->input->post('searchText');
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;
		
		if($userID!=null){
            $gift_page = $this->TGift_model->getTransGiftByDate($start, $limit, $userID,$date,$searchText);
			$count_gift = $this->TGift_model->getCountTransGiftList($userID,$date,null,null,$searchText);
			$pages = ceil($count_gift/$num_per_page);
			
			echo json_encode(array('count' => $pages, 'data' => $gift_page));
        }else{
            echo json_encode("empty");
        }
    }

}
?>
