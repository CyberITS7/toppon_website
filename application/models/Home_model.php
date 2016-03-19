<?php
class Home_model extends CI_Model{

    function getHomeList(){
        $this->db->select('*');
        $this->db->from('tbl_toppon_m_homes a');


        $query = $this->db->get();
        return $query->row();
    }

    function checkHome($name,$curr){
        $this->db->from('tbl_toppon_m_homes a');
        $this->db->where('a.homeName', $name);
        $this->db->where('a.currency', $curr);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Game doesn't exist
        }else{
            return true; // Game exist
        }
    }

    function checkHomeEdit($name,$curr,$id){
        $this->db->from('tbl_toppon_m_homes a');
        $this->db->where('a.homeName', $name);
        $this->db->where('a.currency', $curr);
        $this->db->where('a.homeID !=', $id);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Game doesn't exist
        }else{
            return true; // Game exist
        }
    }

    function getCountHomeList(){
        $this->db->from('tbl_toppon_m_homes a');
        return $this->db->count_all_results();
    }

    function createHome($data){
        $this->db->insert('tbl_toppon_m_homes',$data);
        return $this->db->insert_id();
    }

    function updateHome($data, $id){
        $this->db->where('homeID',$id);
        $this->db->update('tbl_toppon_m_homes',$data);

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }

    // Get List Game yang sudah di setting
    function getGameByID($id){
        $this->db->select('sGamesID, a.publisherID, a.homeID, homeName, currency, publisherName, paymentValue');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->join('tbl_toppon_m_publishers b', 'a.publisherID = b.publisherID');
        $this->db->join('tbl_toppon_m_homes c', 'a.homeID = c.homeID');
        $this->db->where('a.sGamesID', $id);
        $query = $this->db->get();
        return $query->row();
    }

    //SETTING

}
?>