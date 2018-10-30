<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Customer Paid Details 
            </h2>
        </div>        
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-6 col-xs-8">
                                <h2>
                                    Customer Paid Details (<?php echo isset($order_list[0]['orderno']) ? $order_list[0]['orderno'] : ""; ?>)
                                </h2>
                                <h6>Total Amount : <?php echo isset($order_list[0]['total_amount']) ? $order_list[0]['total_amount'] : ""; ?></h6>
                                <h6>Already Paid Amount : <?php echo isset($paidamount[0]['totalpaidamount']) ? $paidamount[0]['totalpaidamount'] : 0; ?></h6>
                            </div>

                            <div class="col-md-6 col-xs-4">
                                <div class="pull-right">
                                <?php
                                $alpaid = isset($paidamount[0]['totalpaidamount']) ? $paidamount[0]['totalpaidamount'] : 0;
                                $totamount = isset($order_list[0]['total_amount']) ? $order_list[0]['total_amount'] : 0;
                                if ($alpaid < $totamount) {
                                    ?>
                                    <button onclick="return paiddetails('<?php echo isset($order_list[0]['id']) ? $order_list[0]['id'] : ""; ?>', '')" type="button" class="btn bg-cyan waves-effect">Add Amount</button>
                                <?php } ?>
                                <button onclick="location.href = '<?php echo base_url() . "customerorders"; ?>';" type="button" class="btn bg-light-blue waves-effect">Customer Order List</button></div>

                            </div>

                        </div>
                    </div>
                    <div class="body">
                        <?php if ($this->session->flashdata('ErrorMessages') != '') { ?>                            
                            <div class="alert bg-red alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?php echo $this->session->flashdata('ErrorMessages'); ?>
                            </div>
                            <?php
                        }
                        if ($this->session->flashdata('SucMessage') != '') {
                            ?>
                            <div class="alert bg-green alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?php echo $this->session->flashdata('SucMessage'); ?>
                            </div>                            
                        <?php } ?>
                        <div class="body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>              
                                        <th>Amount</th>  
                                        <th>Paid On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if (count($paid_lists) > 0) {
                                        foreach ($paid_lists as $key => $lists) {
                                            ?>
                                            <tr>     
                                                <td><?php echo isset($lists['paidamount']) ? $lists['paidamount'] : ""; ?></td>    
                                                <td><?php echo isset($lists['paiddate']) ? $lists['paiddate'] : ""; ?></td>                                                
                                                <td>
                                                    <a href="javascript:void(0);" title="Edit" onclick="return paiddetails('<?php echo isset($order_list[0]['id']) ? $order_list[0]['id'] : ""; ?>', '<?php echo md5($lists['id']); ?>')"><i class="material-icons" style="font-size: 18px;">edit</i></a>&nbsp;<a href="<?php echo base_url() . 'customerorders/deletepaidamount/' . md5($lists['id']) . '/' . md5($lists['order_id']); ?>" onclick="return confirm('Are you sure delete the data?')" title="Delete"><i class="material-icons" style="font-size: 18px;">delete</i></a>

                                                </td>                                        

                                            </tr>       
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr><td colspan="3" align="center">No Records</td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="header">
                    <h2>Paid Amount</h2>                        
                </div>
                <div class="body">
                    <div class="alert bg-red" style="display:none;">

                    </div>
                    <form id="orderform" method="POST" name="orderform" action="<?php echo base_url() . 'customerorders/ajaxsavepaid/'; ?>">
                        <input type="hidden" name="paidid" id="paidid">
                        <input type="hidden" name="order_id" id="order_id" value="<?php echo isset($order_list[0]['id']) ? $order_list[0]['id'] : ''; ?>">
                        <div class="form-group form-float">
                            <label class="form-label">Paid Date</label>
                            <div class="form-line">
                                <input type="text" name="paiddate" id="paiddate" class="datepicker form-control" placeholder="Please choose paid date..." value="">                                   
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <label class="form-label">Total Amount</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="totalamount" id="totalamount" value="<?php echo isset($order_list[0]['total_amount']) ? $order_list[0]['total_amount'] : ''; ?>" disabled>

                            </div>
                        </div>
                        <div class="form-group form-float">
                            <label class="form-label">Already Paid Amount</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="alreadypaidamount" id="alreadypaidamount" value="0" disabled>

                            </div>
                        </div>
                        <div class="form-group form-float">
                            <label class="form-label">Now Paid Amount</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="paidamount" id="paidamount" value="">

                            </div>
                        </div>
                        <a href="javascript:void(0);" class="btn bg-blue-grey waves-effect" data-dismiss="modal">Cancel</a>
                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function paiddetails(orderid = '', paidid)
    {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>customerorders/getpaiddetails",
            data: "orderid=" + orderid + "&paidid=" + paidid,
            async: false,
            dataType: 'json'
        }).done(function (response) {
            $('#paidid').val(response.paidid);
            $('#paiddate').val(response.paiddate);
            $('#alreadypaidamount').val(response.alreadypaidamount);
            $('#paidamount').val(response.paidamount);
            $('#defaultModal').modal('show');
        });

    }
</script>

<script src="<?php echo base_url() . 'assets/plugins/jquery-validation/jquery.validate.js'; ?>"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            time: false
        });
    });

    $(function () {

        $('#orderform').validate({
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
            rules: {
                paiddate: {
                    required: true
                },
                paidamount: {
                    required: true,
                    minlength: 1,
                    maxlength: 10,
                    digits: true,
                    checkequalamount: true,
                }
            },
            messages: {
                paiddate: {
                    required: "Please choose Delivery Date"

                },
                paidamount: {
                    required: "Please enter now delivery quantity"

                }
            },
            submitHandler: function (form) {
                var $form = $("#orderform");
                $.ajax({
                    type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    dataType: 'json'
                }).done(function (response) {
                    if (response.status == "1")
                    {
                        location.reload(true);
                    } else
                    {
                        $('.bg-red').show();
                        $('.bg-red').html(response.msg);
                        setTimeout(function () {
                            $('.bg-red').hide('slow');
                        }, 4000);
                    }
                });
                return false; // required to block normal submit since you used ajax
            }
        });
        $.validator.addMethod("checkequalamount", function (value, element) {
            if (value != "")
            {
                var alreadyquantity = $('#alreadypaidamount').val();
                var totalamount = $('#totalamount').val();
                var sumquantity = parseInt(alreadyquantity) + parseInt(value);

                console.log(alreadyquantity + "-" + totalamount + "-" + sumquantity);
                if (sumquantity <= totalamount)
                {
                    return true;
                }
                return false;
            } else
            {
                return true;
            }
        }, "Pleas check Total Amount and Already Paid Amount!");
    });


//                   
</script>