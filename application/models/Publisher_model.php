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
            return true; // Publisher available
        }else{
            return false; // Publisher exist
        }
    }

    function checkPublisherEdit($name, $id){
        $this->db->from('tbl_toppon_m_publishers a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.publisherName', $name);
        $this->db->where('a.publisherID !=', $id);
        $result = $this->db->count_all_results();

        if($result == 0){
            return true; // Publisher available
        }else{
            return false; // Publisher exist
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



}
?>