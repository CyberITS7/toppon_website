<?php
class TDeposit_model extends CI_Model{

    function insertDeposit($data){
        $this->db->insert('tbl_toppon_t_deposits', $data);
        return $this->db->insert_id();
    }

}
?>