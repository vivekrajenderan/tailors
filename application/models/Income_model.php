<?php

class Income_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('table', 'session');
        $this->load->database();
    }

    public function incomelists($id = NULL) {
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
        $this->db->where('account_trans.transtype', 'income');
        $this->db->where('account_trans.dels', 0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function accountlists() {
        $this->db->select('*');
        $this->db->from('account');
        $this->db->where('account_type', 'income');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function saveincome($set_data) {
        $this->db->insert('account_trans', $set_data);
        return ($this->db->affected_rows() > 0);
    }

    public function updateincome($set_data, $id) {
        $this->db->where('md5(id)', $id);
        $this->db->update("account_trans", $set_data);
        return 1;
    }

    public function deleteincome($id) {
        $this->db->where('md5(id)', $id);
        $this->db->delete("account_trans");
        return ($this->db->affected_rows() > 0);
    }

    public function cashlist() {
        $this->db->select('SUM(case when transtype="expense" then COALESCE(amount,0) else 0 end) AS expensetotalamount,'
                . 'SUM(case when transtype="income" then COALESCE(amount,0) else 0 end) AS incometotalamount');
        $this->db->from('account_trans');
        if (isset($_POST['fromdate']) && !empty($_POST['fromdate'])) {
            $this->db->where('DATE(account_trans.created_on) >=', $_POST['fromdate']);
        } else {
            $this->db->where('DATE(account_trans.created_on) >=', date('Y-m-d'));
        }
        if (isset($_POST['todate']) && !empty($_POST['todate'])) {
            $this->db->where('DATE(account_trans.created_on) <=', $_POST['todate']);
        } else {
            $this->db->where('DATE(account_trans.created_on) <=', date('Y-m-d'));
        }
        $this->db->where('account_trans.dels', 0);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $returnresult = $query->result_array();
            $this->db->select('sum(staffsalary.balanceamount-staffsalary.debitamount) as staffamount');
            $this->db->from('staffsalary');
            if (isset($_POST['fromdate']) && !empty($_POST['fromdate'])) {
                $this->db->where('DATE(staffsalary.created_on) >=', $_POST['fromdate']);
            } else {
                $this->db->where('DATE(staffsalary.created_on) >=', date('Y-m-d'));
            }
            if (isset($_POST['todate']) && !empty($_POST['todate'])) {
                $this->db->where('DATE(staffsalary.created_on) <=', $_POST['todate']);
            } else {
                $this->db->where('DATE(staffsalary.created_on) <=', date('Y-m-d'));
            }
            $query1 = $this->db->get();
            
            if ($query1->num_rows() > 0) {
                $staffamount = $query1->result_array();                
                $returnresult[0]['expensetotalamount'] -= isset($staffamount[0]['staffamount']) ? $staffamount[0]['staffamount'] : 0;
            }
            return $returnresult;
        } else {
            return array();
        }
    }

}
