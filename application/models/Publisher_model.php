<?php
class Publisher_model extends CI_Model{

    function getPublisherList($start, $limit){
        $this->db->select('*');
        $this->db->from('tbl_toppon_m_publishers a');
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.publisherName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function checkPublisher($name){
        $this->db->from('tbl_toppon_m_publishers a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.publisherName', $name);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Publisher doesn't exist
        }else{
            return true; // Publisher exist
        }
    }

    function checkPublisherEdit($name, $id){
        $this->db->from('tbl_toppon_m_publishers a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.publisherName', $name);
        $this->db->where('a.publisherID !=', $id);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Publisher doesn't exist
        }else{
            return true; // Publisher exist
        }
    }

    function getCountPublisherList(){
        $this->db->from('tbl_toppon_m_publishers a');
        $this->db->where('a.isActive', 1);
        return $this->db->count_all_results();
    }

    function createPublisher($data){
        $this->db->insert('tbl_toppon_m_publishers',$data);
        return $this->db->insert_id();
    }

    function updatePublisher($data, $id){
        $this->db->where('publisherID',$id);
        $this->db->update('tbl_toppon_m_publishers',$data);

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }

    function checkUsedBySetting($id){
        $this->db->select('publisherID');
        $this->db->from('tbl_toppon_s_publishers a');
        $this->db->where('a.publisherID', $id);
        $this->db->where('isActive', 1);
        $result = $this->db->count_all_results();

        $this->db->select('publisherID');
        $this->db->from('tbl_toppon_s_game_categories a');
        $this->db->where('a.publisherID', $id);
        $this->db->where('isActive', 1);
        $result2 = $this->db->count_all_results();


        if($result == 0 && $result2 == 0){
            return false; // This master is not used by any setting
        }else{
            return true; // This Master is used by setting
        }
    }

    //SETTING
    function getPublisherSettingList($start, $limit){
        //Create where clause
        $this->db->select('publisherID');
        $this->db->from('tbl_toppon_s_publishers');
        $this->db->where('isActive', 1);
        $where_clause = $this->db->get_compiled_select();

        //Create main query
        $this->db->select('publisherID, publisherName');
        $this->db->from('tbl_toppon_m_publishers a');
        $this->db->where("`publisherID` NOT IN ($where_clause)", NULL, FALSE);
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.publisherName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function getPublisherById($id){
        $this->db->select('publisherID,publisherName');
        $this->db->from('tbl_toppon_m_publishers a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.publisherID', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function getComboPublisherSettingList($start, $limit){
        //Create where clause
        $this->db->select('publisherID');
        $this->db->from('tbl_toppon_s_game_categories');
        $this->db->where('isActive', 1);
        $where_clause = $this->db->get_compiled_select();

        //Create main query
        $this->db->select('publisherID, publisherName');
        $this->db->from('tbl_toppon_m_publishers a');
        $this->db->where("`publisherID` NOT IN ($where_clause)", NULL, FALSE);
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.publisherName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }


}
?>