<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('customer_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        }
    }

    public function index() {
        $customer_lists = $this->customer_model->lists();
        $data = array('customer_lists' => $customer_lists);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('customer/list', $data);
        $this->load->view('includes/footer');
    }

    public function add($id = NULL) {
        $customer_list = array();
        if ($id != "") {
            $customer_list = $this->customer_model->lists($id);
            if (count($customer_list) == 0) {
                redirect(base_url() . 'customer', 'refresh');
            }
        }
        $data = array('customer_list' => $customer_list, 'id' => $id);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('customer/form', $data);
        $this->load->view('includes/footer');
    }

    //login
    public function ajaxsave($id = NULL) {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('name', 'Customer Name', 'trim|required|min_length[3]|max_length[150]');            
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('mobileno', 'Mobile Number', 'trim|required|min_length[9]|max_length[10]');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('name' => trim($this->input->post('name')),                    
                    'address' => trim($this->input->post('address')),
                    'mobileno' => trim($this->input->post('mobileno'))
                );
                if ($id != "") {
                    $data['updated_on'] = date('Y-m-d H:i:s');
                    $savecustomer = $this->customer_model->update($data, $id);
                } else {
                    $data['created_on'] = date('Y-m-d H:i:s');
                    $data['updated_on'] = date('Y-m-d H:i:s');
                    $savecustomer = $this->customer_model->save($data);
                }
                if ($savecustomer == 1) {
                    $this->session->set_flashdata('SucMessage', 'Customer Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Customer Saved Not Successfully'));
                }
            }
        }
    }

    public function exist_customer_check() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $check_exist = $this->customer_model->check_exist_customer(trim($this->input->post('mobileno')), trim($this->input->post('id')));
            if (count($check_exist)) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    public function delete($id = NULL) {
        if ($id != "") {
            $deleteCustomer = $this->customer_model->update(array('dels' => 1), $id);
            if ($deleteCustomer == "1") {
                $this->session->set_flashdata('SucMessage', 'Customer has been deleted successfully!!!');
            } else {
                $this->session->set_flashdata('ErrorMessages', 'Customer has not been deleted successfully!!!');
            }
            redirect(base_url() . 'customer', 'refresh');
        } else {
            redirect(base_url() . 'customer', 'refresh');
        }
    }

    public function change_customer_active() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $data = array('status' => trim($this->input->post('status'))
            );
            $id = trim($this->input->post('id'));
            $update_customer = $this->customer_model->update($data, $id);
            $standing = ($this->input->post('standing') == 1 ? 'Active' : 'Inactive');
            if ($update_customer == 1) {
                echo json_encode(array('status' => 1, 'msg' => "Customer $standing Successfully"));
            } else {
                echo json_encode(array('status' => 0, 'msg' => "Customer $standing Not Successfully"));
            }
        }
    }

}
