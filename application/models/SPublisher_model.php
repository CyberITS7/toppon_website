<?php
class SPublisher_model extends CI_Model{

    function getGameListByPublisher($publisherID){
        $this->db->select('a.gameID, b.gameName');
        $this->db->from('tbl_toppon_s_publishers a');
        $this->db->join('tbl_toppon_m_games b', 'a.gameID = b.gameID');
        $this->db->join('tbl_toppon_s_games c', 'c.gameID = b.gameID');
        $this->db->where('a.publisherID', $publisherID);
        $this->db->where('a.isActive', 1);
        $this->db->where('b.isActive', 1);
        $this->db->where('c.isActive', 1);
        $this->db->group_by('a.gameID');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>