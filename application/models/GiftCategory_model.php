<?php  
	class GiftCategory_model extends CI_model{

		function getAllGiftCategory(){
			$this->db->select('giftCategoryID,giftCategory');
	        $this->db->from('tbl_toppon_m_gift_categories');
	        $this->db->where('isActive', 1);

	        $query = $this->db->get();
	        return $query->result_array();
		}

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

	    function checkUsedBySetting($id){
	        $this->db->select('b.giftCategoryID');
	        $this->db->from('tbl_toppon_s_gifts b');
	        $this->db->where('b.giftCategoryID', $id);	        
	        $this->db->where('b.isActive', 1);
	        $result = $this->db->count_all_results();

	        if($result == 0){
	            return false; // This master is not used by any setting
	        }else{
	            return true; // This Master is used by setting
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