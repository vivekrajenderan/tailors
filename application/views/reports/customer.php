<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Customer Order Report            
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
                                    Customer Report
                                </h2>
                            </div>                            
                        </div>
                    </div>
                    <div class="body">
                        <form id="orderform" method="POST" name="orderform" action="<?php echo base_url() . 'reports/customer/'; ?>" style="margin-bottom: 30px;">
                            <div class="form-group form-float">
                                <label class="form-label">From Date</label>
                                <div class="form-line">
                                    <input type="text" name="fromdate" id="fromdate" class="datepicker form-control" placeholder="Please choose from date..." value="<?php echo isset($_POST['fromdate']) ? $_POST['fromdate'] : ''; ?>">                                   
                                </div>
                            </div>                        
                            <div class="form-group form-float">
                                <label class="form-label">To Date</label>
                                <div class="form-line">
                                    <input type="text" name="todate" id="todate" class="datepicker form-control" placeholder="Please choose to date..." value="<?php echo isset($_POST['todate']) ? $_POST['todate'] : ''; ?>">                                   
                                </div>
                            </div> 
                            <br>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>

                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Order No</th>
                                        <th>Name</th>     
                                        <th>Price</th>                      
                                        <th>Quantity</th>                      
                                        <th>Total Amount</th>                      
                                        <th>Paid Amount</th>                      
                                        <th>Balance Amount</th>                      
                                        <th>Order Date</th> 
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Order No</th>
                                        <th>Name</th> 
                                        <th>Price</th>
                                        <th>Quantity</th> 
                                        <th>Total Amount</th>                      
                                        <th>Paid Amount</th>                      
                                        <th>Balance Amount</th>                      
                                        <th>Order Date</th>                      

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($orders_lists as $key => $lists) { ?>
                                        <tr>
                                            <td><?php echo isset($lists['orderno']) ? $lists['orderno'] : ""; ?></td>
                                            <td><?php echo isset($lists['name']) ? $lists['name'] : ""; ?></td>                                                   
                                            <td><?php echo isset($lists['price']) ? $lists['price'] : ""; ?></td>    
                                            <td><?php echo isset($lists['quantity']) ? $lists['quantity'] : ""; ?></td>    
                                            <td><?php echo isset($lists['total_amount']) ? $lists['total_amount'] : ""; ?></td>    
                                            <td><?php echo isset($lists['paid_amount']) ? $lists['paid_amount'] : ""; ?></td>    
                                            <td><?php echo $lists['total_amount'] - $lists['paid_amount']; ?></td>    
                                            <td><?php echo isset($lists['orderdate']) ? $lists['orderdate'] : ""; ?></td>
                                        </tr>       
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
            <div id="showorder">                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo base_url() . 'assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css'; ?>" rel="stylesheet">
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/jquery.dataTables.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/jszip.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js'; ?>"></script>
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
        setTimeout(function () {
            $('.bg-red').hide('slow');
            $('.bg-green').hide('slow');
        }, 4000);

        $('.js-basic-example').DataTable({
            responsive: true
        });

        //Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                }
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [6]}  //Not sorting the first and last columns

            ],
        });
    });
    function vieworders(orderid)
    {
        if (orderid != "")
        {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>customerorders/vieworders",
                data: "order_id=" + orderid,
                async: false,
                success:
                        function (msg) {
                            $("#showorder").html(msg);
                            $('#defaultModal').modal('show');
                        }
            });
        }
    }

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
                fromdate: {
                    required: true
                },
                todate: {
                    required: true
                }
            },
            messages: {
                fromdate: {
                    required: "Please choose from date"

                },
                todate: {
                    required: "Please choose to date"

                }
            }
        });
    });
</script>