<?php

class Expenses_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('table', 'session');
        $this->load->database();
    }    
    public function otherexpenseslists($id=NULL) {
        $this->db->select('account_trans.*,account.name');
        $this->db->from('account_trans');
        $this->db->join('account', 'account_trans.reference_id = account.id');
        if (isset($_POST['fromdate']) && !empty($_POST['fromdate'])) {
            $this->db->where('DATE(account_trans.created_on) >=', $_POST['fromdate']);
        }
        if (isset($_POST['todate']) && !empty($_POST['todate'])) {
            $this->db->where('DATE(account_trans.created_on) <=', $_POST['todate']);
        }
        if (isset($_POST['reference_id']) && !empty($_POST['reference_id']) && isset($_POST['typename']) && !empty($_POST['typename'])) {
            $this->db->where('account_trans.reference_id', $_POST['reference_id']);
        }
        if (!empty($id)) {
            $this->db->where('md5(account_trans.id)', $id);
        }        
        $this->db->where('account_trans.transtype','expense');
        $this->db->where('account_trans.dels', 0);
        $query = $this->db->get();       
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function accountlists($id=NULL) {
        $this->db->select('*');
        $this->db->from('account');  
        $this->db->where('account_type', 'expenses');
        if (!empty($id)) {
            $this->db->where('id', $id);
        } 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function saveexpenses($set_data) {
        $this->db->insert('account_trans', $set_data);
        return ($this->db->affected_rows() > 0);
    }

    public function updateexpenses($set_data, $id) {        
        $this->db->where('md5(id)', $id);
        $this->db->update("account_trans", $set_data);
        return 1;
    }

    public function deleteexpenses($id) {
        $this->db->where('md5(id)', $id);
        $this->db->delete("account_trans");
        return ($this->db->affected_rows() > 0);
    }

}
