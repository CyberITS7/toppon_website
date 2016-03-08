<?php
class Payment_model extends CI_Model{

    function getPaymentList($start, $limit){
        $this->db->select('*');
        $this->db->from('tbl_toppon_m_payment_methods a');
        $this->db->where('a.isActive', 1);
        $this->db->order_by('a.paymentMethodName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function checkPayment($name){
        $this->db->from('tbl_toppon_m_payment_methods a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.paymentMethodName', $name);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Payment doesn't exist
        }else{
            return true; // Payment exist
        }
    }

    function checkPaymentEdit($name, $id){
        $this->db->from('tbl_toppon_m_payment_methods a');
        $this->db->where('a.isActive', 1);
        $this->db->where('a.paymentMethodName', $name);
        $this->db->where('a.paymentMethodID !=', $id);
        $result = $this->db->count_all_results();

        if($result == 0){
            return false; // Payment doesn't exist
        }else{
            return true; // Payment exist
        }
    }

    function getCountPaymentList(){
        $this->db->from('tbl_toppon_m_payment_methods a');
        $this->db->where('a.isActive', 1);
        return $this->db->count_all_results();
    }

    function createPayment($data){
        $this->db->insert('tbl_toppon_m_payment_methods',$data);
        return $this->db->insert_id();
    }

    function updatePayment($data, $id){
        $this->db->where('paymentMethodID',$id);
        $this->db->update('tbl_toppon_m_payment_methods',$data);

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }

}
?>