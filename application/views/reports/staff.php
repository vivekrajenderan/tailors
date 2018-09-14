<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Staff Balance Report            
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
                                    Staff Balance Report
                                </h2>
                            </div>                            
                        </div>
                    </div>
                    <div class="body">
                        <form id="orderform" method="POST" name="orderform" style="margin-bottom: 30px;">

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
                                        <label class="form-label">Staff</label>
                                        <div class="form-line">
                                            <input type="text" name="username" id="username" class="form-control usertext" placeholder="Please select staff" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">                                   
                                            <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php echo isset($_POST['user_id']) ? $_POST['user_id'] : ''; ?>">                                   
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
                                        <th>Date</th> 
                                        <th>Name</th>     
                                        <th>Mobile No</th> 
                                        <th>Amount</th> 
                                    </tr>
                                </thead>

<!--                                <tbody>
                                <?php
                                $total_amount = 0;
                                foreach ($orders_lists as $key => $lists) {
                                    $total_amount += $lists['amount'];
                                    ?>
                                                                            <tr>                                            
                                                                                <td><?php echo isset($lists['buydate']) ? $lists['buydate'] : ""; ?></td>
                                                                                <td><?php echo isset($lists['firstname']) ? $lists['firstname'] . " " . $lists['lastname'] : ""; ?></td>                                                 
                                                                                <td><?php echo isset($lists['mobileno']) ? $lists['mobileno'] : ""; ?></td>
                                                                                <td><?php echo isset($lists['amount']) ? $lists['amount'] : ""; ?></td>    
                                                                            </tr>       
                                <?php } ?>

                                </tbody>-->
                                <tfoot>
                                    <tr>
                                        <th colspan="3" align="right">Total Amount</th>  
                                        <th id="totalamount">0</th>

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
    function displayResult(item) {
        if (item.value)
        {
            $("#user_id").val(item.value);
        }
    }
    $('#username').typeahead({
        source: <?php echo json_encode($user_list); ?>,
        onSelect: displayResult
    });
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
            $('.usertext').attr('value', '');
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
        var jsdatatable = $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url() . "reports/ajaxstaff"; ?>",
                "type": "POST"
            },
            buttons: [
                {
                    extend: 'copy'
                },
                {
                    extend: 'csv'
                },
                {
                    extend: 'excel'
                },
                {
                    extend: 'pdf'
                },
                {
                    extend: 'print'
                }
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };
                // Total over all pages
                var totalamount = 0;
                totalamount = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                // Update footer
                $(api.column(0).footer()).html('Total Amount');
                $("#totalamount").html(totalamount);
            }

        });

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
            },
            submitHandler: function (form) {
                console.log($("#fromdate").val());
                jsdatatable.ajax.url("<?php echo base_url() . "reports/ajaxstaff?"; ?>"+$('#orderform').serialize()).load();
                return false;
            }
        });
    });

</script>
