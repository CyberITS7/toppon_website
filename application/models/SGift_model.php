<?php  
	class SGift_model extends CI_model{
		function getGiftList(){
			$where=array(      
                'isActive'=>1
            );

        $this->db->select('*');
        $this->db->from('tbl_toppon_s_gifts');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
		}
	}
?>