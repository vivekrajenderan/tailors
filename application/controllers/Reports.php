<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('products_model');
        $this->load->model('orders_model');
        $this->load->model('company_model');
        $this->load->model('customer_model');
        $this->load->model('users_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        } else if ($this->session->userdata('role') == 2) {
            redirect(base_url() . 'customer/', 'refresh');
        }
    }

    public function company() {
        //echo "<pre>".print_r($_POST);die;

        if (!isset($_POST['fromdate']) && empty($_POST['fromdate'])) {
            $_POST['fromdate'] = date('Y-m-d');
        }
        if (!isset($_POST['todate']) && empty($_POST['todate'])) {
            $_POST['todate'] = date('Y-m-d');
        }

        $orders_lists = $this->orders_model->companyreport();
        $list = $this->company_model->lists();
        $company_list = array();
        foreach ($list as $key => $value) {
            $company_list[] = array('id' => $value['id'], 'name' => $value['name']);
        }
        $data = array('orders_lists' => $orders_lists, 'company_list' => $company_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('reports/company', $data);
        $this->load->view('includes/footer');
    }

    public function customer() {
        if (!isset($_POST['fromdate']) && empty($_POST['fromdate'])) {
            $_POST['fromdate'] = date('Y-m-d');
        }
        if (!isset($_POST['todate']) && empty($_POST['todate'])) {
            $_POST['todate'] = date('Y-m-d');
        }
        $orders_lists = $this->orders_model->customerreport();
        $data = array('orders_lists' => $orders_lists);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('reports/customer', $data);
        $this->load->view('includes/footer');
    }

    public function getcustomer() {
        $list = $this->customer_model->getajaxlists();
        $customer_list = array();
        foreach ($list as $key => $value) {
            $customer_list[] = array('id' => $value['id'], 'name' => $value['name'] . " " . $value['mobileno']);
        }
        echo json_encode($customer_list);
    }

    public function staff() {
        $orders_lists = $this->orders_model->staffreport();
        $list = $this->users_model->lists();
        $user_list = array();
        foreach ($list as $key => $value) {
            $user_list[] = array('id' => $value['id'], 'name' => $value['firstname'] . '' . $value['lastname']);
        }
        $data = array('orders_lists' => $orders_lists, 'user_list' => $user_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('reports/staff', $data);
        $this->load->view('includes/footer');
    }

    public function ajaxstaff() {
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
        $end = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;

        $ordercolumn = array('0' => 'staffbalance.buydate', '1' => 'users.firstname', '2' => 'users.mobileno', '3' => 'staffbalance.amount');
        $pagecolumn = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
        $pageorder = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'desc';
        $searchvalue = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : "";
        $sortingcolumn = 'orderno';
        if (isset($ordercolumn[$pagecolumn])) {
            $sortingcolumn = $ordercolumn[$pagecolumn];
        }
        $fromdate = "";
        if (isset($_REQUEST['fromdate']) && !empty($_REQUEST['fromdate'])) {
            $fromdate = $_REQUEST['fromdate'];
        }

        $todate = "";
        if (isset($_REQUEST['todate']) && !empty($_REQUEST['todate'])) {
            $todate = $_REQUEST['todate'];
        }
        $username = "";
        if (isset($_REQUEST['username']) && !empty($_REQUEST['username'])) {
            $username = $_REQUEST['username'];
        }
        $user_id = "";
        if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {
            $user_id = $_REQUEST['user_id'];
        }
        $data = array('sortingcolumn' => $sortingcolumn, 'orderby' => $pageorder,
            'searchString' => $searchvalue,
            'start' => $start,
            'end' => $end,
            'user_id' => $user_id,
            'username' => $username,
            'fromdate' => $fromdate,
            'todate' => $todate);
        $orders_lists = $this->orders_model->ajaxstaffreport($data);
        $orders_count = $this->orders_model->ajaxstaffreportcount($data);

        $pcount = 0;
        if (isset($orders_count[0]['totalcount']) && !empty($orders_count[0]['totalcount']))
            $pcount = ($orders_count[0]['totalcount']);
        $dataR = array(
            'data' => array(),
            "draw" => isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 1,
            "recordsTotal" => $pcount,
            "recordsFiltered" => $pcount,
        );
        foreach ($orders_lists as $key => $value) {
            $tempD = array();
            // Row based column PUSH
            $tempD[] = $value['buydate'];
            $tempD[] = $value['firstname'] . " " . $value['lastname'];
            $tempD[] = $value['mobileno'];
            $tempD[] = $value['amount'];
            $tempD["DT_RowId"] = md5($value['id']);
            // Row  PUSH
            $dataR['data'][] = $tempD;
        }
        echo json_encode($dataR);
        exit();
    }

    public function otherexpenses() {
        $expenseslists = $this->orders_model->otherexpenseslists();
        $type_list = $this->orders_model->expensetypelists();
        $data = array('expenseslists' => $expenseslists, 'type_list' => $type_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('reports/expenses', $data);
        $this->load->view('includes/footer');
    }

    public function otherexpenseadd($id = NULL) {
        $expenseslists = array();
        if ($id != "") {
            $expenseslists = $this->orders_model->otherexpenseslists($id);
            if (count($expenseslists) == 0) {
                redirect(base_url() . 'reports/otherexpenses', 'refresh');
            }
        }
        $type_list = $this->orders_model->expensetypelists();
        $data = array('expenseslists' => $expenseslists, 'id' => $id, 'type_list' => $type_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('reports/expensesadd', $data);
        $this->load->view('includes/footer');
    }

    public function ajaxexpensesave($id = NULL) {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[2]|max_length[10]');
            $this->form_validation->set_rules('expense_type_id', 'Expense Type', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('amount' => trim($this->input->post('amount')),
                    'expense_type_id' => trim($this->input->post('expense_type_id'))
                );
                if ($id != "") {
                    $data['updated_on'] = date('Y-m-d H:i:s');
                    $saveexpenses = $this->orders_model->updateexpenses($data, $id);
                } else {
                    $data['created_on'] = date('Y-m-d H:i:s');
                    $saveexpenses = $this->orders_model->saveexpenses($data);
                }
                if ($saveexpenses == 1) {
                    $this->session->set_flashdata('SucMessage', 'Expenses Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Expenses Saved Not Successfully'));
                }
            }
        }
    }

    public function expensesdelete($id = NULL) {
        if ($id != "") {
            $deleteExpenses = $this->orders_model->deleteexpenses($id);
            if ($deleteExpenses == "1") {
                $this->session->set_flashdata('SucMessage', 'Expenses has been deleted successfully!!!');
            } else {
                $this->session->set_flashdata('ErrorMessages', 'Expenses has not been deleted successfully!!!');
            }
            redirect(base_url() . 'reports/otherexpenses', 'refresh');
        } else {
            redirect(base_url() . 'reports/otherexpenses', 'refresh');
        }
    }

}
