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

    function checkUsedBySetting($id){
        $this->db->select('gameCategoryID');
        $this->db->from('tbl_toppon_s_game_categories a');
        $this->db->where('a.gameCategoryID', $id);
        $this->db->where('isActive', 1);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // This master is not used by any setting
        }else{
            return true; // This Master is used by setting
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

    //SETTING
    function getGameCategorySettingList($start, $limit){
        //Create where clause
        $this->db->select('gameCategoryID');
        $this->db->from('tbl_toppon_s_game_categories');
        $this->db->where('isActive', 1);
        $where_clause = $this->db->get_compiled_select();

        //Create main query
        $this->db->select('gameCategoryID, gameCategoryName');
        $this->db->from('tbl_toppon_m_game_categories a');
        $this->db->where("`gameCategoryID` NOT IN ($where_clause)", NULL, FALSE);
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.gameCategoryName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
    function getGameCategoryById($id){
        $this->db->select('gameCategoryID,gameCategoryName');
        $this->db->from('tbl_toppon_m_game_categories a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.gameCategoryID', $id);
        $query = $this->db->get();
        return $query->row();
    }
}
?>