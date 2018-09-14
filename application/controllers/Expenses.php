<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {

    public function __construct() {

        parent::__construct();
        
        $this->load->model('expenses_model');        
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        }
    }  

    public function index() {        
        $expenseslists = $this->expenses_model->otherexpenseslists();
        $type_list = $this->expenses_model->expensetypelists();
        $data = array('expenseslists' => $expenseslists, 'type_list' => $type_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('expenses/expenses', $data);
        $this->load->view('includes/footer');
    }

    public function add($id = NULL) {
        $expenseslists = array();
        if ($id != "") {
            $expenseslists = $this->expenses_model->otherexpenseslists($id);
            if (count($expenseslists) == 0) {
                redirect(base_url() . 'expenses', 'refresh');
            }
        }
        $type_list = $this->expenses_model->expensetypelists();
        $data = array('expenseslists' => $expenseslists, 'id' => $id, 'type_list' => $type_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('expenses/expensesadd', $data);
        $this->load->view('includes/footer');
    }

    public function ajaxsave($id = NULL) {


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
                    $saveexpenses = $this->expenses_model->updateexpenses($data, $id);
                } else {
                    $data['created_on'] = date('Y-m-d H:i:s');
                    $saveexpenses = $this->expenses_model->saveexpenses($data);
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

    public function delete($id = NULL) {
        if ($id != "") {
            $deleteExpenses = $this->expenses_model->deleteexpenses($id);
            if ($deleteExpenses == "1") {
                $this->session->set_flashdata('SucMessage', 'Expenses has been deleted successfully!!!');
            } else {
                $this->session->set_flashdata('ErrorMessages', 'Expenses has not been deleted successfully!!!');
            }
            redirect(base_url() . 'expenses', 'refresh');
        } else {
            redirect(base_url() . 'expenses', 'refresh');
        }
    }

}
