<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customerorders extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('products_model');
        $this->load->model('orders_model');
        $this->load->model('customer_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        }
    }

    public function index() {
        $orders_lists = $this->orders_model->customerorderlists();
        $data = array('orders_lists' => $orders_lists);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('customerorders/list', $data);
        $this->load->view('includes/footer');
    }

    public function add($id = NULL) {
        $order_list = array();
        $customer_list = $this->customer_model->lists();
        $products_list = $this->products_model->lists();
        if ($id != "") {
            $order_list = $this->orders_model->customerorderlists($id);

            if (count($order_list) == 0) {
                redirect(base_url() . 'customerorders', 'refresh');
            }
        }
        $data = array('products_list' => $products_list, 'id' => $id, 'order_list' => $order_list, 'customer_list' => $customer_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('customerorders/form', $data);
        $this->load->view('includes/footer');
    }

    //login
    public function ajaxsave($id = NULL) {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('order_person_id', 'Customer Name', 'trim|required');
            $this->form_validation->set_rules('orderdate', 'Order Date', 'trim|required');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|min_length[1]|max_length[10]');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|min_length[1]|max_length[10]');
            //$this->form_validation->set_rules('total_amount', 'Total Amount', 'trim|required|min_length[1]|max_length[10]');
            $this->form_validation->set_rules('paid_amount', 'Paid Amount', 'trim|required|min_length[1]|max_length[10]');
            //$this->form_validation->set_rules('product_id', 'Product Name', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {

                $orders_list = array();
                if ($id != "") {
                    $orders_list = $this->orders_model->customerorderlists($id);
                }

                $data = array('order_person_id' => trim($this->input->post('order_person_id')),
                    'order_type' => 'customer',
                    'product_id' => isset($orders_list[0]['product_id']) ? $orders_list[0]['product_id'] : $this->input->post('product_id'),
                    'orderdate' => trim($this->input->post('orderdate')),
                    'quantity' => trim($this->input->post('quantity')),
                    'price' => trim($this->input->post('price')),
                    'total_amount' => $this->input->post('price') * $this->input->post('quantity'),
                    'paid_amount' => trim($this->input->post('paid_amount')),
                    'balance_amount' => ($this->input->post('price') * $this->input->post('quantity')) - $this->input->post('paid_amount')
                );

                if ($id != "") {
                    $saveorder = $this->orders_model->update($data, $id);
                    $savemeasurement = $this->orders_model->updatemeasurementvalues($orders_list[0]['id']);
                } else {
                    $data['created_on'] = date('Y-m-d H:i:s');
                    $saveorder = $this->orders_model->save($data);
                }
                if ($saveorder == 1) {
                    $this->session->set_flashdata('SucMessage', 'Order Details Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Order Details Saved Not Successfully'));
                }
            }
        }
    }

    public function measurementdetails() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $result = $this->orders_model->measurementvalues();
            $html = "";
            if (count($result)) {
                $html .= '<div class="header">
                                    <h2>
                                        Measurement Detail                                                
                                    </h2>

                                </div>';
                foreach ($result as $key => $value) {
                    $html .= '<div class="col-md-3"><label for="email_address">' . $value['mname'] . '</label><div class="form-group">
                                    <div class="form-line">
                                        <input id="measurement_value' . $value['id'] . '" name="measurement_value[' . $value['id'] . ']" class="form-control" placeholder="value" type="text" value="' . $value['measurementvalue'] . '">
                                    </div>
                                </div></div>';
                }
            }
            echo $html;
        }
    }

    public function delete($id = NULL) {
        if ($id != "") {
            $deleteorder = $this->orders_model->update(array('dels' => 1), $id);
            if ($deleteorder == "1") {
                $this->session->set_flashdata('SucMessage', 'Order Details has been deleted successfully!!!');
            } else {
                $this->session->set_flashdata('ErrorMessages', 'Order Details has not been deleted successfully!!!');
            }
            redirect(base_url() . 'customerorders', 'refresh');
        } else {
            redirect(base_url() . 'customerorders', 'refresh');
        }
    }

    public function vieworders() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $html = "";
            $orders_list = $this->orders_model->customerorderlists($_POST['order_id']);
            if (count($orders_list)) {
                $html .= '<div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">' . $orders_list[0]['orderno'] . '</h4>
                </div><div class="modal-body">
                    <h4>Order Details</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-5"><label>Name</label></div><div class="col-md-1">:</div><div class="col-md-5">' . $orders_list[0]['name'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-5"><label>Mobile No</label></div><div class="col-md-1">:</div><div class="col-md-5">' . $orders_list[0]['mobileno'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-5"><label>Price</label></div><div class="col-md-1">:</div><div class="col-md-5">' . $orders_list[0]['price'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-5"><label>Quantity</label></div><div class="col-md-1">:</div><div class="col-md-5">' . $orders_list[0]['quantity'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-5"><label>Total Amount</label></div><div class="col-md-1">:</div><div class="col-md-5">' . $orders_list[0]['total_amount'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-5"><label>Paid Amount</label></div><div class="col-md-1">:</div><div class="col-md-5">' . $orders_list[0]['paid_amount'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-5"><label>Balnce Amount</label></div><div class="col-md-1">:</div><div class="col-md-5">' . $orders_list[0]['balance_amount'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-5"><label>Order Date</label></div><div class="col-md-1">:</div><div class="col-md-5">' . $orders_list[0]['orderdate'] . '</div>
                        </div>
                    </div>';

                $result = $this->orders_model->measurementvalues();
                if (count($result)) {
                    $html .= '<h4>Measurement Details</h4><div class="row">';
                    foreach ($result as $key => $value) {
                        $html .= '<div class="col-md-6"><div class="col-md-5"><label for="email_address">' . $value['mname'] . '</label></div><div class="col-md-1">:</div><div class="col-md-5">' . $value['measurementvalue'] . '</div></div>';
                    }
                }
            }
            echo $html;
        }
    }

}
