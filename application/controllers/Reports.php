<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('products_model');
        $this->load->model('orders_model');
        $this->load->model('company_model');
        $this->load->model('customer_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        } else if ($this->session->userdata('role') == 2) {
            redirect(base_url() . 'company/', 'refresh');
        }
    }

    public function company() {
        //echo "<pre>".print_r($_POST);die;
        $orders_lists = $this->orders_model->companyreport();
        $list= $this->company_model->lists();
        $company_list=array();
        foreach($list as $key=>$value)
        {
            $company_list[]=array('id'=>$value['id'],'name'=>$value['name']);
        }
        $data = array('orders_lists' => $orders_lists,'company_list'=>$company_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('reports/company', $data);
        $this->load->view('includes/footer');
    }

    public function customer() {
        $orders_lists = $this->orders_model->customerreport();
        //echo "<pre>".print_r($_POST);die;
        $data = array('orders_lists' => $orders_lists);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('reports/customer', $data);
        $this->load->view('includes/footer');
    }
    
    public function getcustomer()
    {
        $list= $this->customer_model->getajaxlists();
        $customer_list=array();
        foreach($list as $key=>$value)
        {
            $customer_list[]=array('id'=>$value['id'],'name'=>$value['name']." ".$value['mobileno']);
        }
        echo json_encode($customer_list);
    }

}
