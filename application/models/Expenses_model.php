<?php

class Expenses_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('table', 'session');
        $this->load->database();
    }    
    public function otherexpenseslists($id=NULL) {
        $this->db->select('expenses.*,expensetype.name');
        $this->db->from('expenses');
        $this->db->join('expensetype', 'expenses.expense_type_id = expensetype.id');
        if (isset($_POST['fromdate']) && !empty($_POST['fromdate'])) {
            $this->db->where('DATE(expenses.created_on) >=', $_POST['fromdate']);
        }
        if (isset($_POST['todate']) && !empty($_POST['todate'])) {
            $this->db->where('DATE(expenses.created_on) <=', $_POST['todate']);
        }
        if (isset($_POST['expense_type_id']) && !empty($_POST['expense_type_id']) && isset($_POST['typename']) && !empty($_POST['typename'])) {
            $this->db->where('expenses.expense_type_id', $_POST['expense_type_id']);
        }
        if (!empty($id)) {
            $this->db->where('md5(expenses.id)', $id);
        }        
        $this->db->where('expenses.dels', 0);
        $query = $this->db->get();       
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function expensetypelists() {
        $this->db->select('*');
        $this->db->from('expensetype');        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function saveexpenses($set_data) {
        $this->db->insert('expenses', $set_data);
        return ($this->db->affected_rows() > 0);
    }

    public function updateexpenses($set_data, $id) {        
        $this->db->where('md5(id)', $id);
        $this->db->update("expenses", $set_data);
        return 1;
    }

    public function deleteexpenses($id) {
        $this->db->where('md5(id)', $id);
        $this->db->delete("expenses");
        return ($this->db->affected_rows() > 0);
    }

}
