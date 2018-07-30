<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('products_model');
        $this->load->model('orders_model');
        $this->load->model('company_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        }
    }

    public function company() {
        $orders_lists = $this->orders_model->companyreport();
        $data = array('orders_lists' => $orders_lists);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('reports/company', $data);
        $this->load->view('includes/footer');
    }

    public function customer() {
        $orders_lists = $this->orders_model->customerreport();
        $data = array('orders_lists' => $orders_lists);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('reports/company', $data);
        $this->load->view('includes/footer');
    }

}
