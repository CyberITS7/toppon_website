<?php  
	class SGift_model extends CI_model{
		function getGiftList($start, $limit){
			$where=array(      
                'isActive'=>1
            );

            $this->db->select('*');
            $this->db->from('tbl_toppon_s_gifts');
            $this->db->where($where);
            $this->db->order_by('poin','DESC');

            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
		}

        function getCountGiftList(){
            $this->db->from('tbl_toppon_s_gifts');
            $this->db->where('isActive', 1);
            return $this->db->count_all_results();
        }

        function getAdminGiftList($start, $limit){
            $where=array(      
                's.isActive'=>1,
                'm.isActive'=>1
            );

            $this->db->select('*');
            $this->db->from('tbl_toppon_s_gifts s');
            $this->db->join('tbl_toppon_m_gift_categories m','m.giftCategoryID=s.giftCategoryID');
            $this->db->where($where);
            $this->db->order_by('poin','DESC');

            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }

        function getCountAdminGiftList(){
            $this->db->from('tbl_toppon_s_gifts s');
            $this->db->join('tbl_toppon_m_gift_categories m','m.giftCategoryID=s.giftCategoryID');
            $this->db->where('s.isActive', 1);
            $this->db->where('m.isActive', 1);
            return $this->db->count_all_results();
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