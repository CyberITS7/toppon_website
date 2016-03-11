<?php  
	class User_model extends CI_Model{
		function createUser($data){        
	        $this->db->insert('tbl_toppon_m_users',$data);
	        $result=$this->db->insert_id();
	        return $result;
	    }

	    function updateUser($data, $id){
	        $this->db->where('userID',$id);
	        $this->db->update('tbl_toppon_m_users',$data);

	        if ($this->db->affected_rows() == 1)
	            return TRUE;
	        else
	            return FALSE;
	    }

	    function getPasswordbyUsername($username){
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

	    function getUserIDbyUsername($username)
	    {
	        $this->db->select('userID');
	        $this->db->from('tbl_toppon_m_users');
	        $this->db->where('username',$username);	        
	        $this->db->where('isActive', 1);
	        $query = $this->db->get();
	        
	        return $query->row();
	    }

	    function getUserDetailByUsername($username){
	    	$this->db->select('*');
	        $this->db->from('tbl_toppon_m_users');
	        $this->db->where('username',$username);
	        $this->db->where('isActive', 1);
	        $query = $this->db->get();
	        
	        return $query->row();
	    }

	    function getUserLevelbyUsername($username)
	    {
	        $this->db->select('userLevel');
	        $this->db->from('tbl_toppon_m_users');
	        $this->db->where('username',$username);	        
	        $this->db->where('isActive', 1);
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

	    function checkUsernameExceptSelf($username, $userID)
	    {
	        $this->db->select('*');
	        $this->db->from('tbl_toppon_m_users');
	        $this->db->where('username',$username);	        
	        $this->db->where('isActive', 1);
	        $this->db->where('userID !=', $userID);
	        $query = $this->db->get();
	        if($query->num_rows()>0){
	            return 1; // allready exist
	        }else{
	            return 0; //blom ada
	        }
	    }

	    function checkEmailExceptSelf($email, $userID)
	    {
	        $this->db->select('*');
	        $this->db->from('tbl_toppon_m_users');
	        $this->db->where('email',$email);
	        $this->db->where('isActive', 1);
	        $this->db->where('userID !=', $userID);
	        $query = $this->db->get();
	        if($query->num_rows()>0){
	            return 1; // allready exist
	        }else{
	            return 0; //blom ada
	        }
	    }

	    function checkPhoneExceptSelf($phoneNumber, $userID){
	    	$this->db->select('*');
	        $this->db->from('tbl_toppon_m_users');
	        $this->db->where('phoneNumber',$phoneNumber);
	        $this->db->where('isActive', 1);
	        $this->db->where('userID !=', $userID);
	        $query = $this->db->get();
	        if($query->num_rows()>0){
	            return 1; // allready exist
	        }else{
	            return 0; //blom ada
	        }
	    }
	}
?>