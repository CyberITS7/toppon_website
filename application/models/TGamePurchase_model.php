<?php
class TGamePurchase_model extends CI_Model{

    function getTransGamePurchaseList($start, $limit, $userId){
        $this->db->select('*');
        $this->db->from('tbl_toppon_t_game_purchases a');
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
    function getCountTransGamePurchaseList($userId){
        $this->db->from('tbl_toppon_t_game_purchases a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.createdBy', $userId);
        return $this->db->count_all_results();
    }

    //Search by Periode
    function getTransGamePurchaseByPeriode($start, $limit, $userId, $startDate, $endDate){
        $this->db->select('*');
        $this->db->from('tbl_toppon_t_game_purchases a');
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
    function getTransGamePurchaseByDate($start, $limit, $userId, $date){
        $this->db->select('*');
        $this->db->from('tbl_toppon_t_game_purchases a');
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

    function createTransactionGamePurchase($data){
        $this->db->insert('tbl_toppon_t_game_purchases', $data);
        return $this->db->insert_id();
    }

}
?>