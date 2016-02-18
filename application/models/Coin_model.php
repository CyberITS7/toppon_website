<?php
class Coin_model extends CI_Model{
    function getCoin(){
        $where=array(      
                'isActive'=>1
            );

        $this->db->select('coinID, coin, coinConversion');
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
}
?>
