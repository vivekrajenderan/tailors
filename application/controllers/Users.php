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
            redirect(base_url() . 'customer/', 'refresh');
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
            redirect(base_url() . 'customer/', 'refresh');
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

    public function staffsalary() {
        if (!isset($_POST['fromdate']) && empty($_POST['fromdate']) && !isset($_POST['todate']) && empty($_POST['todate'])) {
            $_POST['fromdate'] = date('Y-m-d');
            $_POST['todate'] = date('Y-m-d');
        }
        $balance_lists = $this->users_model->salarylists();
        $list = $this->users_model->lists();
        $user_list = array();
        foreach ($list as $key => $value) {
            $user_list[] = array('id' => $value['id'], 'name' => $value['firstname'] . '' . $value['lastname']);
        }
        $data = array('balance_lists' => $balance_lists, 'user_list' => $user_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('users/salarylist', $data);
        $this->load->view('includes/footer');
    }

    public function staffsalaryadd($id = NULL) {
        $balance_list = array();
        if ($id != "") {
            $balance_list = $this->users_model->salarylists($id);
            if (count($balance_list) == 0) {
                redirect(base_url() . 'users/staffbalance', 'refresh');
            }
        }
        $users_list = $this->users_model->lists();
        $product_list = $this->users_model->salaryproductvalues($id);
        $data = array('balance_list' => $balance_list, 'id' => $id, 'users_list' => $users_list, 'product_list' => $product_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('users/salary', $data);
        $this->load->view('includes/footer');
    }

    public function ajaxsalarysave($id = NULL) {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('debitamount', 'Debit Amount', 'trim|required|min_length[1]|max_length[10]');
            $this->form_validation->set_rules('user_id', 'Staff', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('debitamount' => trim($this->input->post('debitamount')),
                    'user_id' => trim($this->input->post('user_id'))
                );
                if ($id != "") {
                    $data['updated_on'] = date('Y-m-d H:i:s');
                    $saveproduct = $this->users_model->updatesallary($data, $id);
                    $salaryid = $this->input->post('sallary_id');
                    $this->savesalaryproducts($salaryid);
                } else {
                    $data['created_on'] = date('Y-m-d H:i:s');
                    $saveproduct = $this->users_model->savesallary($data);
                    $this->savesalaryproducts($saveproduct);
                }
                if ($saveproduct) {
                    $this->session->set_flashdata('SucMessage', 'Staff Sallary Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Staff Sallary Saved Not Successfully'));
                }
            }
        }
    }

    public function savesalaryproducts($salaryid) {
        if (isset($_POST['producttype']) && !empty($_POST['producttype'])) {
            $totalbalance = 0;
            $this->users_model->deletesallaryproductdetails(md5($salaryid));
            foreach ($_POST['producttype'] as $key => $list) {
                $quantity = $price = 0;
                if (isset($_POST['quantity'][$key]) && !empty($_POST['quantity'][$key])) {
                    $quantity = $_POST['quantity'][$key];
                }
                if (isset($_POST['price'][$key]) && !empty($_POST['price'][$key])) {
                    $price = $_POST['price'][$key];
                }
                if (!empty($quantity) && !empty($price)) {
                    $set_data = array('quantity' => $quantity, 'price' => $price, 'salary_id' => $salaryid, 'product_id' => $key);
                    $totalbalance += ($quantity * $price);
                    $this->users_model->savesallaryproductdetails($set_data);
                }
            }
            $debitamount = (isset($_POST['debitamount']) && !empty($_POST['debitamount'])) ? $_POST['debitamount'] : 0;
            $totalbalance = ($totalbalance - $debitamount);

            $this->users_model->updatesallary(array('balanceamount' => $totalbalance, 'debitamount' => $debitamount), md5($salaryid));
        }
    }

    public function staffsalarydelete($id = NULL) {
        if ($id != "") {
            $deleteUsers = $this->users_model->updatesallary(array('dels' => 1), $id);
            $this->users_model->deletesallaryproductdetails($id);
            if ($deleteUsers == "1") {
                $this->session->set_flashdata('SucMessage', 'Staff Salary has been deleted successfully!!!');
            } else {
                $this->session->set_flashdata('ErrorMessages', 'Staff Salary has not been deleted successfully!!!');
            }
            redirect(base_url() . 'users/staffsalary', 'refresh');
        } else {
            redirect(base_url() . 'users/staffsalary', 'refresh');
        }
    }

    public function profile() {
        $users_list = array();
        if ($this->session->userdata('id')) {
            $users_list = $this->users_model->lists(md5($this->session->userdata('id')));
            if (count($users_list) == 0) {
                redirect(base_url() . 'companyorders', 'refresh');
            }
        }
        $data = array('users_list' => $users_list);
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
                    if (isset($data['userimage']) && !empty($data['userimage'])) {
                        $this->session->set_userdata('userimage', $data['userimage']);
                    }
                    $this->session->set_flashdata('SucMessage', 'Profile Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Profile Saved Not Successfully'));
                }
            }
        }
    }

    public function changepassword() {
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('users/changepassword');
        $this->load->view('includes/footer');
    }

    public function ajaxchangepassword() {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|min_length[3]|max_length[150]');
            $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|min_length[3]|max_length[150]');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('password' => AES_Encode(trim($this->input->post('newpassword'))));
                if ($this->session->userdata('id')) {
                    $data['updated_on'] = date('Y-m-d H:i:s');
                    $saveusers = $this->users_model->update($data, md5($this->session->userdata('id')));
                }
                if ($saveusers == 1) {
                    $this->session->set_flashdata('SucMessage', 'New Password has been updated Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'New Password has not been updated Successfully'));
                }
            }
        }
    }

    public function viewsalary($userid) {
        if ($userid != "") {
            $balance_lists = $this->users_model->viewsalarylists($userid);            
            $data = array('balance_lists' => $balance_lists, 'userid'=>$userid);
            $this->load->view('includes/header');
            $this->load->view('includes/sidebar');
            $this->load->view('users/viewsalary', $data);
            $this->load->view('includes/footer');
        } else {
            redirect(base_url() . 'users', 'refresh');
        }
    }
    
    public function staffsalarypaid($userid) {
        if ($userid != "") {
            $this->users_model->updateusersallary(array('status' => 1), $userid);
            $this->session->set_flashdata('SucMessage', 'Salary has been paid Successfully');
            redirect(base_url() . 'users', 'refresh');
        } else {
            redirect(base_url() . 'users', 'refresh');
        }
    }

}
