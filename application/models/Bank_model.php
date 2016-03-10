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

    function getBankList($start, $limit){
        $this->db->select('*');
        $this->db->from('tbl_toppon_m_banks a');
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.bankName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function checkBank($name){
        $this->db->from('tbl_toppon_m_banks a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.bankName', $name);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Bank doesn't exist
        }else{
            return true; // Bank exist
        }
    }

    function checkBankEdit($name, $id){
        $this->db->from('tbl_toppon_m_banks a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.bankName', $name);
        $this->db->where('a.bankID !=', $id);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Bank doesn't exist
        }else{
            return true; // Bank exist
        }
    }

    function getCountBankList(){
        $this->db->from('tbl_toppon_m_banks a');
        $this->db->where('a.isActive', 1);
        return $this->db->count_all_results();
    }

    function createBank($data){
        $this->db->insert('tbl_toppon_m_banks',$data);
        return $this->db->insert_id();
    }

    function updateBank($data, $id){
        $this->db->where('bankID',$id);
        $this->db->update('tbl_toppon_m_banks',$data);

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }
 
}
?>


 
