<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . '/controllers/common.php';

class Users extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('users_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        }
    }

    public function index() {
        if ($this->session->userdata('role') == 2) {
            redirect(base_url() . 'company/', 'refresh');
        }
        $users_lists = $this->users_model->lists();
        $data = array('users_lists' => $users_lists);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('users/list', $data);
        $this->load->view('includes/footer');
    }

    public function add($id = NULL) {
        if ($this->session->userdata('role') == 2) {
            redirect(base_url() . 'company/', 'refresh');
        }
        $users_list = array();
        if ($id != "") {
            $users_list = $this->users_model->lists($id);
            if (count($users_list) == 0) {
                redirect(base_url() . 'users', 'refresh');
            }
        }
        $data = array('users_list' => $users_list, 'id' => $id);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('users/form', $data);
        $this->load->view('includes/footer');
    }

    //login
    public function ajaxsave($id = NULL) {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[3]|max_length[150]');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[3]|max_length[150]');
            $this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[3]|max_length[150]');
            $this->form_validation->set_rules('gender', 'Email', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('mobileno', 'Mobile Number', 'trim|required|min_length[9]|max_length[10]');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('firstname' => trim($this->input->post('firstname')),
                    'lastname' => trim($this->input->post('lastname')),
                    'gender' => trim($this->input->post('gender')),
                    'username' => trim($this->input->post('username')),
                    'address' => trim($this->input->post('address')),
                    'mobileno' => trim($this->input->post('mobileno')),
                    'role' => 2
                );
                if ($id != "") {
                    $users_list = $this->users_model->lists($id);
                }
                if (isset($_FILES['userimage']['name']) && (!empty($_FILES['userimage']['name']))) {
                    $upload_image = $this->do_upload_image('userimage');
                    if ($upload_image['image_message'] == "success") {

                        //Remove product Image
                        if (isset($users_list[0]['userimage']) && !empty($users_list[0]['userimage'])) {
                            $image_file = './upload/users/' . $users_list[0]['userimage'];
                            if (file_exists($image_file)) {
                                unlink($image_file);
                            }
                        }

                        $data['userimage'] = trim($upload_image['image_file_name']);
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => "<p>Please upload only image</p>"));
                        return false;
                    }
                }

                if ($id != "") {
                    $data['updated_on'] = date('Y-m-d H:i:s');
                    $saveusers = $this->users_model->update($data, $id);
                } else {
                    $data['created_on'] = date('Y-m-d H:i:s');
                    $data['password'] = AES_Encode(trim($this->input->post('mobileno')));
                    $saveusers = $this->users_model->save($data);
                }
                if ($saveusers == 1) {
                    $this->session->set_flashdata('SucMessage', 'Staff Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Staff Saved Not Successfully'));
                }
            }
        }
    }

    public function exist_users_check() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $check_exist = $this->users_model->check_exist_users(trim($this->input->post('username')), trim($this->input->post('id')));
            if (count($check_exist)) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    public function delete($id = NULL) {
        if ($id != "") {
            $deleteUsers = $this->users_model->update(array('dels' => 1), $id);
            if ($deleteUsers == "1") {
                $this->session->set_flashdata('SucMessage', 'Staff has been deleted successfully!!!');
            } else {
                $this->session->set_flashdata('ErrorMessages', 'Staff has not been deleted successfully!!!');
            }
            redirect(base_url() . 'users', 'refresh');
        } else {
            redirect(base_url() . 'users', 'refresh');
        }
    }

    function do_upload_image($field_name) {
        $msg = array();
        $file_name = "";
        $message = "";
        $image_new_name = time() . "-" . $field_name;
        $config['upload_path'] = './upload/users/';
        $config['upload_url'] = base_url() . "upload/users/";
        $config['allowed_types'] = "gif|jpg|png|jpeg";
        $config['file_name'] = $image_new_name;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field_name)) {
            $error = array('error' => $this->upload->display_errors());
            $message = $error['error'];
        } else {
            $data = array('upload_data' => $this->upload->data());
            $file_name = $data['upload_data']['orig_name'];
            $message = "success";
        }
        $msg = array("image_message" => $message, "image_file_name" => $file_name);
        return $msg;
    }

    public function staffbalance() {
        $balance_lists = $this->users_model->balancelists();
        $data = array('balance_lists' => $balance_lists);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('users/balancelist', $data);
        $this->load->view('includes/footer');
    }

    public function staffbalanceadd($id = NULL) {
        $balance_list = array();
        if ($id != "") {
            $balance_list = $this->users_model->balancelists($id);
            if (count($balance_list) == 0) {
                redirect(base_url() . 'users/staffbalance', 'refresh');
            }
        }
        $users_list = $this->users_model->lists();
        //echo "<pre>".print_r($balance_list);die;
        $data = array('balance_list' => $balance_list, 'id' => $id, 'users_list' => $users_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('users/balance', $data);
        $this->load->view('includes/footer');
    }

    public function ajaxbalancesave($id = NULL) {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[2]|max_length[10]');
            $this->form_validation->set_rules('user_id', 'Staff', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('amount' => trim($this->input->post('amount')),
                    'user_id' => trim($this->input->post('user_id')),
                    'buydate' => trim($this->input->post('buydate'))
                );
                if ($id != "") {
                    $data['updated_on'] = date('Y-m-d H:i:s');
                    $saveproduct = $this->users_model->updatebalance($data, $id);
                } else {
                    $data['created_on'] = date('Y-m-d H:i:s');
                    $saveproduct = $this->users_model->savebalance($data);
                }
                if ($saveproduct == 1) {
                    $this->session->set_flashdata('SucMessage', 'Staff Balance Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Staff Balance Saved Not Successfully'));
                }
            }
        }
    }

    public function staffbalancedelete($id = NULL) {
        if ($id != "") {
            $deleteUsers = $this->users_model->updatebalance(array('dels' => 1), $id);
            if ($deleteUsers == "1") {
                $this->session->set_flashdata('SucMessage', 'Staff Balance has been deleted successfully!!!');
            } else {
                $this->session->set_flashdata('ErrorMessages', 'Staff Balance has not been deleted successfully!!!');
            }
            redirect(base_url() . 'users/staffbalance', 'refresh');
        } else {
            redirect(base_url() . 'users/staffbalance', 'refresh');
        }
    }

    public function profile($id = NULL) {
        $users_list = array();
        if ($this->session->userdata('id')) {
            $users_list = $this->users_model->lists(md5($this->session->userdata('id')));
            if (count($users_list) == 0) {
                redirect(base_url() . 'companyorders', 'refresh');
            }
        }
        $data = array('users_list' => $users_list, 'id' => $id);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('users/profile', $data);
        $this->load->view('includes/footer');
    }

    public function ajaxsaveprofile() {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[3]|max_length[150]');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[3]|max_length[150]');
            $this->form_validation->set_rules('gender', 'Email', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]|max_length[250]');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('firstname' => trim($this->input->post('firstname')),
                    'lastname' => trim($this->input->post('lastname')),
                    'gender' => trim($this->input->post('gender')),
                    'address' => trim($this->input->post('address'))
                );
                if ($this->session->userdata('id')) {
                    $users_list = $this->users_model->lists(md5($this->session->userdata('id')));
                }
                if (isset($_FILES['userimage']['name']) && (!empty($_FILES['userimage']['name']))) {
                    $upload_image = $this->do_upload_image('userimage');
                    if ($upload_image['image_message'] == "success") {

                        //Remove product Image
                        if (isset($users_list[0]['userimage']) && !empty($users_list[0]['userimage'])) {
                            $image_file = './upload/users/' . $users_list[0]['userimage'];
                            if (file_exists($image_file)) {
                                unlink($image_file);
                            }
                        }

                        $data['userimage'] = trim($upload_image['image_file_name']);
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => "<p>Please upload only image</p>"));
                        return false;
                    }
                }

                if ($this->session->userdata('id')) {
                    $data['updated_on'] = date('Y-m-d H:i:s');
                    $saveusers = $this->users_model->update($data, md5($this->session->userdata('id')));
                }
                if ($saveusers == 1) {
                    $this->session->set_userdata('firstname', $this->input->post('firstname'));
                    $this->session->set_userdata('lastname', $this->input->post('lastname'));                    
                    $this->session->set_flashdata('SucMessage', 'Profile Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Profile Saved Not Successfully'));
                }
            }
        }
    }

}
