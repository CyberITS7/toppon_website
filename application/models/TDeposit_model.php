<?php
class TDeposit_model extends CI_Model{

    function insertDeposit($data){
        $this->db->insert('tbl_toppon_t_deposits', $data);
        return $this->db->insert_id();
    }

     function updateDeposit($data, $id){
	        $this->db->where('tDepositID',$id);
	        $this->db->update('tbl_toppon_t_deposits',$data);

	        if ($this->db->affected_rows() == 1)
	            return TRUE;
	        else
	            return FALSE;
	    }

    function getListTDeposit() {
        $where=array(      
                'isActive'=>1,
                'isVisible'=>1
            );
            
            $this->db->select('*');
            $this->db->from('tbl_toppon_t_deposits');
            $this->db->where($where);
            $this->db->order_by('created', 'DESC');               
            $query = $this->db->get();
            
            return $query->result_array();
    }

    function getTDepositDetail($id){
        $where=array(      
                'isActive'=>1, 
                'tDepositID'=>$id
            );

        $this->db->select('*');
        $this->db->from('tbl_toppon_t_deposits');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    
    }

}
?>