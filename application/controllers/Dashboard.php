<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {

        parent::__construct();
        //$this->load->model('common_model', 'common');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        }
    }

    public function index() {
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('dashboard');
        $this->load->view('includes/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
