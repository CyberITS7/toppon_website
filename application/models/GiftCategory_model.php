<?php  
	class GiftCategory_model extends CI_model{

		function getGiftCategoryList($start, $limit){
	        $this->db->select('*');
	        $this->db->from('tbl_toppon_m_gift_categories');
	        $this->db->where('isActive', 1);
	        $this->db->order_by('giftCategory','asc');

	        if($limit != null || $start!= null){
	            $this->db->limit($limit,$start);
	        }

	        $query = $this->db->get();
	        return $query->result_array();
	    }

	    function getCountGiftCategoryList(){
			$this->db->from('tbl_toppon_m_gift_categories');
			$this->db->where('isActive', 1);
			return $this->db->count_all_results();
	    }

	    function checkGiftCategory($name){
	        $this->db->from('tbl_toppon_m_gift_categories');
	        $this->db->where('isActive', 1);
	        $this->db->where('giftCategory', $name);
	        $result = $this->db->count_all_results();

	        if($result == 0){
	            return false; // Gift Category Doesn't exists
	        }else{
	            return true; // Gift Category exists
	        }
	    }

	    function createGiftCategory($data){
	        $this->db->insert('tbl_toppon_m_gift_categories',$data);
	        return $this->db->insert_id();
	    }

	    function updateGiftCategory($data, $id){
	        $this->db->where('giftCategoryID',$id);
	        $this->db->update('tbl_toppon_m_gift_categories',$data);

	        if ($this->db->affected_rows() == 1)
	            return TRUE;
	        else
	            return FALSE;
	    }
	}
?>