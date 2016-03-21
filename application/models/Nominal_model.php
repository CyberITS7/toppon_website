<?php
class Nominal_model extends CI_Model{

    function getNominalList($start, $limit){
        $this->db->select('*');
        $this->db->from('tbl_toppon_m_nominals a');
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.nominalName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function checkNominal($name,$curr){
        $this->db->from('tbl_toppon_m_nominals a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.nominalName', $name);
        $this->db->where('a.currency', $curr);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Game doesn't exist
        }else{
            return true; // Game exist
        }
    }

    function checkNominalEdit($name,$curr,$id){
        $this->db->from('tbl_toppon_m_nominals a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.nominalName', $name);
        $this->db->where('a.currency', $curr);
        $this->db->where('a.nominalID !=', $id);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Game doesn't exist
        }else{
            return true; // Game exist
        }
    }

    function getCountNominalList(){
        $this->db->from('tbl_toppon_m_nominals a');
        $this->db->where('a.isActive', 1);
        return $this->db->count_all_results();
    }

    function createNominal($data){
        $this->db->insert('tbl_toppon_m_nominals',$data);
        return $this->db->insert_id();
    }

    function updateNominal($data, $id){
        $this->db->where('nominalID',$id);
        $this->db->update('tbl_toppon_m_nominals',$data);

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }

    function checkUsedBySetting($id){
        $this->db->select('a.nominalID');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->where('a.nominalID', $id);
        $this->db->where('isActive', 1);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // This master is not used by any setting
        }else{
            return true; // This Master is used by setting
        }
    }

    // Get List Game yang sudah di setting
    function getGameByID($id){
        $this->db->select('sGamesID, a.publisherID, a.nominalID, nominalName, currency, publisherName, paymentValue');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->join('tbl_toppon_m_publishers b', 'a.publisherID = b.publisherID');
        $this->db->join('tbl_toppon_m_nominals c', 'a.nominalID = c.nominalID');
        $this->db->where('a.sGamesID', $id);
        $this->db->where('a.isActive', 1);
        $query = $this->db->get();
        return $query->row();
    }

    //SETTING

}
?>