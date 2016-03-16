<?php
class Game_model extends CI_Model{

    function getGameList($start, $limit){
        $this->db->select('*');
        $this->db->from('tbl_toppon_m_games a');
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.gameName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function checkGame($name){
        $this->db->from('tbl_toppon_m_games a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.gameName', $name);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Game doesn't exist
        }else{
            return true; // Game exist
        }
    }

    function checkGameEdit($name, $id){
        $this->db->from('tbl_toppon_m_games a');
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

    function getCountGameList(){
        $this->db->from('tbl_toppon_m_games a');
        $this->db->where('a.isActive', 1);
        return $this->db->count_all_results();
    }

    function createGame($data){
        $this->db->insert('tbl_toppon_m_games',$data);
        return $this->db->insert_id();
    }

    function updateGame($data, $id){
        $this->db->where('gameID',$id);
        $this->db->update('tbl_toppon_m_games',$data);

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }

    function checkUsedBySetting($id){
        $this->db->select('gameID');
        $this->db->from('tbl_toppon_s_publishers');
        $this->db->where('a.gameID', $id);
        $this->db->where('isActive', 1);
        $result = $this->db->count_all_results();

        $this->db->select('gameID');
        $this->db->from('tbl_toppon_s_games');
        $this->db->where('a.gameID', $id);
        $this->db->where('isActive', 1);
        $result2 = $this->db->count_all_results();


        if($result == 0 && $result2 == 0){
            return false; // This master is not used by any setting
        }else{
            return true; // This Master is used by setting
        }
    }

    //SETTING
    function getGameSettingList($start, $limit){
        //Create where clause
        $this->db->select('gameID');
        $this->db->from('tbl_toppon_s_games');
        $this->db->where('isActive', 1);
        $where_clause = $this->db->get_compiled_select();

        //Create main query
        $this->db->select('gameID, gameName');
        $this->db->from('tbl_toppon_m_games a');
        $this->db->where("`gameID` NOT IN ($where_clause)", NULL, FALSE);
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.gameName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function getGameById($id){
        $this->db->select('gameID, gameName');
        $this->db->from('tbl_toppon_m_games a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.gameID', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function getComboGameSettingList($start, $limit){
        //Create where clause
        $this->db->select('gameID');
        $this->db->from('tbl_toppon_s_publishers');
        $this->db->where('isActive', 1);
        $where_clause = $this->db->get_compiled_select();

        //Create main query
        $this->db->select('gameID, gameName');
        $this->db->from('tbl_toppon_m_games a');
        $this->db->where("`gameID` NOT IN ($where_clause)", NULL, FALSE);
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.gameName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

}
?>