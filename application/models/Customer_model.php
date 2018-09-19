<?php

class Customer_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('table', 'session');
        $this->load->database();
    }

    public function lists($id = NULL) {

        $this->db->select('*');
        $this->db->from('customers');
        if ($id != "") {
            $this->db->where('md5(id)', $id);
        }
        $this->db->where('dels', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getajaxlists($id = NULL) {

        $this->db->select('*');
        $this->db->from('customers');
        if (isset($_POST['query']) && !empty($_POST['query'])) {
            $match=$_POST['query'];
            $this->db->or_where("name LIKE '%$match%'");
            $this->db->or_where("mobileno LIKE '%$match%'");
        }
        $this->db->where('dels', 0);
        $this->db->limit(10);  
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function save($set_data) {
        $this->db->insert('customers', $set_data);
        return ($this->db->affected_rows() > 0);
    }

    public function update($set_data, $id) {
        $this->db->where('md5(id)', $id);
        $this->db->update("customers", $set_data);
        return 1;
    }

    public function check_exist_customer($mobileno, $id = NULL) {
        $this->db->select('*');
        $this->db->from('customers');
        $this->db->where('mobileno', $mobileno);
        if ($id != "") {
            $this->db->where('md5(id) !=', $id);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function delete($id) {
        $this->db->where('md5(id)', $id);
        $this->db->delete("customers");
        return ($this->db->affected_rows() > 0);
    }

}
