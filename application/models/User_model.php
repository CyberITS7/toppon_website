<?php  
	class User_model extends CI_Model{
		function createUser($data){        
	        $this->db->insert('tbl_toppon_m_users',$data);
	        $result=$this->db->affected_rows();
	        return $result;
	    }

	    function getUsernamePassword($username){
		    $where=array(
	            'username'=>$username,        
	            'isActive'=>1
	        );
	        
	        $this->db->select('*');
	        $this->db->from('tbl_toppon_m_users');
	        $this->db->where($where);    	        
	        $query = $this->db->get();
	        
	        return $query->row();
	    }

	    function checkUsername($username)
	    {
	        $this->db->select('*');
	        $this->db->from('tbl_toppon_m_users');
	        $this->db->where('username',$username);	        
	        $this->db->where('isActive', 1);
	        $query = $this->db->get();
	        if($query->num_rows()>0){
	            return 1; // allready exist
	        }else{
	            return 0; //blom ada
	        }
	    }

	    function checkEmail($email)
	    {
	        $this->db->select('*');
	        $this->db->from('tbl_toppon_m_users');
	        $this->db->where('email',$email);
	        $this->db->where('isActive', 1);
	        $query = $this->db->get();
	        if($query->num_rows()>0){
	            return 1; // allready exist
	        }else{
	            return 0; //blom ada
	        }
	    }

	    function checkPhone($phoneNumber){
	    	$this->db->select('*');
	        $this->db->from('tbl_toppon_m_users');
	        $this->db->where('phoneNumber',$phoneNumber);
	        $this->db->where('isActive', 1);
	        $query = $this->db->get();
	        if($query->num_rows()>0){
	            return 1; // allready exist
	        }else{
	            return 0; //blom ada
	        }
	    }
	}
?>