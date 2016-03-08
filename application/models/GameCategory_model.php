<?php
class GameCategory_model extends CI_Model{

    function getGameCategoryList($start, $limit){
        $this->db->select('gameCategoryID, gameCategoryName');
        $this->db->from('tbl_toppon_m_game_categories a');
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.gameCategoryName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function checkGameCategory($name){
        $this->db->from('tbl_toppon_m_game_categories a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.gameCategoryName', $name);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Game doesn't exist
        }else{
            return true; // Game exist
        }
    }

    function checkGameCategoryEdit($name,$id){
        $this->db->from('tbl_toppon_m_game_categories a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.gameCategoryName', $name);
        $this->db->where('a.gameCategoryID !=', $id);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Game doesn't exist
        }else{
            return true; // Game exist
        }
    }

    function getCountGameCategoryList(){
        $this->db->from('tbl_toppon_m_game_categories a');
        $this->db->where('a.isActive', 1);
        return $this->db->count_all_results();
    }

    function createGameCategory($data){
        $this->db->insert('tbl_toppon_m_game_categories',$data);
        return $this->db->insert_id();
    }

    function updateGameCategory($data, $id){
        $this->db->where('gameCategoryID',$id);
        $this->db->update('tbl_toppon_m_game_categories',$data);

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }
}
?>