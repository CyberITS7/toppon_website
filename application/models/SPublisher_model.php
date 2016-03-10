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
    
    function getSPublisherList($start, $limit){
        $this->db->select('*');
        $this->db->from('tbl_toppon_s_publishers a');
        $this->db->join('tbl_toppon_m_publishers c', 'c.publisherID = a.publisherID');
        $this->db->where('a.isActive', 1);
        $this->db->group_by('a.publisherID');
        $this->db->order_by('c.publisherName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
    function getCountSPublisherList(){
        $this->db->select('*');
        $this->db->from('tbl_toppon_s_publishers a');
        $this->db->where('a.isActive', 1);
        $this->db->group_by('a.publisherID');
        return $this->db->count_all_results();
    }
    function getSPublisherDetail(){
        $this->db->select('*');
        $this->db->from('tbl_toppon_s_publishers a');
        $this->db->join('tbl_toppon_m_publishers b', 'a.publisherID = b.publisherID');
        $this->db->join('tbl_toppon_m_game c', 'c.gameID = a.gameID');

        $this->db->where('a.isActive', 1);
        $this->db->order_by('b.gameName','asc');

        $query = $this->db->get();
        return $query->result_array();
    }

    //SETTING
    function getGameSettingListByPublisher($publisherID){
        $this->db->select('a.gameID, b.gameName,a.sPublisherID');
        $this->db->from('tbl_toppon_s_publishers a');
        $this->db->join('tbl_toppon_m_games b', 'a.gameID = b.gameID');
        $this->db->where('a.publisherID', $publisherID);
        $this->db->where('a.isActive', 1);
        $this->db->where('b.isActive', 1);
        $this->db->group_by('a.gameID');
        $query = $this->db->get();
        return $query->result_array();
    }

    function createSPublisher($data){
        $this->db->insert('tbl_toppon_s_publishers',$data);
        return $this->db->insert_id();
    }

    function updateSPublisher($data, $publisherID, $gameID){
        if($publisherID!=null){
            $this->db->where('publisherID',$publisherID);
        }
        if($gameID!=null){
            $this->db->where('gameID',$gameID);
        }
        $this->db->where('isActive', 1);
        $this->db->update('tbl_toppon_s_publishers',$data);

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }
    
}
?>