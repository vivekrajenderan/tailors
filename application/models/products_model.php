<?php

class Products_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('America/New_York');
        $this->load->library('table', 'session');
        $this->load->database();
    }

    public function lists($id = NULL) {

        $this->db->select('*');
        $this->db->from('products');
        if ($id != "") {
            $this->db->where('md5(id)', $id);
        }
        $this->db->where('dels', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }

    public function save($set_data) {
        $this->db->insert('products', $set_data);
        return ($this->db->affected_rows() > 0);
    }

    public function update($set_data, $id) {
        $this->db->where('md5(id)', $id);
        $this->db->update("products", $set_data);
        return 1;
    }

    public function check_exist_product($name, $id = NULL) {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('productname', $name);
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
        $this->db->delete("products");
        return ($this->db->affected_rows() > 0);
    }

}
