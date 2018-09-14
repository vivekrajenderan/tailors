<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '/controllers/common.php';

class Login extends CI_Controller {

    public function __construct() {

        parent::__construct();
        // Loading report_model 
        $this->load->model('login_model', 'login');
        if ($this->session->userdata('logged_in') == TRUE) {
            redirect(base_url() . 'dashboard', 'refresh');
        }
    }

    public function index() {
        $this->load->view('login');
    }

    public function ajax_check() {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $row = $this->login->login_verify(trim($this->input->post('username')), trim($this->input->post('password')));
                if (count($row) == 1) {
                    $session_data = array(
                        'id' => $row[0]['id'],
                        'email' => $row[0]['email'],
                        'username' => $row[0]['username'],
                        'firstname' => $row[0]['firstname'],
                        'lastname' => $row[0]['lastname'],
                        'mobileno' => $row[0]['mobileno'],
                        'userimage' => $row[0]['userimage'],
                        'role' => $row[0]['role'],
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($session_data);
                    echo json_encode(array('status' => 1, 'msg' => 'Loggin Successfully'));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Invalid Credential'));
                }
            }
        }
    }

}
