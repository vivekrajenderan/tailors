<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Income Report            
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
                                    Income Report
                                </h2>
                            </div>  
                            <div class="col-md-6 col-xs-4">
                                <div class="pull-right"><button onclick="location.href = '<?php echo base_url() . "income/add"; ?>';" type="button" class="btn bg-cyan waves-effect">Add Income</button></div>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <form id="orderform" method="POST" name="orderform" action="<?php echo base_url() . 'income/index/'; ?>" style="margin-bottom: 30px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <label class="form-label">From Date</label>
                                        <div class="form-line">
                                            <input type="text" name="fromdate" id="fromdate" class="datepicker form-control" placeholder="Please choose from date..." value="<?php echo isset($_POST['fromdate']) ? $_POST['fromdate'] : ''; ?>">                                   
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <label class="form-label">To Date</label>
                                        <div class="form-line">
                                            <input type="text" name="todate" id="todate" class="datepicker form-control" placeholder="Please choose to date..." value="<?php echo isset($_POST['todate']) ? $_POST['todate'] : ''; ?>">                                   
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Income Type</label>
                                        <div class="form-line">
                                            <input type="text" name="typename" id="typename" class="form-control customertext" placeholder="Please select type" value="<?php echo isset($_POST['typename']) ? $_POST['typename'] : ''; ?>">                                   
                                            <input type="hidden" name="reference_id" id="reference_id" class="form-control" value="<?php echo isset($_POST['reference_id']) ? $_POST['reference_id'] : ''; ?>">                                   
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="btn bg-grey waves-effect resetform">Reset</a>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>

                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date</th> 
                                        <th>Amount</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $total_amount = 0;
                                    foreach ($expenseslists as $key => $lists) {
                                        $total_amount += $lists['amount'];
                                        ?>
                                        <tr>
                                            <td><?php echo isset($lists['name']) ? $lists['name'] : ""; ?></td>
                                            <td><?php echo isset($lists['created_on']) ? $lists['created_on'] : ""; ?></td>                                            
                                            <td><?php echo isset($lists['amount']) ? $lists['amount'] : ""; ?></td>
                                            <td>
                                                <a href="<?php echo base_url() . 'income/add/' . md5($lists['id']); ?>" title="Edit" ><i class="material-icons" style="font-size: 20px;">edit</i></a>&nbsp;<a href="<?php echo base_url() . 'expenses/delete/' . md5($lists['id']); ?>" title="Delete"><i class="material-icons" style="font-size: 20px;">delete</i></a>
                                            </td>
                                        </tr>       
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2"></th>                                       
                                        <th>Total Amount</th>  
                                        <th>&nbsp;</th>

                                    </tr>
                                    <tr>
                                        <td colspan="2"></td> 
                                        <td><?php echo $total_amount; ?></td>    
                                        <td>&nbsp;</td>
                                    </tr>
                                </tfoot>

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
<script src="<?php echo base_url() . 'assets/js/bootstrap-typeahead.js'; ?>"></script>
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

                                        $('.resetform').click(function () {
                                            $('.datepicker').bootstrapMaterialDatePicker('setDate', null);
                                            $('.datepicker').attr('value', '');
                                            $('.customertext').attr('value', '');
                                            $('#orderform')[0].reset();
                                        });

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
                                                {'bSortable': false, 'aTargets': [3]}  //Not sorting the first and last columns

                                            ],
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
                                    function displayResult(item) {
                                        if (item.value)
                                        {
                                            $("#reference_id").val(item.value);
                                        }
                                    }
                                    $('#typename').typeahead({
                                        source: <?php echo json_encode($type_list); ?>,
                                        onSelect: displayResult
                                    });
</script>