<?php

class Orders_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('America/New_York');
        $this->load->library('table', 'session');
        $this->load->database();
    }

    public function companyorderlists($id = NULL, $data = array()) {

        $this->db->select('orderdetails.*,company.name,company.address,company.mobileno,products.productname');
        $this->db->from('orderdetails');
        $this->db->join('company', 'orderdetails.order_person_id = company.id');
        $this->db->join('products', 'orderdetails.product_id = products.id');
        if ($id != "") {
            $this->db->where('md5(orderdetails.id)', $id);
        }
        if (isset($data['created_on']) && !empty($data['created_on'])) {
            $this->db->where('DATE(orderdetails.created_on)', date('Y-m-d'));
        }
        $this->db->where('orderdetails.order_type', 'company');
        $this->db->where('orderdetails.dels', 0);
        $this->db->order_by('orderdetails.id', 'desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function customerorderlists($id = NULL, $data = array()) {

        $this->db->select('orderdetails.*,customers.name,customers.address,customers.mobileno,products.productname');
        $this->db->from('orderdetails');
        $this->db->join('customers', 'orderdetails.order_person_id = customers.id');
        $this->db->join('products', 'orderdetails.product_id = products.id');
        if ($id != "") {
            $this->db->where('md5(orderdetails.id)', $id);
        }
        if (isset($data['created_on']) && !empty($data['created_on'])) {
            $this->db->where('DATE(orderdetails.created_on)', date('Y-m-d'));
        }
        $this->db->where('orderdetails.order_type', 'customer');
        $this->db->where('orderdetails.dels', 0);
        $this->db->order_by('orderdetails.id', 'desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ajaxcustomerorderlists($data) {

        $this->db->select('orderdetails.*,customers.name,customers.address,customers.mobileno,products.productname');
        $this->db->from('orderdetails');
        $this->db->join('customers', 'orderdetails.order_person_id = customers.id');
        $this->db->join('products', 'orderdetails.product_id = products.id');
        $this->db->where('orderdetails.order_type', 'customer');
        $this->db->where('orderdetails.dels', 0);

        if (isset($data['searchString']) && !empty($data['searchString'])) {
            $this->db->group_start();
            $this->db->or_like('customers.name', $data['searchString']);
            $this->db->or_like('orderdetails.price', $data['searchString']);
            $this->db->or_like('orderdetails.quantity', $data['searchString']);
            $this->db->or_like('orderdetails.total_amount', $data['searchString']);
            $this->db->or_like('orderdetails.orderdate', $data['searchString']);
            $this->db->or_like('orderdetails.deliverydate', $data['searchString']);
            $this->db->group_end();
        }

        $this->db->order_by($data['sortingcolumn'], $data['orderby']);
        $this->db->limit($data['end'], $data['start']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ajaxcustomerordercount($data) {

        $this->db->select('count(orderdetails.id) as totalcount');
        $this->db->from('orderdetails');
        $this->db->join('customers', 'orderdetails.order_person_id = customers.id');
        $this->db->join('products', 'orderdetails.product_id = products.id');
        $this->db->where('orderdetails.order_type', 'customer');
        $this->db->where('orderdetails.dels', 0);

        if (isset($data['searchString']) && !empty($data['searchString'])) {
            $this->db->group_start();
            $this->db->or_like('customers.name', $data['searchString']);
            $this->db->or_like('orderdetails.price', $data['searchString']);
            $this->db->or_like('orderdetails.quantity', $data['searchString']);
            $this->db->or_like('orderdetails.total_amount', $data['searchString']);
            $this->db->or_like('orderdetails.orderdate', $data['searchString']);
            $this->db->or_like('orderdetails.deliverydate', $data['searchString']);
            $this->db->group_end();
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ajaxcompanyorderlists($data) {

        $this->db->select('orderdetails.*,company.name,company.address,company.mobileno,products.productname');
        $this->db->from('orderdetails');
        $this->db->join('company', 'orderdetails.order_person_id = company.id');
        $this->db->join('products', 'orderdetails.product_id = products.id');
        $this->db->where('orderdetails.order_type', 'company');
        $this->db->where('orderdetails.dels', 0);

        if (isset($data['searchString']) && !empty($data['searchString'])) {
            $this->db->group_start();
            $this->db->or_like('company.name', $data['searchString']);
            $this->db->or_like('orderdetails.price', $data['searchString']);
            $this->db->or_like('orderdetails.quantity', $data['searchString']);
            $this->db->or_like('orderdetails.total_amount', $data['searchString']);
            $this->db->or_like('orderdetails.orderdate', $data['searchString']);
            $this->db->or_like('orderdetails.orderstatus', $data['searchString']);
            $this->db->group_end();
        }

        $this->db->order_by($data['sortingcolumn'], $data['orderby']);
        $this->db->limit($data['end'], $data['start']);
        $query = $this->db->get();       
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ajaxcompanyordercount($data) {

        $this->db->select('count(orderdetails.id) as totalcount');
        $this->db->from('orderdetails');
        $this->db->join('company', 'orderdetails.order_person_id = company.id');
        $this->db->join('products', 'orderdetails.product_id = products.id');
        $this->db->where('orderdetails.order_type', 'company');
        $this->db->where('orderdetails.dels', 0);

        if (isset($data['searchString']) && !empty($data['searchString'])) {
            $this->db->group_start();
            $this->db->or_like('company.name', $data['searchString']);
            $this->db->or_like('orderdetails.price', $data['searchString']);
            $this->db->or_like('orderdetails.quantity', $data['searchString']);
            $this->db->or_like('orderdetails.total_amount', $data['searchString']);
            $this->db->or_like('orderdetails.orderstatus', $data['searchString']);
            $this->db->group_end();
        }

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
        $next = $this->db->query("SHOW TABLE STATUS LIKE 'orderdetails'");
        $next = $next->row(0);
        $set_data['orderno'] = "ORDERNO" . $next->Auto_increment;
        $this->db->insert('orderdetails', $set_data);
        if ($this->db->affected_rows() > 0) {
            $order_id = $this->db->insert_id();
            if (isset($_POST['measurement_value']) && !empty($_POST['measurement_value'])) {
                foreach ($_POST['measurement_value'] as $key => $value) {
                    $this->db->insert('orderdetailsvalue', array('order_id' => $order_id, 'measurementvalue' => $value, 'measurement_id' => $key));
                }
            }
            if (isset($_POST['producttype']) && !empty($_POST['producttype'])) {
                foreach ($_POST['producttype'] as $key => $value) {
                    $this->db->insert('producttypevalue', array('order_id' => $order_id, 'type_id' => $key));
                }
            }
            $i = 1;
        }
        return $i;
    }

    public function updatemeasurementvalues($orderid) {
        if (isset($_POST['measurement_value']) && !empty($_POST['measurement_value'])) {
            foreach ($_POST['measurement_value'] as $key => $value) {
                $this->db->where('order_id', $orderid);
                $this->db->where('measurement_id', $key);
                $this->db->update('orderdetailsvalue', array('measurementvalue' => $value));
            }
        }
    }

    public function update($set_data, $id) {
        $this->db->where('md5(id)', $id);
        $this->db->update("orderdetails", $set_data);
        return 1;
    }

    public function delete($id) {
        $this->db->where('md5(id)', $id);
        $this->db->delete("orderdetails");
        return ($this->db->affected_rows() > 0);
    }

    public function measurementvalues() {

        if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
            $this->db->select('measurements.*,orderdetailsvalue.measurementvalue');
            $this->db->from('measurements');
            $this->db->join('orderdetailsvalue', 'measurements.id = orderdetailsvalue.measurement_id', 'left');
            $this->db->where('md5(orderdetailsvalue.order_id)', $_POST['order_id']);
        } else {
            $this->db->select("measurements.*,'' as measurementvalue");
            $this->db->from('measurements');
        }
        if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
            $this->db->where('measurements.product_id', $_POST['product_id']);
        }
        $this->db->where('measurements.dels', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function producttypevalues() {
        $result = array();
        $this->db->select("*,'' as typevalue");
        $this->db->from('product_types');
        $this->db->where('dels', 0);
        if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
            $this->db->where('product_id', $_POST['product_id']);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();

            if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
                foreach ($result as $key => $value) {
                    $typval = array();
                    $this->db->select("*");
                    $this->db->from('producttypevalue');
                    $this->db->where('md5(order_id)', $_POST['order_id']);
                    $this->db->where('type_id', $value['id']);
                    $query1 = $this->db->get();
                    if ($query1->num_rows() > 0) {
                        $result[$key]['typevalue'] = 'checked';
                    }
                }
            }
            return $result;
        } else {
            return array();
        }
    }

    public function producttypeview() {
        $result = array();
        if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
            $this->db->select("product_types.*");
            $this->db->from('product_types');
            $this->db->join('producttypevalue', 'product_types.id = producttypevalue.type_id');
            $this->db->where('md5(producttypevalue.order_id)', $_POST['order_id']);
            $this->db->where('product_types.dels', 0);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
        }
        return $result;
    }

    public function updatetypevalues($orderid) {
        $this->db->where('order_id', $orderid);
        $this->db->delete("producttypevalue");
        if (isset($_POST['producttype']) && !empty($_POST['producttype'])) {
            foreach ($_POST['producttype'] as $key => $value) {
                $this->db->insert('producttypevalue', array('order_id' => $orderid, 'type_id' => $key, 'typevalue' => 'checked'));
            }
        }
    }

    public function companyreport() {
        $this->db->select('orderdetails.*,company.name,company.mobileno');
        $this->db->from('orderdetails');
        $this->db->join('company', 'orderdetails.order_person_id = company.id');
        if (isset($_POST['fromdate']) && !empty($_POST['fromdate'])) {
            $this->db->where('orderdetails.orderdate >=', $_POST['fromdate']);
        }
        if (isset($_POST['todate']) && !empty($_POST['todate'])) {
            $this->db->where('orderdetails.orderdate <=', $_POST['todate']);
        }
        if (isset($_POST['companyid']) && !empty($_POST['companyid']) && isset($_POST['companyname']) && !empty($_POST['companyname'])) {
            $this->db->where('company.id', $_POST['companyid']);
        }

        $this->db->where('orderdetails.order_type', 'company');
        $this->db->where('orderdetails.dels', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function customerreport() {
        $this->db->select('orderdetails.*,customers.name,customers.mobileno');
        $this->db->from('orderdetails');
        $this->db->join('customers', 'orderdetails.order_person_id = customers.id');
        if (isset($_POST['fromdate']) && !empty($_POST['fromdate'])) {
            $this->db->where('orderdetails.orderdate >=', $_POST['fromdate']);
        }
        if (isset($_POST['todate']) && !empty($_POST['todate'])) {
            $this->db->where('orderdetails.orderdate <=', $_POST['todate']);
        }
        if (isset($_POST['customerid']) && !empty($_POST['customerid']) && isset($_POST['customername']) && !empty($_POST['customername'])) {
            $this->db->where('customers.id', $_POST['customerid']);
        }
        $this->db->where('orderdetails.order_type', 'customer');
        $this->db->where('orderdetails.dels', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function staffreport() {
        $this->db->select('staffbalance.*,users.firstname,users.lastname,users.mobileno');
        $this->db->from('staffbalance');
        $this->db->join('users', 'staffbalance.user_id = users.id');
        if (isset($_POST['fromdate']) && !empty($_POST['fromdate'])) {
            $this->db->where('staffbalance.buydate >=', $_POST['fromdate']);
        }
        if (isset($_POST['todate']) && !empty($_POST['todate'])) {
            $this->db->where('staffbalance.buydate <=', $_POST['todate']);
        }
        if (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['username']) && !empty($_POST['username'])) {
            $this->db->where('users.id', $_POST['user_id']);
        }
        $this->db->where('staffbalance.dels', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ajaxstaffreport($data) {

        $this->db->select('staffbalance.*,users.firstname,users.lastname,users.mobileno');
        $this->db->from('staffbalance');
        $this->db->join('users', 'staffbalance.user_id = users.id');
        if (isset($data['searchString']) && !empty($data['searchString'])) {
            $querystring = "(staffbalance.buydate LIKE '%" . $data['searchString'] . "%' OR staffbalance.amount LIKE '%" . $data['searchString'] . "%' OR users.firstname LIKE '%" . $data['searchString'] . "%'  OR users.lastname LIKE '%" . $data['searchString'] . "%' OR users.mobileno LIKE '%" . $data['searchString'] . "%')";
            $this->db->where($querystring);
        }
        if (isset($data['fromdate']) && !empty($data['fromdate'])) {
            $this->db->where('staffbalance.buydate >=', $data['fromdate']);
        }
        if (isset($data['todate']) && !empty($data['todate'])) {
            $this->db->where('staffbalance.buydate <=', $data['todate']);
        }
        if (isset($data['user_id']) && !empty($data['user_id']) && isset($data['username']) && !empty($data['username'])) {
            $this->db->where('users.id', $data['user_id']);
        }
        $this->db->where('staffbalance.dels', 0);
        $this->db->order_by($data['sortingcolumn'], $data['orderby']);
        $this->db->limit($data['end'], $data['start']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ajaxstaffreportcount($data) {

        $this->db->select('count(staffbalance.id) as totalcount');
        $this->db->from('staffbalance');
        $this->db->join('users', 'staffbalance.user_id = users.id');
        if (isset($data['searchString']) && !empty($data['searchString'])) {
            $querystring = "(staffbalance.buydate LIKE '%" . $data['searchString'] . "%' OR staffbalance.amount LIKE '%" . $data['searchString'] . "%' OR users.firstname LIKE '%" . $data['searchString'] . "%'  OR users.lastname LIKE '%" . $data['searchString'] . "%' OR users.mobileno LIKE '%" . $data['searchString'] . "%')";
            $this->db->where($querystring);
        }
        if (isset($data['fromdate']) && !empty($data['fromdate'])) {
            $this->db->where('staffbalance.buydate >=', $data['fromdate']);
        }
        if (isset($data['todate']) && !empty($data['todate'])) {
            $this->db->where('staffbalance.buydate <=', $data['todate']);
        }
        if (isset($data['user_id']) && !empty($data['user_id']) && isset($data['username']) && !empty($data['username'])) {
            $this->db->where('users.id', $data['user_id']);
        }
        $this->db->where('staffbalance.dels', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function companyorderdeliverylists($data) {

        $this->db->select('*');
        $this->db->from('companydeliverydetails');
        if (isset($data['order_id']) && !empty($data['order_id'])) {
            $this->db->where('md5(companydeliverydetails.order_id)', $data['order_id']);
        }
        $this->db->where('companydeliverydetails.dels', 0);
        $this->db->order_by('companydeliverydetails.id', 'desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getcompanyorderdeliverylists($data) {
        $result = array();
        if (isset($data['id']) && !empty($data['id'])) {
            $this->db->select('*');
            $this->db->from('companydeliverydetails');
            $this->db->where('md5(companydeliverydetails.id)', $data['id']);
            $this->db->where('companydeliverydetails.dels', 0);
            $this->db->order_by('companydeliverydetails.id', 'desc');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
        }
        return $result;
    }

    public function getdeliveryquantity($orderid) {
        $result = array();
        if (!empty($orderid)) {
            $this->db->select('sum(deliveryquantity) as totaldeliveryquanity');
            $this->db->from('companydeliverydetails');
            $this->db->where('md5(companydeliverydetails.order_id)', $orderid);
            $this->db->where('companydeliverydetails.dels', 0);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
        }
        return $result;
    }

    public function savedeliveryquantity($set_data) {
        $this->db->insert('companydeliverydetails', $set_data);
        return ($this->db->affected_rows() > 0);
    }

    public function updatedeliveryquantity($set_data, $id) {
        $this->db->where('id', $id);
        $this->db->update("companydeliverydetails", $set_data);
        return 1;
    }

    public function deletedeliveryquantity($id) {
        $this->db->where('md5(id)', $id);
        $this->db->delete("companydeliverydetails");
        return ($this->db->affected_rows() > 0);
    }

    public function ordercount($type) {
        $result = 0;
        $currentdate = date('Y-m-d');
        $this->db->select('count(*) as totalorder');
        $this->db->from('orderdetails');
        if ($type == 'today') {
            $this->db->where('DATE(created_on)', date('Y-m-d'));
        }
        if ($type == 'yesterday') {
            $this->db->where('DATE(created_on) = DATE_SUB(CURDATE(),INTERVAL 1 DAY)');
        }
        if ($type == 'lastweek') {
            $this->db->where('YEARWEEK(DATE(created_on),1) = YEARWEEK(CURRENT_DATE, 1)');
        }
        $this->db->where('orderdetails.dels', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $list = $query->result_array();
            $result = $list[0]['totalorder'];
        }

        return $result;
    }    
}
