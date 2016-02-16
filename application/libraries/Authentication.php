<?php 
    class Authentication 
    {
        public function isAuthorizeMember($currentUserLevel)
        {
            if($currentUserLevel == 'member' || $currentUserLevel == 'super_admin' )            
                {return true;}
            else
                {return false;}
            
        }
        
        public function isAuthorizeSuperAdmin($currentUserLevel)
        {
            if($currentUserLevel == 'super_admin' )            
                {return true;}
            else
                {return false;}
        }
    }
?>