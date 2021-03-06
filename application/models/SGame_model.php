<?php
class SGame_model extends CI_Model{

    function getGameListByPublisher($gameID, $isAgent){
        $this->db->select('a.sGameID,a.gameID,a.nominalID, b.currency,b.nominalName');

        if($isAgent){
            $this->db->select('a.agentValue as paymentValue');
        }else{
            $this->db->select('a.paymentValue as paymentValue');
        }

        $this->db->from('tbl_toppon_s_games a');
        $this->db->join('tbl_toppon_m_nominals b', 'a.nominalID = b.nominalID');
        $this->db->where('a.gameID', $gameID);
        $this->db->where('a.isActive', 1);
        $this->db->where('b.isActive', 1);
        $this->db->order_by('b.nominalName','asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getGameDetail($id){
        $this->db->select('sGameID,b.gameName, c.nominalName, currency,e.publisherName, paymentValue, agentValue, productCode');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->join('tbl_toppon_m_games b', 'a.gameID = b.gameID');
        $this->db->join('tbl_toppon_m_nominals c', 'a.nominalID = c.nominalID');
        $this->db->from('tbl_toppon_s_publishers d','a.gameID = d.gameID');
        $this->db->from('tbl_toppon_m_publishers e','e.publisherID = d.publisherID');
        $this->db->where('a.sGameID', $id);
        $this->db->where('a.isActive', 1);
        $this->db->where('b.isActive', 1);
        $this->db->where('c.isActive', 1);
        $this->db->where('d.isActive', 1);
        $this->db->where('e.isActive', 1);
        $query = $this->db->get();
        return $query->row();
    }

    function createSGame($data){
        $this->db->insert('tbl_toppon_s_games',$data);
        return $this->db->insert_id();
    }

    function updateSGame($data, $gameID, $settingID){
        if($gameID!=null){
            $this->db->where('gameID',$gameID);
        }
        if($settingID!=null){
            $this->db->where('sGameID',$settingID);
        }
        $this->db->where('isActive', 1);
        $this->db->update('tbl_toppon_s_games',$data);

        return $this->db->affected_rows();
    }

    //SETTING
    function getSGameList($start, $limit){
        $this->db->select('*');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->join('tbl_toppon_m_games c', 'c.gameID = a.gameID');
        $this->db->where('a.isActive', 1);
        $this->db->where('c.isActive', 1);
        $this->db->group_by('a.gameID');
        $this->db->order_by('c.gameName','asc');

        if($limit != null || $start!= null){
            $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
    function getCountSGameList(){
        $this->db->select('*');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->where('a.isActive', 1);
        $this->db->group_by('a.gameID');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function getNominalSettingListByGame($gameID){
        $this->db->select('a.nominalID, b.nominalName, b.currency, a.productCode, a.paymentValue,a.agentValue, a.sGameID');
        $this->db->from('tbl_toppon_s_games a');
        $this->db->join('tbl_toppon_m_nominals b', 'a.nominalID = b.nominalID');
        $this->db->where('a.gameID', $gameID);
        $this->db->where('a.isActive', 1);
        $this->db->where('b.isActive', 1);
        $this->db->group_by('a.nominalID');
        $this->db->order_by('b.nominalName','asc');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>