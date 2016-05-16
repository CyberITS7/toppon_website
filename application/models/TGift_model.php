<?php  
	class TGift_model extends CI_model{

		function createClaimGiftsLog($data){        
            $this->db->insert('tbl_toppon_t_gifts',$data);
            $result=$this->db->insert_id();
            return $result;
        }
        function getTGiftDetail($id){
            $this->db->select('*');
            $this->db->from('tbl_toppon_t_gifts a');
            $this->db->where('a.isActive', 1);
            $this->db->where('a.tGiftID', $id);
            $this->db->order_by('a.created','desc');

            $query = $this->db->get();
            return $query->row();
        }

        //REPORT
        function getTransGiftList($start, $limit, $userId, $searchText){
            $this->db->select('tGiftID, giftID, giftName, giftCategory, giftDescription, reward, poin, a.created, b.userName');
            $this->db->from('tbl_toppon_t_gifts a');
            $this->db->join('tbl_toppon_m_users b','a.createdBy = b.userID');
            $this->db->where('a.isActive', 1);
            $this->db->order_by('a.created','desc');

            if($userId != null){
                $this->db->where('a.createdBy', $userId);
            }
			if($searchText !=null){
				$this->db->like('a.giftName', $searchText);
			}
			
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }
		
		//COUNT
		function getCountTransGiftList($userId, $date, $startDate, $endDate, $searchText){
            $this->db->select('tGiftID, giftID, giftName, giftCategory, giftDescription, reward, poin, a.created, b.userName');
            $this->db->from('tbl_toppon_t_gifts a');
            $this->db->join('tbl_toppon_m_users b','a.createdBy = b.userID');
            $this->db->where('a.isActive', 1);
            $this->db->order_by('a.created','desc');

            if($userId != null){
                $this->db->where('a.createdBy', $userId);
            }
			if($searchText !=null){
				$this->db->like('a.giftName', $searchText);
			}
			if($date!=null){
				 $this->db->like('a.created', $date, 'after');
			}
			if($startDate!=null && $endDate!=null){
				$this->db->where('a.created between "'.$startDate.'" and "'.$endDate.'"');
			}
          
            return $this->db->count_all_results();
        }

        //Search by Periode
        function getTransGiftByPeriode($start, $limit, $userId, $startDate, $endDate, $searchText){
            $this->db->select('tGiftID, giftID, giftName, giftCategory, giftDescription, reward, poin, a.created, b.userName');
            $this->db->from('tbl_toppon_t_gifts a');
            $this->db->join('tbl_toppon_m_users b','a.createdBy = b.userID');
            $this->db->where('a.isActive', 1);
            $this->db->where('a.created between "'.$startDate.'" and "'.$endDate.'"');
            $this->db->order_by('a.created','desc');

            if($userId != null){
                $this->db->where('a.createdBy', $userId);
            }
			if($searchText !=null){
				$this->db->like('a.giftName', $searchText);
			}
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }

        //Search by Date
        function getTransGiftByDate($start, $limit, $userId, $date,$searchText){
            $this->db->select('tGiftID, giftID, giftName, giftCategory, giftDescription, reward, poin, a.created, b.userName');
            $this->db->from('tbl_toppon_t_gifts a');
            $this->db->join('tbl_toppon_m_users b','a.createdBy = b.userID');
            $this->db->where('a.isActive', 1);
            $this->db->like('a.created', $date, 'after');
            $this->db->order_by('a.created','desc');

            if($userId != null){
                $this->db->where('a.createdBy', $userId);
            }
			if($searchText !=null){
				$this->db->like('a.giftName', $searchText);
			}
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }
	}
?>