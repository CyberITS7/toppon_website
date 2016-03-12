<?php  
	class TGift_model extends CI_model{

		function createClaimGiftsLog($data){        
            $this->db->insert('tbl_toppon_t_gifts',$data);
            $result=$this->db->affected_rows();
            return $result;
        }

        //REPORT
        function getTransGiftList($start, $limit, $userId){
            $this->db->select('*');
            $this->db->from('tbl_toppon_t_gifts a');
            $this->db->where('a.isActive', 1);
            $this->db->order_by('a.created','desc');

            if($userId != null){
                $this->db->where('a.createdBy', $userId);
            }
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }

        //Search by Periode
        function getTransGiftByPeriode($start, $limit, $userId, $startDate, $endDate){
            $this->db->select('*');
            $this->db->from('tbl_toppon_t_gifts a');
            $this->db->where('a.isActive', 1);
            $this->db->where('created between "'.$startDate.'" and "'.$endDate.'"');
            $this->db->order_by('a.created','desc');

            if($userId != null){
                $this->db->where('a.createdBy', $userId);
            }
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }

        //Search by Date
        function getTransGiftByDate($start, $limit, $userId, $date){
            $this->db->select('*');
            $this->db->from('tbl_toppon_t_gifts a');
            $this->db->where('a.isActive', 1);
            $this->db->like('created', $date, 'after');
            $this->db->order_by('a.created','desc');

            if($userId != null){
                $this->db->where('a.createdBy', $userId);
            }
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }
	}
?>