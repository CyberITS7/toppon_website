<?php
class Home_model extends CI_Model{

    function getHomeList(){
        $this->db->select('*');
        $this->db->from('tbl_toppon_m_homes a');


        $query = $this->db->get();
        return $query->row();
    }

      function updateHome($data, $id){
        $this->db->where('homeID',$id);
        $this->db->update('tbl_toppon_m_homes',$data);

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }

}
?>