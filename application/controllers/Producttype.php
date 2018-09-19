<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Producttype extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('products_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        } else if ($this->session->userdata('role') == 2) {
            redirect(base_url() . 'customer/', 'refresh');
        }
    }

    public function index() {
        $products_lists = $this->products_model->typelists();
        $data = array('products_lists' => $products_lists);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('products/typelist', $data);
        $this->load->view('includes/footer');
    }

    public function add($id = NULL) {
        $products_list = $this->products_model->outsorcinglists();
        $producttype_list = array();
        $measurements_list = array();
        if ($id != "") {
            $producttype_list = $this->products_model->typelists($id);
            //echo "<pre>".print_r($producttype_list);die;    
            if (count($producttype_list) == 0) {
                redirect(base_url() . 'producttype', 'refresh');
            }
        }
        $data = array('products_list' => $products_list, 'producttype_list'=>$producttype_list,'id' => $id);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('products/typeform', $data);
        $this->load->view('includes/footer');
    }

    //login
    public function ajaxsave($id = NULL) {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('typename', 'Product Type Name', 'trim|required|min_length[3]|max_length[150]');
            $this->form_validation->set_rules('product_id', 'Product', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('typename' => trim($this->input->post('typename')),
                    'product_id' => trim($this->input->post('product_id'))
                );
                $products_list = array();
                if ($id != "") {
                    $products_list = $this->products_model->typelists($id);
                }
                if (isset($_FILES['typeimage']['name']) && (!empty($_FILES['typeimage']['name']))) {
                    $upload_image = $this->do_upload_image('typeimage');
                    if ($upload_image['image_message'] == "success") {

                        //Remove product Image
                        if (isset($products_list[0]['typeimage']) && !empty($products_list[0]['typeimage'])) {
                            $image_file = './upload/producttype/' . $products_list[0]['typeimage'];
                            if (file_exists($image_file)) {
                                unlink($image_file);
                            }
                        }

                        $data['typeimage'] = trim($upload_image['image_file_name']);
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => "<p>Please upload only image</p>"));
                        return false;
                    }
                }

                if ($id != "") {                    
                    $saveproduct = $this->products_model->updatetype($data, $id);                    
                } else {
                    
                    $saveproduct = $this->products_model->savetype($data);
                }
                if ($saveproduct == 1) {
                    $this->session->set_flashdata('SucMessage', 'Product Type Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Product Type Saved Not Successfully'));
                }
            }
        }
    }

    public function exist_product_check() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $check_exist = $this->products_model->check_exist_product(trim($this->input->post('productname')), trim($this->input->post('id')));
            if (count($check_exist)) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    public function delete($id = NULL) {
        if ($id != "") {
            $deleteproduct = $this->products_model->updatetype(array('dels' => 1), $id);
            if ($deleteproduct == "1") {
                $this->session->set_flashdata('SucMessage', 'Product type has been deleted successfully!!!');
            } else {
                $this->session->set_flashdata('ErrorMessages', 'Product type has not been deleted successfully!!!');
            }
            redirect(base_url() . 'producttype', 'refresh');
        } else {
            redirect(base_url() . 'producttype', 'refresh');
        }
    }
    
    function do_upload_image($field_name) {
        $msg = array();
        $file_name = "";
        $message = "";
        $image_new_name = time() . "-" . $field_name;
        $config['upload_path'] = './upload/producttype/';
        $config['upload_url'] = base_url() . "upload/producttype/";
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

}
