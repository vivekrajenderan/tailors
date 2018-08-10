<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Customer Orders                
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
                                    Customer Order Lists
                                </h2>
                            </div>
                            <div class="col-md-6 col-xs-4">
                                <div class="pull-right"><button onclick="location.href = '<?php echo base_url() . "customerorders/add"; ?>';" type="button" class="btn bg-cyan waves-effect">Create Order</button></div>
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
                                        <th>Action</th>
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
                                        <th>Action</th>
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
                                            <td>
                                                <a href="<?php echo base_url() . 'customerorders/add/' . md5($lists['id']); ?>" title="Edit" ><i class="material-icons" style="font-size: 18px;">edit</i></a>&nbsp;<a href="<?php echo base_url() . 'customerorders/delete/' . md5($lists['id']); ?>" title="Delete" onclick="return confirm('Are you sure delete the data?')"><i class="material-icons" style="font-size: 18px;">delete</i></a>
                                                <a href="javascript:void(0);" title="View" onclick="return vieworders('<?php echo md5($lists['id']); ?>')"><i class="material-icons" style="font-size: 18px;">remove_red_eye</i></a>
                                            </td>                                        

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
<script type="text/javascript">
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
                                                            {'bSortable': false, 'aTargets': [7]}  //Not sorting the first and last columns

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
                                                    $('#printOut').click(function (e) {
                                                        e.preventDefault();
                                                        var w = window.open();
                                                        var printOne = $('#showorder').html();                                                        
                                                        w.document.write('<html><head><title>Copy Printed</title></head><body>' + printOne) + '</body></html>';
                                                        w.window.print();
                                                        w.document.close();
                                                        return false;
                                                    });
                                                });

</script>