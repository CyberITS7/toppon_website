<?php
class GamePurchase_model extends CI_Model{

    function getGameList(){
        $this->db->select('sGamesID, a.publisherID, a.nominalID, nominalName, publisherName, paymentValue');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->join('tbl_toppon_m_publishers b', 'a.publisherID = b.publisherID');
        $this->db->join('tbl_toppon_m_nominals c', 'a.nominalID = c.nominalID');
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.publisherID','asc');
        $this->db->order_by('nominalName','asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getGameByID($id){
        $this->db->select('sGamesID, a.publisherID, a.nominalID, nominalName, publisherName, paymentValue');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->join('tbl_toppon_m_publishers b', 'a.publisherID = b.publisherID');
        $this->db->join('tbl_toppon_m_nominals c', 'a.nominalID = c.nominalID');
        $this->db->where('a.sGamesID', $id);
        $this->db->where('a.isActive', 1);
        $query = $this->db->get();
        return $query->row();
    }


}
?>