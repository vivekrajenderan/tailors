<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('company_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        }
    }

    public function index() {
        $company_lists = $this->company_model->lists();
        $data = array('company_lists' => $company_lists);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('company/list', $data);
        $this->load->view('includes/footer');
    }

    public function add($id = NULL) {
        $company_list = array();
        if ($id != "") {
            $company_list = $this->company_model->lists($id);
            if (count($company_list) == 0) {
                redirect(base_url() . 'company', 'refresh');
            }
        }
        $data = array('company_list' => $company_list, 'id' => $id);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('company/form', $data);
        $this->load->view('includes/footer');
    }

    //login
    public function ajaxsave($id = NULL) {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('name', 'Company Name', 'trim|required|min_length[3]|max_length[150]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('mobileno', 'Mobile Number', 'trim|required|min_length[9]|max_length[10]');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('name' => trim($this->input->post('name')),
                    'email' => trim($this->input->post('email')),
                    'address' => trim($this->input->post('address')),
                    'mobileno' => trim($this->input->post('mobileno'))
                );
                if ($id != "") {
                    $data['updated_on'] = date('Y-m-d H:i:s');
                    $savecompany = $this->company_model->update($data, $id);
                } else {
                    $data['created_on'] = date('Y-m-d H:i:s');
                    $savecompany = $this->company_model->save($data);
                }
                if ($savecompany == 1) {
                    $this->session->set_flashdata('SucMessage', 'Company Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Company Saved Not Successfully'));
                }
            }
        }
    }

    public function exist_company_check() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $check_exist = $this->company_model->check_exist_company(trim($this->input->post('company_name')), trim($this->input->post('id')));
            if (count($check_exist)) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    public function delete($id = NULL) {
        if ($id != "") {
            $deleteCompany = $this->company_model->update(array('dels' => 1), $id);
            if ($deleteCompany == "1") {
                $this->session->set_flashdata('SucMessage', 'Company has been deleted successfully!!!');
            } else {
                $this->session->set_flashdata('ErrorMessages', 'Company has not been deleted successfully!!!');
            }
            redirect(base_url() . 'company', 'refresh');
        } else {
            redirect(base_url() . 'company', 'refresh');
        }
    }

    public function change_company_active() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $data = array('status' => trim($this->input->post('status'))
            );
            $id = trim($this->input->post('id'));
            $update_company = $this->company_model->update($data, $id);
            $standing = ($this->input->post('standing') == 1 ? 'Active' : 'Inactive');
            if ($update_company == 1) {
                echo json_encode(array('status' => 1, 'msg' => "Company $standing Successfully"));
            } else {
                echo json_encode(array('status' => 0, 'msg' => "Company $standing Not Successfully"));
            }
        }
    }

}
