<?php
class SGame_model extends CI_Model{

    function getGameListByPublisher($gameID){
        $this->db->select('a.sGameID,a.gameID,a.nominalID, b.nominalName, a.paymentValue');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->join('tbl_toppon_m_nominals b', 'a.nominalID = b.nominalID');
        $this->db->where('a.gameID', $gameID);
        $this->db->where('a.isActive', 1);
        $this->db->where('b.isActive', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getGameDetail($id){
        $this->db->select('sGameID,b.gameName, c.nominalName,e.publisherName, paymentValue, productCode');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->join('tbl_toppon_m_games b', 'a.gameID = b.gameID');
        $this->db->join('tbl_toppon_m_nominals c', 'a.nominalID = c.nominalID');
        $this->db->from('tbl_toppon_s_publishers d','a.gameID = d.gameID');
        $this->db->from('tbl_toppon_m_publishers e','e.publisherID = d.publisherID');
        $this->db->where('a.sGameID', $id);
        $this->db->where('a.isActive', 1);
        $this->db->where('b.isActive', 1);
        $this->db->where('c.isActive', 1);
        $this->db->where('d.isActive', 1);
        $this->db->where('e.isActive', 1);
        $query = $this->db->get();
        return $query->row();
    }
}
?>