<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Cash On Hand            
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
                                    Cash On Hand
                                </h2>
                            </div>                              
                        </div>
                    </div>
                    <div class="body">
                        <form id="orderform" method="POST" name="orderform" action="<?php echo base_url() . 'income/cashonhand/'; ?>" style="margin-bottom: 30px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <label class="form-label">Date</label>
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
                            </div>
                            <a href="javascript:void(0);" class="btn bg-grey waves-effect resetform">Reset</a>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>

                        </form>                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Expense</th>
                                        <th>Income</th> 
                                        <th>Total</th>                                         
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td><?php
                                            echo (isset($cashlist[0]['expensetotalamount']) && !empty($cashlist[0]['expensetotalamount']))?$cashlist[0]['expensetotalamount']:0;
                                            ?></td>
                                        <td><?php echo (isset($cashlist[0]['incometotalamount']) && !empty($cashlist[0]['incometotalamount']))?$cashlist[0]['incometotalamount']:0;
                                        
                                            ?></td>
                                        <td><?php echo ($cashlist[0]['incometotalamount']) - ($cashlist[0]['expensetotalamount'] * -1); ?></td>
                                    </tr>

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

        $('.resetform').click(function () {
            $('.datepicker').bootstrapMaterialDatePicker('setDate', null);
            $('.datepicker').attr('value', '');
            $('#orderform')[0].reset();
        });

        setTimeout(function () {
            $('.bg-red').hide('slow');
            $('.bg-green').hide('slow');
        }, 4000);

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
</script>