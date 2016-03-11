<?php
class Coin_model extends CI_Model{
    function getCoin(){
        $where=array(      
                'isActive'=>1
            );

        $this->db->select('coinID, coin, coinConversion, poin');
        $this->db->from('tbl_toppon_m_coins');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    } 

    function getCoinByID($id){
        $where=array(      
                'isActive'=>1, 
                'coinID'=>$id
            );

        $this->db->select('coinID, coin, coinConversion, poin');
        $this->db->from('tbl_toppon_m_coins');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    } 

    function getCoinList($start, $limit){
        $this->db->select('*');
        $this->db->from('tbl_toppon_m_coins a');
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.coin','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function checkCoin($name){
        $this->db->from('tbl_toppon_m_coins a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.coin', $name);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Coin doesn't exist
        }else{
            return true; // Coin exist
        }
    }

    function checkCoinEdit($name, $id){
        $this->db->from('tbl_toppon_m_coins a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.coin', $name);
        $this->db->where('a.coinID !=', $id);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Coin doesn't exist
        }else{
            return true; // Coin exist
        }
    }

    function getCountCoinList(){
        $this->db->from('tbl_toppon_m_coins a');
        $this->db->where('a.isActive', 1);
        return $this->db->count_all_results();
    }

    function createCoin($data){
        $this->db->insert('tbl_toppon_m_coins',$data);
        return $this->db->insert_id();
    }

    function updateCoin($data, $id){
        $this->db->where('coinID',$id);
        $this->db->update('tbl_toppon_m_coins',$data);

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }
}
?>
