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

        function getGiftDetail($id){
            $where=array(      
                's.isActive'=>1,
                's.giftID'=>$id
            );

            $this->db->select('*');
            $this->db->from('tbl_toppon_s_gifts s');
            $this->db->join('tbl_toppon_m_gift_categories m','m.giftCategoryID = s.giftCategoryID');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->row();
        }
	}
?>