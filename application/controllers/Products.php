<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('products_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        }
    }

    public function index() {
        $products_lists = $this->products_model->lists();
        $data = array('products_lists' => $products_lists);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('products/list', $data);
        $this->load->view('includes/footer');
    }

    public function add($id = NULL) {
        $products_list = array();
        if ($id != "") {
            $products_list = $this->products_model->lists($id);
            if (count($products_list) == 0) {
                redirect(base_url() . 'products', 'refresh');
            }
        }
        $data = array('products_list' => $products_list, 'id' => $id);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('products/form', $data);
        $this->load->view('includes/footer');
    }

    //login
    public function ajaxsave($id = NULL) {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('productname', 'Product Name', 'trim|required|min_length[3]|max_length[150]');
            $this->form_validation->set_rules('price', 'Price', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {

                $data = array('productname' => trim($this->input->post('productname')),
                    'price' => trim($this->input->post('price'))
                );
                if (isset($_FILES['product_image']['name']) && (!empty($_FILES['product_image']['name']))) {
                    $upload_image = $this->do_upload_image('product_image');
                    if ($upload_image['image_message'] == "success") {
                        if ($id != "") {
                            $products_list = $this->products_model->lists($id);
                            if (isset($products_list[0]['product_image']) && !empty($products_list[0]['product_image'])) {
                                $image_file = './upload/products/' . $products_list[0]['product_image'];
                                if (file_exists($image_file)) {
                                    unlink($image_file);
                                }
                            }
                        }

                        $data['product_image'] = trim($upload_image['image_file_name']);
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => "<p>Please upload only image</p>"));
                        return false;
                    }
                } 

                if ($id != "") {
                    $data['updated_on'] = date('Y-m-d H:i:s');
                    $saveproduct = $this->products_model->update($data, $id);
                } else {
                    $data['created_on'] = date('Y-m-d H:i:s');
                    $saveproduct = $this->products_model->save($data);
                }
                if ($saveproduct == 1) {
                    $this->session->set_flashdata('SucMessage', 'Product Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Product Saved Not Successfully'));
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
            $deleteproduct = $this->products_model->update(array('dels' => 1), $id);
            if ($deleteproduct == "1") {
                $this->session->set_flashdata('SucMessage', 'Product has been deleted successfully!!!');
            } else {
                $this->session->set_flashdata('ErrorMessages', 'Product has not been deleted successfully!!!');
            }
            redirect(base_url() . 'products', 'refresh');
        } else {
            redirect(base_url() . 'products', 'refresh');
        }
    }

    public function change_product_active() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $data = array('status' => trim($this->input->post('status'))
            );
            $id = trim($this->input->post('id'));
            $update_product = $this->products_model->update($data, $id);
            $standing = ($this->input->post('status') == 1 ? 'Active' : 'Inactive');
            if ($update_product == 1) {
                echo json_encode(array('status' => 1, 'msg' => "Product $standing Successfully"));
            } else {
                echo json_encode(array('status' => 0, 'msg' => "Product $standing Not Successfully"));
            }
        }
    }

    function do_upload_image($field_name) {
        $msg = array();
        $file_name = "";
        $message = "";
        $image_new_name = time() . "-" . $field_name;
        $config['upload_path'] = './upload/products/';
        $config['upload_url'] = base_url() . "upload/products/";
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
