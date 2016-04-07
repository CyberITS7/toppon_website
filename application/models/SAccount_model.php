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

    function getMyAccountByUsername($username){
        $this->db->select('a.userID, username, coin,poin, userLevel');
        $this->db->from('tbl_toppon_s_accounts a');
        $this->db->join('tbl_toppon_m_users b', 'a.userID = b.userID');
        $this->db->where('b.username', $username);
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

    function additionPoinCoin($userID, $poin, $coin){
        $this->db->set('poin', 'poin+'.$poin, FALSE);
        $this->db->set('coin', 'coin+'.$coin, FALSE); 
        $this->db->where('userID',$userID);
        $this->db->update('tbl_toppon_s_accounts');
        $result=$this->db->affected_rows();
        return $result;
    }

    function addSAccount($data){
        $this->db->insert('tbl_toppon_s_accounts',$data);
        $result=$this->db->insert_id();
        return $result;
    }

    function getSAccountList($start, $limit){
        $where=array(      
            's.isActive'=>1,
            'm.isActive'=>1
        );

        $this->db->select('*');
        $this->db->from('tbl_toppon_s_accounts s');
        $this->db->join('tbl_toppon_m_users m','m.userID=s.userID');
        $this->db->where($where);

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function getCountSAccountList(){
        $this->db->from('tbl_toppon_s_accounts s');
        $this->db->join('tbl_toppon_m_users m','m.userID=s.userID');
        $this->db->where('s.isActive', 1);
        $this->db->where('m.isActive', 1);
        return $this->db->count_all_results();
    }

    function checkUsernameBySACoountID($id, $username){
        $where=array(      
            's.isActive'=>1,
            'm.isActive'=>1,
            's.sAccountID'=>$id,
            'm.userName'=>$username
        );

        $this->db->select('*');
        $this->db->from('tbl_toppon_s_accounts s');
        $this->db->join('tbl_toppon_m_users m','m.userID=s.userID');
        $this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return 1; // allready exist
        }else{
            return 0; //blom ada
        }
    }

    function updateAccount($data, $id){
        $this->db->where('sAccountID',$id);
        $this->db->update('tbl_toppon_s_accounts',$data);

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }

}
?>