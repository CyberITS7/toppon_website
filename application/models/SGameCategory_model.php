<?php
class SGameCategory_model extends CI_Model{

    function getPublisherListByCategory($gameCategoryID){
        $this->db->select('a.publisherID, b.publisherName,b.publisherImage');
        $this->db->from('tbl_toppon_s_game_categories a');
        $this->db->join('tbl_toppon_m_publishers b', 'a.publisherID = b.publisherID');
        $this->db->join('tbl_toppon_s_publishers c', 'c.publisherID = b.publisherID');
        $this->db->join('tbl_toppon_s_games d', 'c.gameID = d.gameID');
        $this->db->where('a.gameCategoryID', $gameCategoryID);
        $this->db->where('a.isActive', 1);
        $this->db->where('b.isActive', 1);
        $this->db->where('c.isActive', 1);
        $this->db->where('d.isActive', 1);
        $this->db->group_by('a.publisherID');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getSGameCategoryList($start, $limit){
        $this->db->select('*');
        $this->db->from('tbl_toppon_s_game_categories a');
        $this->db->join('tbl_toppon_m_publishers b', 'a.publisherID = b.publisherID');
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.gameName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function checkSGameCategory($name){
        $this->db->from('tbl_toppon_s_game_categories a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.gameName', $name);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Game doesn't exist
        }else{
            return true; // Game exist
        }
    }

    function checkSGameCategoryEdit($name, $id){
        $this->db->from('tbl_toppon_s_game_categories a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.gameName', $name);
        $this->db->where('a.gameID !=', $id);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Game doesn't exist
        }else{
            return true; // Game exist
        }
    }

    function getCountSGameCategoryList(){
        $this->db->from('tbl_toppon_s_game_categories a');
        $this->db->where('a.isActive', 1);
        return $this->db->count_all_results();
    }

    function createSGameCategory($data){
        $this->db->insert('tbl_toppon_s_game_categories',$data);
        return $this->db->insert_id();
    }

    function updateSGameCategory($data, $id){
        $this->db->where('gameID',$id);
        $this->db->update('tbl_toppon_s_game_categories',$data);

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }
}
?>