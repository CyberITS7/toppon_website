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

}
?>