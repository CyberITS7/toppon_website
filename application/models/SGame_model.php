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

    //SETTING
    function getSGameList($start, $limit){
        $this->db->select('*');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->join('tbl_toppon_m_games c', 'c.gameID = a.gameID');
        $this->db->where('a.isActive', 1);
        $this->db->where('c.isActive', 1);
        $this->db->group_by('a.gameID');
        $this->db->order_by('c.gameName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
    function getCountSGameList(){
        $this->db->select('*');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->where('a.isActive', 1);
        $this->db->group_by('a.gameID');
        return $this->db->count_all_results();
    }

    function getNominalSettingListByGame($gameID){
        $this->db->select('a.nominalID, b.nominalName, b.currency, a.productCode, a.paymentValue, a.sGameID');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->join('tbl_toppon_m_nominals b', 'a.nominalID = b.nominalID');
        $this->db->where('a.gameID', $gameID);
        $this->db->where('a.isActive', 1);
        $this->db->where('b.isActive', 1);
        $this->db->group_by('a.nominalID');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>