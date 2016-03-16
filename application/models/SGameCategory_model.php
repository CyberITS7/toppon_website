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
        $this->db->join('tbl_toppon_m_game_categories c', 'c.gameCategoryID = a.gameCategoryID');
        $this->db->where('a.isActive', 1);
        $this->db->where('c.isActive', 1);
        $this->db->group_by('a.gameCategoryID');
        $this->db->order_by('c.gameCategoryName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
    function getCountSGameCategoryList(){
        $this->db->select('*');
        $this->db->from('tbl_toppon_s_game_categories a');
        $this->db->where('a.isActive', 1);
        $this->db->group_by('a.gameCategoryID');

        $query = $this->db->get();
        return $query->num_rows();
    }
    function getSGameCategoryDetail(){
        $this->db->select('*');
        $this->db->from('tbl_toppon_s_game_categories a');
        $this->db->join('tbl_toppon_m_publishers b', 'a.publisherID = b.publisherID');
        $this->db->join('tbl_toppon_m_game_categories c', 'c.publisherID = a.publisherID');

        $this->db->where('a.isActive', 1);
        $this->db->order_by('b.publisherName','asc');

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

    //SETTING
    function getPublisherSettingListByCategory($gameCategoryID){
        $this->db->select('a.publisherID, b.publisherName,a.sGameCategoryID');
        $this->db->from('tbl_toppon_s_game_categories a');
        $this->db->join('tbl_toppon_m_publishers b', 'a.publisherID = b.publisherID');
        $this->db->where('a.gameCategoryID', $gameCategoryID);
        $this->db->where('a.isActive', 1);
        $this->db->where('b.isActive', 1);
        $this->db->group_by('a.publisherID');
        $query = $this->db->get();
        return $query->result_array();
    }

    function createSGameCategory($data){
        $this->db->insert('tbl_toppon_s_game_categories',$data);
        return $this->db->insert_id();
    }

    function updateSGameCategory($data, $gameCategoryID, $publisherID){
        if($gameCategoryID!=null){
            $this->db->where('gameCategoryID',$gameCategoryID);
        }
        if($publisherID!=null){
            $this->db->where('publisherID',$publisherID);
        }
        $this->db->where('isActive', 1);
        $this->db->update('tbl_toppon_s_game_categories',$data);

        return $this->db->affected_rows();
    }
}
?>