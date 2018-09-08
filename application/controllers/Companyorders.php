<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Companyorders extends CI_Controller {

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

    public function index() {
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('companyorders/list');
        $this->load->view('includes/footer');
    }

    public function ajaxorders() {

        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
        $end = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;

        $ordercolumn = array('0' => 'orderdetails.orderno', '1' => 'company.name', '2' => 'orderdetails.price', '3' => 'orderdetails.quantity', '4' => 'orderdetails.total_amount', '5' => 'orderdetails.orderdate', '6' => 'orderdetails.orderstatus');
        $pagecolumn = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
        $pageorder = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'desc';
        $searchvalue = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : "";
        $sortingcolumn = 'orderdetails.id';
        if (isset($ordercolumn[$pagecolumn])) {
            $sortingcolumn = $ordercolumn[$pagecolumn];
            if ($sortingcolumn == 'orderdetails.orderno') {
                $sortingcolumn = 'orderdetails.id';
            }
        }
        $data = array('sortingcolumn' => $sortingcolumn, 'orderby' => $pageorder, 'searchString' => $searchvalue, 'start' => $start, 'end' => $end);
        $orders_lists = $this->orders_model->ajaxcompanyorderlists($data);
        $orders_count = $this->orders_model->ajaxcompanyordercount($data);

        $pcount = 0;
        if (isset($orders_count[0]['totalcount']) && !empty($orders_count[0]['totalcount']))
            $pcount = ($orders_count[0]['totalcount']);
        $dataR = array(
            'data' => array(),
            "draw" => isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 1,
            "recordsTotal" => $pcount,
            "recordsFiltered" => $pcount,
        );
        foreach ($orders_lists as $key => $value) {
            $tempD = array();
            // Row based column PUSH
            $tempD[] = $value['orderno'];
            $tempD[] = $value['name'];
            $tempD[] = $value['price'];
            $tempD[] = $value['quantity'];
            $tempD[] = $value['total_amount'];
            $tempD[] = $value['orderdate'];
//            $tempD[] = $value['deliverydate'];
            $tempD[] = ucfirst($value['orderstatus']);
            $tempD[] = $value['id'];
            $tempD["DT_RowId"] = md5($value['id']);
            // Row  PUSH
            $dataR['data'][] = $tempD;
        }
        echo json_encode($dataR);
        exit();
    }

    public function add($id = NULL) {
        $order_list = array();
        $company_list = $this->company_model->lists();
        $products_list = $this->products_model->lists();
        if ($id != "") {
            $order_list = $this->orders_model->companyorderlists($id);

            if (count($order_list) == 0) {
                redirect(base_url() . 'companyorders', 'refresh');
            }
        }
        $data = array('products_list' => $products_list, 'id' => $id, 'order_list' => $order_list, 'company_list' => $company_list);
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('companyorders/form', $data);
        $this->load->view('includes/footer');
    }

    //login
    public function ajaxsave($id = NULL) {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('order_person_id', 'Company Name', 'trim|required');
            $this->form_validation->set_rules('orderdate', 'Order Date', 'trim|required');
            $this->form_validation->set_rules('deliverydate', 'Delivery Date', 'trim|required');
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
                    $orders_list = $this->orders_model->companyorderlists($id);
                }

                $data = array('order_person_id' => trim($this->input->post('order_person_id')),
                    'order_type' => 'company',
                    'product_id' => isset($orders_list[0]['product_id']) ? $orders_list[0]['product_id'] : $this->input->post('product_id'),
                    'orderdate' => trim($this->input->post('orderdate')),
                    'deliverydate' => trim($this->input->post('deliverydate')),
                    'quantity' => trim($this->input->post('quantity')),
                    'price' => trim($this->input->post('price')),
                    'psize' => trim($this->input->post('psize')),
                    'meter' => trim($this->input->post('meter')),
                    'total_amount' => $this->input->post('price') * $this->input->post('quantity'),
                    'paid_amount' => trim($this->input->post('paid_amount')),
                    'balance_amount' => ($this->input->post('price') * $this->input->post('quantity')) - $this->input->post('paid_amount')
                );

                if ($id != "") {
                    $saveorder = $this->orders_model->update($data, $id);
                    $savemeasurement = $this->orders_model->updatemeasurementvalues($orders_list[0]['id']);
                    $savetype = $this->orders_model->updatetypevalues($orders_list[0]['id']);
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

    public function deliverydetails($orderid) {
        if ($orderid != "") {
            $order_list = $this->orders_model->companyorderlists($orderid);

            if (count($order_list) == 0) {
                redirect(base_url() . 'companyorders', 'refresh');
            }
            $delivery_lists = $this->orders_model->companyorderdeliverylists(array('order_id' => $orderid));
            $deliveryquantity = $this->orders_model->getdeliveryquantity($orderid);
            $data = array('delivery_lists' => $delivery_lists, 'order_list' => $order_list, 'deliveryquantity' => $deliveryquantity);
            $this->load->view('includes/header');
            $this->load->view('includes/sidebar');
            $this->load->view('companyorders/deliverylist', $data);
            $this->load->view('includes/footer');
        } else {
            redirect(base_url() . 'companyorders', 'refresh');
        }
    }

    public function ajaxsavedelivery() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('paiddate', 'Delivery Date', 'trim|required');
            $this->form_validation->set_rules('deliveryquantity', 'Now Delivering Quantity', 'trim|required|min_length[1]|max_length[10]');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {



                $data = array('order_id' => trim($this->input->post('order_id')),
                    'deliveryquantity' => trim($this->input->post('deliveryquantity')),
                    'paiddate' => trim($this->input->post('paiddate'))
                );
                if (isset($_POST['deliveryid']) && !empty($_POST['deliveryid'])) {
                    $savedelivery = $this->orders_model->updatedeliveryquantity($data, $_POST['deliveryid']);
                } else {
                    $data['created_on'] = date('Y-m-d H:i:s');
                    $savedelivery = $this->orders_model->savedeliveryquantity($data);
                }                
                $this->changestatus(md5($this->input->post('order_id')));
                if ($savedelivery == 1) {
                    $this->session->set_flashdata('SucMessage', 'Delivery Quantity Details Saved Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Delivery Quantity Details Saved Not Successfully'));
                }
            }
        }
    }

    public function getdeliverydetails() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $deliveryquantity = $this->orders_model->getdeliveryquantity(md5($_POST['orderid']));
            $delivery_lists = $this->orders_model->getcompanyorderdeliverylists(array('id' => $_POST['deliveryid']));
            $alreadydeliveryquantity = isset($deliveryquantity[0]['totaldeliveryquanity']) ? $deliveryquantity[0]['totaldeliveryquanity'] : 0;
            if (isset($_POST['deliveryid']) && !empty($_POST['deliveryid'])) {
                $alreadydeliveryquantity = (int) (isset($deliveryquantity[0]['totaldeliveryquanity']) ? $deliveryquantity[0]['totaldeliveryquanity'] : 0) - (int) (isset($delivery_lists[0]['deliveryquantity']) ? (int) $delivery_lists[0]['deliveryquantity'] : 0);
            }

            echo json_encode(array('alreadydeliveryquantity' => $alreadydeliveryquantity,
                'paiddate' => isset($delivery_lists[0]['paiddate']) ? $delivery_lists[0]['paiddate'] : "",
                'deliveryquantity' => isset($delivery_lists[0]['deliveryquantity']) ? $delivery_lists[0]['deliveryquantity'] : "",
                'deliveryid' => isset($delivery_lists[0]['id']) ? $delivery_lists[0]['id'] : "",
            ));
        }
    }

    public function measurementdetails() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $result = $this->orders_model->measurementvalues();
            $html = "";
            $typeresult = $this->orders_model->producttypevalues();
            if (count($typeresult) > 0) {
                $html .= '<div class="header"><h2>Product Types</h2></div><div class="row">';
                foreach ($typeresult as $key => $value) {
                    $html .= '<div class="col-md-4"><input type="checkbox" id="producttype_' . $key . '" name="producttype[' . $value['id'] . ']" class="chk-col-red" ' . $value['typevalue'] . '/><label for="producttype_' . $key . '">' . $value['typename'] . '</label></div>';
                }
                $html .= '</div>';
            }
            if (count($result)) {
                $html .= '<div class="header"><h2>Measurement Detail</h2></div><div class="row">';
                foreach ($result as $key => $value) {
                    $html .= '<div class="col-md-3"><label for="email_address">' . $value['mname'] . '</label><div class="form-group">
                                    <div class="form-line">
                                        <input id="measurement_value' . $value['id'] . '" name="measurement_value[' . $value['id'] . ']" class="form-control" placeholder="value" type="text" value="' . $value['measurementvalue'] . '">
                                    </div>
                                </div></div>';
                }
                $html .= '</div>';
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
            redirect(base_url() . 'companyorders', 'refresh');
        } else {
            redirect(base_url() . 'companyorders', 'refresh');
        }
    }

    public function deletedeliveryquantity($id = NULL, $order_id = NULL) {
        if ($id != "") {
            $deleteorder = $this->orders_model->deletedeliveryquantity($id);
            if ($deleteorder == "1") {
                $this->changestatus($order_id);
                $this->session->set_flashdata('SucMessage', 'Delivery Quantity Details has been deleted successfully!!!');
            } else {
                $this->session->set_flashdata('ErrorMessages', 'Delivery Quantity Details has not been deleted successfully!!!');
            }
            redirect(base_url() . 'companyorders/deliverydetails/' . $order_id, 'refresh');
        } else {
            redirect(base_url() . 'companyorders', 'refresh');
        }
    }

    public function changestatus($order_id) {
        $orders_list = $this->orders_model->companyorderlists($order_id);
        $totalquantity = (isset($orders_list[0]['quantity'])) ? $orders_list[0]['quantity'] : 0;
        $deliverylist = $this->orders_model->getdeliveryquantity($order_id);
        $deliveryquantity = (isset($deliverylist[0]['totaldeliveryquanity'])) ? $deliverylist[0]['totaldeliveryquanity'] : 0;
        if ($totalquantity == $deliveryquantity) {
            $this->orders_model->update(array('orderstatus' => 'delivered'), $order_id);
        } else {
            $this->orders_model->update(array('orderstatus' => 'inprogress'), $order_id);
        }
    }

    public function vieworders() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $html = "";
            $orders_list = $this->orders_model->companyorderlists($_POST['order_id']);
            if (count($orders_list)) {
                $printurl = base_url() . 'companyorders/printorder?order_id=' . $_POST['order_id'];
                $html .= '<a href="' . $printurl . '" class="btn bg-cyan waves-effect" target="_blank">Print This</a>';
                $html .= '<div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">' . $orders_list[0]['orderno'] . '</h4>
                </div><div class="modal-body">
                    <h4>Order Details</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-6"><label>Name</label></div><div class="col-md-6">' . $orders_list[0]['name'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6"><label>Mobile No</label></div><div class="col-md-6">' . $orders_list[0]['mobileno'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6"><label>Price</label></div><div class="col-md-6">' . $orders_list[0]['price'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6"><label>Quantity</label></div><div class="col-md-6">' . $orders_list[0]['quantity'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6"><label>Total Amount</label></div><div class="col-md-6">' . $orders_list[0]['total_amount'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6"><label>Paid Amount</label></div><div class="col-md-6">' . $orders_list[0]['paid_amount'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6"><label>Balnce Amount</label></div><div class="col-md-6">' . $orders_list[0]['balance_amount'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6"><label>Order Date</label></div><div class="col-md-6">' . $orders_list[0]['orderdate'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6"><label>Delivery Date</label></div><div class="col-md-6">' . $orders_list[0]['deliverydate'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6"><label>Product Name</label></div><div class="col-md-6">' . $orders_list[0]['productname'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6"><label>Size</label></div><div class="col-md-6">' . $orders_list[0]['psize'] . '</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6"><label>Meter</label></div><div class="col-md-6">' . $orders_list[0]['meter'] . '</div>
                        </div>
                    </div>';
                /* $typeresult = $this->orders_model->producttypeview();
                  if (count($typeresult)) {
                  $html .= '<h4>Product Types</h4><div class="row">';
                  foreach ($typeresult as $key => $value) {

                  $html .= '<div class="col-md-6">' . $value['typename'] . '</div>';
                  }
                  $html .= '</div>';
                  }
                  $result = $this->orders_model->measurementvalues();
                  if (count($result)) {
                  $html .= '<h4>Measurement Details</h4><div class="row">';
                  foreach ($result as $key => $value) {
                  $html .= '<div class="col-md-6"><div class="col-md-6"><label for="email_address">' . $value['mname'] . '</label></div><div class="col-md-6">' . $value['measurementvalue'] . '</div></div>';
                  }
                  } */
            }
            echo $html;
        }
    }

    public function printorder() {
        if (($this->input->server('REQUEST_METHOD') == 'GET')) {

            $_POST['order_id'] = $_GET['order_id'];
            $html = "";
            $orders_list = $this->orders_model->companyorderlists($_POST['order_id']);
            $result = $this->orders_model->measurementvalues();
            $typeresult = $this->orders_model->producttypeview();
            $this->load->view('companyorders/print', array('htmlcontent' => $html, 'orders_list' => $orders_list, 'typeresult' => $typeresult, 'measurements' => $result));
        }
    }

}
