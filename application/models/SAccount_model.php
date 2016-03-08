<?php
class SAccount_model extends CI_Model{

    function getMyAccount($userID){
        $this->db->select('*');
        $this->db->from('tbl_toppon_s_accounts a');
        $this->db->join('tbl_toppon_m_users b', 'a.userID = b.userID');
        $this->db->where('a.userID', $userID);
        $this->db->where('a.isActive', 1);
        $query = $this->db->get();
        return $query->row();
    }

    function subtractionCoin($userID, $payment){
        $this->db->set('coin', 'coin-'.$payment, FALSE);
        $this->db->where('userID',$userID);
        $this->db->update('tbl_toppon_s_accounts');
        $result=$this->db->affected_rows();
        return $result;
    }

    function additionCoin($userID, $nominal){
        $this->db->set('coin', 'coin+'.$nominal, FALSE);
        $this->db->where('userID',$userID);
        $this->db->update('tbl_toppon_s_accounts');
        $result=$this->db->affected_rows();
        return $result;
    }

    function subtractionPoin($userID, $payment){
        $this->db->set('poin', 'poin-'.$payment, FALSE);
        $this->db->where('userID',$userID);
        $this->db->update('tbl_toppon_s_accounts');
        $result=$this->db->affected_rows();
        return $result;
    }


}
?>