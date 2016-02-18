<?php
class Bank_model extends CI_Model{
    function getBankName(){
        $where=array(      
                'isActive'=>1
            );

        $this->db->select('bankID, bankName');
        $this->db->from('tbl_toppon_m_banks');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    } 

    function getBankByID($id){
        $where=array(      
                'isActive'=>1, 
                'bankID'=>$id
            );

        $this->db->select('bankID, bankName');
        $this->db->from('tbl_toppon_m_banks');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    } 
}
?>


 
