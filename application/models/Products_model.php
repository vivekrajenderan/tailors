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
        } else {
            return array();
        }
    }

    public function typelists($id = NULL) {

        $this->db->select('product_types.*,products.productname');
        $this->db->from('product_types');
        $this->db->join('products', 'product_types.product_id = products.id');
        if ($id != "") {
            $this->db->where('md5(product_types.id)', $id);
        }
        $this->db->where('product_types.dels', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function measurementlists($wheredata) {

        $this->db->select('*');
        $this->db->from('measurements');
        if (count($wheredata) > 0) {
            $this->db->where($wheredata);
        }
        $this->db->where('dels', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function save($set_data) {
        $i = 0;
        $this->db->insert('products', $set_data);
        if ($this->db->affected_rows() > 0) {
            $this->savemeasurement($this->db->insert_id(), json_decode($_POST['measurementkeyarray']));
            $i = 1;
        }
        return $i;
    }

    public function savemeasurement($productid, $measurement, $removemeasurement = array()) {
        if (count($measurement) > 0) {
            foreach ($measurement as $key => $value) {
                if (!empty($value->id) && !empty($value->mname)) {
                    $this->db->where('id', $value->id)->update('measurements', array('mname' => $value->mname));
                } else {
                    $this->db->insert('measurements', array('product_id' => $productid, 'mname' => $value->mname));
                }
            }

            //Remove measurement
            if (count($removemeasurement) > 0) {
                $deletekey = array_column((array) $removemeasurement, 'id');
                $insertkey = array_column((array)$measurement, 'id');
                $resultkey = array_diff($deletekey, $insertkey);
                foreach ($resultkey as $rkey => $rvalue) {
                    $this->db->where('id', $rvalue)->update('measurements', array('dels' => 1));
                }
            }
        } else {
            $this->db->where('product_id', $productid)->update('measurements', array('dels' => 1));
        }
    }

    public function update($set_data, $id) {
        $this->db->where('md5(id)', $id);
        $this->db->update("products", $set_data);
        return 1;
    }
    
    public function updatetype($set_data, $id) {
        $this->db->where('md5(id)', $id);
        $this->db->update("product_types", $set_data);
        return 1;
    }
    
    public function savetype($set_data) {
        $i = 0;
        $this->db->insert('product_types', $set_data);
        if ($this->db->affected_rows() > 0) {            
            $i = 1;
        }
        return $i;
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
    
    public function deletetype($id) {
        $this->db->where('md5(id)', $id);
        $this->db->delete("product_types");
        return ($this->db->affected_rows() > 0);
    }

}
