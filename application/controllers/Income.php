<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Income extends CI_Controller {

    public function __construct() {

        parent::__construct();
        
        $this->load->model('income_model');        
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        }
    }  

    public function index() {        
        $expenseslists = $this->income_model->incomelists();
        $type_list = $this->income_model->accountlists();
        $data = array('expenseslists' => $expenseslists, 'type_list' => $type_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('income/income', $data);
        $this->load->view('includes/footer');
    }

    public function add($id = NULL) {
        $expenseslists = array();
        if ($id != "") {
            $expenseslists = $this->income_model->incomelists($id);
            if (count($expenseslists) == 0) {
                redirect(base_url() . 'income', 'refresh');
            }
        }
        $type_list = $this->income_model->accountlists();
        $data = array('expenseslists' => $expenseslists, 'id' => $id, 'type_list' => $type_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('income/incomeadd', $data);
        $this->load->view('includes/footer');
    }

    public function ajaxsave($id = NULL) {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[2]|max_length[10]');
            $this->form_validation->set_rules('reference_id', 'Income Type', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $type_list = $this->income_model->accountlists($this->input->post('reference_id'));
                $account_type=isset($type_list[0]['name'])?$type_list[0]['name']:"";
                $data = array('amount' => trim($this->input->post('amount')),
                    'reference_id' => trim($this->input->post('reference_id')),
                    'account_type' => $account_type,
                    'transtype' => 'income'
                );
                if ($id != "") {
                    $data['updated_on'] = date('Y-m-d H:i:s');
                    $saveexpenses = $this->income_model->updateincome($data, $id);
                } else {
                    $data['created_on'] = date('Y-m-d H:i:s');
                    $saveexpenses = $this->income_model->saveincome($data);
                }
                if ($saveexpenses == 1) {
                    $this->session->set_flashdata('SucMessage', 'Income Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Income Saved Not Successfully'));
                }
            }
        }
    }

    public function delete($id = NULL) {
        if ($id != "") {
            $deleteExpenses = $this->income_model->deleteincome($id);
            if ($deleteExpenses == "1") {
                $this->session->set_flashdata('SucMessage', 'Income has been deleted successfully!!!');
            } else {
                $this->session->set_flashdata('ErrorMessages', 'Income has not been deleted successfully!!!');
            }
            redirect(base_url() . 'income', 'refresh');
        } else {
            redirect(base_url() . 'income', 'refresh');
        }
    }

    public function cashonhand() {        
        if (!isset($_POST['fromdate']) && empty($_POST['fromdate']) && !isset($_POST['todate']) && empty($_POST['todate'])) {
            $_POST['fromdate']= date('Y-m-d');
            $_POST['todate']= date('Y-m-d');
        } 
        $cashlist = $this->income_model->cashlist();  
        $data = array('cashlist' => $cashlist);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('income/cashonhand', $data);
        $this->load->view('includes/footer');
    }
}
