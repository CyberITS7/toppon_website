<?php
class Deposit_model extends CI_Model{
    function getListDeposit() {
        $where=array(      
                'isActive'=>1
            );
            
            $this->db->select('*');
            $this->db->from('tbl_toppon_t_deposits');
            $this->db->where($where);               
            $query = $this->db->get();
            
            return $query->result_array();
    }
}
?>