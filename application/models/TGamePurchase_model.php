<?php
class TGamePurchase_model extends CI_Model{

    function createTransactionGamePurchase($data){
        $this->db->insert('tbl_toppon_t_game_purchases', $data);
        return $this->db->insert_id();
    }

}
?>