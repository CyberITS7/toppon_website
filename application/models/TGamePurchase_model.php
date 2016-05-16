<?php
class TGamePurchase_model extends CI_Model{

    function getTransGamePurchaseList($start, $limit, $userId, $searchText){
        $this->db->select('tGamePurchaseID,prefixCode,gameName,publisherName,currency, nominalName, productCode, paymentValue, coin,
		a.userLevel, userName, name, a.created');
        $this->db->from('tbl_toppon_t_game_purchases a');
        $this->db->join('tbl_toppon_m_users b','a.createdBy = b.userID');
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.created','desc');

        if($userId != null){
            $this->db->where('a.createdBy', $userId);
        }
        if($searchText != null){
            $this->db->like('a.gameName', $searchText);
        }
        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
    function getCountTransGamePurchaseList($userId, $searchText){
        $this->db->from('tbl_toppon_t_game_purchases a');
        $this->db->join('tbl_toppon_m_users b','a.createdBy = b.userID');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.createdBy', $userId);
        if($userId != null){
            $this->db->where('a.createdBy', $userId);
        }
        if($searchText != null){
            $this->db->like('a.gameName', $searchText);
        }
        return $this->db->count_all_results();
    }

    //Search by Periode
    function getTransGamePurchaseByPeriode($start, $limit, $userId, $startDate, $endDate, $searchText){
        $this->db->select('tGamePurchaseID,prefixCode,gameName,publisherName,currency, nominalName, productCode, paymentValue, coin,
		a.userLevel, userName, name, a.created');
        $this->db->from('tbl_toppon_t_game_purchases a');
        $this->db->join('tbl_toppon_m_users b','a.createdBy = b.userID');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.created between "'.$startDate.'" and "'.$endDate.'"');
        $this->db->order_by('a.created','desc');

        if($userId != null){
            $this->db->where('a.createdBy', $userId);
        }
        if($searchText != null){
            $this->db->like('a.gameName', $searchText);
        }
        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
	
	 function getCountTransGamePurchaseByPeriode($userId, $startDate, $endDate, $searchText){
        $this->db->select('*');
        $this->db->from('tbl_toppon_t_game_purchases a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.created between "'.$startDate.'" and "'.$endDate.'"');
        $this->db->order_by('a.created','desc');

        if($userId != null){
            $this->db->where('a.createdBy', $userId);
        }
         if($searchText != null){
             $this->db->like('a.gameName', $searchText);
         }

        return $this->db->count_all_results();
    }

    //Search by Date
    function getTransGamePurchaseByDate($start, $limit, $userId, $date, $searchText){
        $this->db->select('tGamePurchaseID,prefixCode,gameName,publisherName,currency, nominalName, productCode, paymentValue, coin,
		a.userLevel, userName, name, a.created ');
        $this->db->from('tbl_toppon_t_game_purchases a');
        $this->db->join('tbl_toppon_m_users b','a.createdBy = b.userID');
        $this->db->where('a.isActive', 1);
        $this->db->like('a.created', $date, 'after');
        $this->db->order_by('a.created','desc');

        if($userId != null){
            $this->db->where('a.createdBy', $userId);
        }
        if($searchText != null){
            $this->db->like('a.gameName', $searchText);
        }
        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
	
	 function getCountTransGamePurchaseByDate($userId, $date, $searchText){
        $this->db->select('*');
        $this->db->from('tbl_toppon_t_game_purchases a');
        $this->db->where('a.isActive', 1);
        $this->db->like('a.created', $date, 'after');

        if($userId != null){
            $this->db->where('a.createdBy', $userId);
        }
         if($searchText != null){
             $this->db->like('a.gameName', $searchText);
         }
      
        return $this->db->count_all_results();
    }

    function createTransactionGamePurchase($data){
        $this->db->insert('tbl_toppon_t_game_purchases', $data);
        return $this->db->insert_id();
    }

}
?>