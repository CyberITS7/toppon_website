<?php  
	class Transfer_model extends CI_Model{
		function createTransfer($data){        
	        $this->db->insert('tbl_toppon_t_transfers',$data);
	        $result=$this->db->insert_id();
	        return $result;
	    }

        function getTransferDetailByID($id){
            $this->db->select('coin, b.username as pengirim, c.username as penerima, a.created ');
            $this->db->from('tbl_toppon_t_transfers a');
            $this->db->join('tbl_toppon_m_users b',"a.userPengirim=b.userID");
            $this->db->join('tbl_toppon_m_users c',"a.userPenerima=c.userID");
            $this->db->where('a.isActive', 1);
            $this->db->where('a.tTransferID', $id);
            $this->db->order_by('a.created','desc');

            $query = $this->db->get();
            return $query->row();
        }

        //REPORT
        function getTransferList($start, $limit, $userId){
            $this->db->select('tTransferID, coin, b.username as pengirim, c.username as penerima, a.created ');
            $this->db->from('tbl_toppon_t_transfers a');
            $this->db->join('tbl_toppon_m_users b',"a.userPengirim=b.userID");
            $this->db->join('tbl_toppon_m_users c',"a.userPenerima=c.userID");
            $this->db->where('a.isActive', 1);
            $this->db->order_by('a.created','desc');

            if($userId != null){
                $this->db->where('a.userPengirim', $userId);
                $this->db->or_where('a.userPenerima', $userId);
            }
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }
		
		function getCountTransferList($userId, $date, $startDate, $endDate){
			$this->db->select('tTransferID, coin, b.username as pengirim, c.username as penerima, a.created ');
            $this->db->from('tbl_toppon_t_transfers a');
            $this->db->where('a.isActive', 1);
            $this->db->order_by('a.created','desc');

            if($userId != null){
                $this->db->where('a.userPengirim', $userId);
                $this->db->or_where('a.userPenerima', $userId);
            }
			
			//By Date
			if($date != null){
				 $this->db->like('a.created', $date, 'after');
			}
			//By Periode
			if($startDate != null && $endDate != null ){
				$this->db->where('a.created between "'.$startDate.'" and "'.$endDate.'"');
			}

            return $this->db->count_all_results();
		}

        //Search by Periode
        function getTransferByPeriode($start, $limit, $userId, $startDate, $endDate){
            $this->db->select('tTransferID, coin, b.username as pengirim, c.username as penerima, a.created ');
            $this->db->from('tbl_toppon_t_transfers a');
            $this->db->join('tbl_toppon_m_users b',"a.userPengirim=b.userID");
            $this->db->join('tbl_toppon_m_users c',"a.userPenerima=c.userID");
            $this->db->where('a.created between "'.$startDate.'" and "'.$endDate.'"');
            $this->db->order_by('a.created','desc');

            if($userId != null){
                $this->db->where('a.userPengirim', $userId);
                $this->db->or_where('a.userPenerima', $userId);
            }
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }

        //Search by Date
        function getTransferByDate($start, $limit, $userId, $date){
            $$this->db->select('tTransferID, coin, b.username as pengirim, c.username as penerima, a.created ');
            $this->db->from('tbl_toppon_t_transfers a');
            $this->db->join('tbl_toppon_m_users b',"a.userPengirim=b.userID");
            $this->db->join('tbl_toppon_m_users c',"a.userPenerima=c.userID");
            $this->db->like('a.created', $date, 'after');
            $this->db->order_by('a.created','desc');

            if($userId != null){
                $this->db->where('a.userPengirim', $userId);
                $this->db->or_where('a.userPenerima', $userId);
            }
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }
	}
?>