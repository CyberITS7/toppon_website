<?php  
	class TGift_model extends CI_model{

		function createClaimGiftsLog($data){        
            $this->db->insert('tbl_toppon_t_gifts',$data);
            $result=$this->db->affected_rows();
            return $result;
        }
	}
?>