<?php

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('table', 'session');
        $this->load->database();
    }

    public function lists($id = NULL) {

        $this->db->select('*');
        $this->db->from('users');
        if ($id != "") {
            $this->db->where('md5(id)', $id);
        }
        if ($this->session->userdata('role') == 2) {
            $this->db->where('role', 2);
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
        $this->db->insert('users', $set_data);
        return ($this->db->affected_rows() > 0);
    }

    public function update($set_data, $id) {
        $this->db->where('md5(id)', $id);
        $this->db->update("users", $set_data);
        return 1;
    }

    public function check_exist_users($username, $id = NULL) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
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
        $this->db->delete("users");
        return ($this->db->affected_rows() > 0);
    }

    public function balancelists($id = NULL) {

        $this->db->select('staffbalance.*,users.firstname,users.lastname,users.mobileno');
        $this->db->from('staffbalance');
        $this->db->join('users', 'staffbalance.user_id = users.id');
        if ($id != "") {
            $this->db->where('md5(staffbalance.id)', $id);
        }
        $this->db->where('staffbalance.dels', 0);
        $this->db->order_by('staffbalance.id', 'desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function savebalance($set_data) {
        $this->db->insert('staffbalance', $set_data);
        return ($this->db->affected_rows() > 0);
    }

    public function updatebalance($set_data, $id) {
        $this->db->where('md5(id)', $id);
        $this->db->update("staffbalance", $set_data);
        return 1;
    }

    public function deletebalance($id) {
        $this->db->where('md5(id)', $id);
        $this->db->delete("staffbalance");
        return ($this->db->affected_rows() > 0);
    }

    public function salaryproductvalues($salaryid = NULL) {
        $result = array();
        $this->db->select("*,'' as quantity,'' as price,'' as typevalue");
        $this->db->from('products');
        $this->db->where('ptype', 'Insourcing');
        $this->db->where('dels', 0);
        if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
            $this->db->where('id', $_POST['product_id']);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            if (!empty($salaryid)) {
                foreach ($result as $key => $value) {
                    $typval = array();
                    $this->db->select("*");
                    $this->db->from('salaryproductdetails');
                    $this->db->where('md5(salary_id)', $salaryid);
                    $this->db->where('product_id', $value['id']);
                    $query1 = $this->db->get();
                    if ($query1->num_rows() > 0) {
                        $productdetails = $query1->result_array();
                        $result[$key]['typevalue'] = 'checked';
                        $result[$key]['quantity'] = $productdetails[0]['quantity'];
                        $result[$key]['price'] = $productdetails[0]['quantity'];
                    }
                }
            }
            return $result;
        } else {
            return array();
        }
    }

    public function savesallary($set_data) {
        $this->db->insert('staffsalary', $set_data);
        return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : 0;
    }

    public function updatesallary($set_data, $id) {
        $this->db->where('md5(id)', $id);
        $this->db->update("staffsalary", $set_data);
        return 1;
    }

    public function deletesallaryproductdetails($id) {
        $this->db->where('md5(salary_id)', $id);
        $this->db->delete("salaryproductdetails");
        return ($this->db->affected_rows() > 0);
    }

    public function savesallaryproductdetails($set_data) {
        $this->db->insert('salaryproductdetails', $set_data);
        return ($this->db->affected_rows() > 0);
    }

    public function salarylists($id = NULL) {

        $this->db->select('staffsalary.*,users.firstname,users.lastname,users.mobileno');
        $this->db->from('staffsalary');
        $this->db->join('users', 'staffsalary.user_id = users.id');
        if ($id != "") {
            $this->db->where('md5(staffsalary.id)', $id);
        }
        if (isset($_POST['fromdate']) && !empty($_POST['fromdate'])) {
            $this->db->where('DATE(staffsalary.created_on) >=', $_POST['fromdate']);
        }
        if (isset($_POST['todate']) && !empty($_POST['todate'])) {
            $this->db->where('DATE(staffsalary.created_on) <=', $_POST['todate']);
        }
        if (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['username']) && !empty($_POST['username'])) {
            $this->db->where('staffsalary.user_id', $_POST['user_id']);
        }
        $this->db->where('staffsalary.dels', 0);
        $this->db->order_by('staffsalary.id', 'desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function viewsalarylists($id = NULL) {

        $this->db->select('staffsalary.*,users.firstname,users.lastname,users.mobileno');
        $this->db->from('staffsalary');
        $this->db->join('users', 'staffsalary.user_id = users.id');
        if ($id != "") {
            $this->db->where('md5(staffsalary.user_id)', $id);
        }
        $this->db->where('staffsalary.dels', 0);
        $this->db->where('staffsalary.status', 0);
        $this->db->order_by('staffsalary.id', 'desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function updateusersallary($set_data, $id) {
        $this->db->where('md5(user_id)', $id);
        $this->db->update("staffsalary", $set_data);
        return 1;
    }

}
