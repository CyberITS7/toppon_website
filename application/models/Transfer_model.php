<?php  
	class Transfer_model extends CI_Model{
		function createTransfer($data){        
	        $this->db->insert('tbl_toppon_t_transfers',$data);
	        $result=$this->db->affected_rows();
	        return $result;
	    }
	}
?>