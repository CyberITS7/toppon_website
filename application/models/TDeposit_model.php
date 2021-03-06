<?php
class TDeposit_model extends CI_Model{

    function insertDeposit($data){
        $this->db->insert('tbl_toppon_t_deposits', $data);
        return $this->db->insert_id();
    }

     function updateDeposit($data, $id){
	        $this->db->where('tDepositID',$id);
	        $this->db->update('tbl_toppon_t_deposits',$data);

	        if ($this->db->affected_rows() == 1)
	            return TRUE;
	        else
	            return FALSE;
	    }

    function getListTDeposit($userID) {
        $where=array(      
                'isActive'=>1,
                'isVisible'=>1,
                'createdBy'=>$userID
            );
            
            $this->db->select('*');
            $this->db->from('tbl_toppon_t_deposits');
            $this->db->where($where);
            $this->db->where("status !=", 'expired');
            $this->db->order_by('created', 'DESC');               
            $query = $this->db->get();
            
            return $query->result_array();
    }
	
	function getListTDepositMobile($userID) {
        $where=array(      
                'isActive'=>1,
                'isVisible'=>1,
                'createdBy'=>$userID
            );
            
            $this->db->select('*');
            $this->db->from('tbl_toppon_t_deposits');
            $this->db->where($where);
            $this->db->where("status =", 'unpaid');
            $this->db->order_by('created', 'DESC');               
            $query = $this->db->get();
            
            return $query->result_array();
    }

    function getTDepositDetail($id){
        $where=array(      
                'isActive'=>1, 
                'tDepositID'=>$id
            );

        $this->db->select('*');
        $this->db->from('tbl_toppon_t_deposits');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    
    }

     function getListTDepositConfirm($userID) {
      
            $this->db->select('*');
            $this->db->from('tbl_toppon_t_deposits');
            $this->db->where("isActive", 1);
            $this->db->where("status", 'pending');
            $this->db->order_by('created', 'DESC');               
            $query = $this->db->get();
            
            return $query->result_array();
    }

    function confirmDeposit($data, $id) {
        $this->db->where('tDepositID',$id);
            $this->db->update('tbl_toppon_t_deposits',$data);

            if ($this->db->affected_rows() == 1)
                return TRUE;
            else
                return FALSE;
    
    }

    function expireDeposit($id){
        $datetime = date('Y-m-d H:i:s', time()); //ambil waktu saat fungsi di panggil
        $data = Array(
            "status" => "expired",
            "lastUpdated" => $datetime,
            "lastUpdatedBy" => $id
            );
        $this->db->where('DATE_ADD(created, INTERVAL \'1 0\' DAY_HOUR) <', $datetime);
        $this->db->where('status', "unpaid");
        $this->db->where('createdBy', $id);
        $this->db->update('tbl_toppon_t_deposits',$data);

        if ($this->db->affected_rows() >= 1)
            return TRUE;
        else
            return FALSE;
    }

    //REPORT
    function getTransDepositList($start, $limit, $userId, $status){
        $this->db->select('*');
        $this->db->from('tbl_toppon_t_deposits a');
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.created','desc');

        if($userId != null){
            $this->db->where('a.createdBy', $userId);
        }
        if($status != null){
            $this->db->where("status",$status);
        }
        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
	
	//COUNT
	function getCountTransDepositList($userId, $date, $startDate, $endDate, $status){
        $this->db->select('*');
        $this->db->from('tbl_toppon_t_deposits a');
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.created','desc');

        if($userId != null){
            $this->db->where('a.createdBy', $userId);
        }
        if($status != null){
            $this->db->where("status",$status);
        }
		if($date!=null){
			 $this->db->like('created', $date, 'after');
		}
        if($startDate != null && $endDate!= null){
            $this->db->where('created between "'.$startDate.'" and "'.$endDate.'"');
        }

       return $this->db->count_all_results();
    }

    //Search by Periode
    function getTransDepositByPeriode($start, $limit, $userId, $startDate, $endDate,$status){
        $this->db->select('*');
        $this->db->from('tbl_toppon_t_deposits a');
        $this->db->where('a.isActive', 1);
        $this->db->where('created between "'.$startDate.'" and "'.$endDate.'"');
        $this->db->order_by('a.created','desc');

        if($userId != null){
            $this->db->where('a.createdBy', $userId);
        }
        if($status != null){
            $this->db->where("status",$status);
        }
        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    //Search by Date
    function getTransDepositByDate($start, $limit, $userId, $date,$status){
        $this->db->select('*');
        $this->db->from('tbl_toppon_t_deposits a');
        $this->db->where('a.isActive', 1);
        $this->db->like('created', $date, 'after');
        $this->db->order_by('a.created','desc');

        if($userId != null){
            $this->db->where('a.createdBy', $userId);
        }
        if($status != null){
            $this->db->where("status",$status);
        }
        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

}
?>