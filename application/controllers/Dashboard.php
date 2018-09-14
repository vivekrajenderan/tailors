<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {

        parent::__construct();
        //$this->load->model('common_model', 'common');
        $this->load->model('company_model');
        $this->load->model('customer_model');
        $this->load->model('users_model');
        $this->load->model('products_model');
        $this->load->model('orders_model');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        } else if ($this->session->userdata('role') == 2) {
            redirect(base_url() . 'customer/', 'refresh');
        }
    }

    public function index() {

        $company_lists = $this->company_model->lists();
        $customer_lists = $this->customer_model->lists();
        $users_lists = $this->users_model->lists();
        $products_lists = $this->products_model->lists();
        $todayorder = $this->orders_model->ordercount('today');
        $yesterdayorder = $this->orders_model->ordercount('yesterday');
        $lastweekorder = $this->orders_model->ordercount('lastweek');
        $todaycompanyorder = $this->orders_model->companyorderlists('',array('created_on'=>date('Y-m-d')));
        $todaycustomerorder = $this->orders_model->customerorderlists('',array('created_on'=>date('Y-m-d')));        
        $data = array('totalcompany' => count($company_lists),
            'totalcustomer' => count($customer_lists),
            'totauser' => count($users_lists),
            'totalproduct' => count($products_lists),
            'todayorder' => $todayorder,
            'yesterdayorder' => $yesterdayorder,
            'lastweekorder' => $lastweekorder,
            'companyorder' => $todaycompanyorder,
            'customerorder' => $todaycustomerorder,
        );        
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('dashboard',$data);
        $this->load->view('includes/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
