<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Expenses Add                  
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?php echo ($id != "") ? "Edit" : "Add"; ?> Expenses</h2>                        
                    </div>
                    <div class="body">
                        <div class="alert bg-red" style="display:none;">

                        </div>
                        <form id="expenseform" method="POST" name="expenseform" action="<?php echo base_url() . 'reports/ajaxexpensesave/' . $id; ?>" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <label class="form-label">Expense Type</label>
                                <div class="form-line">
                                    <select class="form-control show-tick" id="expense_type_id" name="expense_type_id">
                                        <option value="">-- Please Expense Type--</option>
                                        <?php
                                        foreach ($type_list as $plist) {
                                            $selecteduser = "";
                                            if (isset($expenseslists[0]['expense_type_id']) && !empty($expenseslists[0]['expense_type_id'])) {
                                                if ($expenseslists[0]['expense_type_id'] == $plist['id']) {
                                                    $selecteduser = "selected";
                                                }
                                            }
                                            echo "<option value='" . $plist['id'] . "' $selecteduser>" . $plist['name']. "</option>";
                                        }
                                        ?>

                                    </select> 
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Amount</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="amount" id="amount" value="<?php echo isset($expenseslists[0]['amount']) ? $expenseslists[0]['amount'] : ''; ?>" required>
                                </div>
                            </div>                   
                             
                            <a href="<?php echo base_url(); ?>reports/otherexpenses" class="btn bg-blue-grey waves-effect" onclick="return confirm('Are you sure cancel the data?')">Cancel</a>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Validation -->        
    </div>
</section>

<script src="<?php echo base_url() . 'assets/plugins/jquery-validation/jquery.validate.js'; ?>"></script>

<script type="text/javascript">

                                $(function () {                                    
                                    $('#expenseform').validate({
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
                                            amount: {
                                                required: true,
                                                minlength: 2,
                                                maxlength: 10,
                                                digits: true,
                                            },
                                            expense_type_id: {
                                                required: true
                                            }

                                        },
                                        messages: {
                                            amount: {
                                                required: "Please enter the amount"

                                            },
                                            expense_type_id: {
                                                required: "Please choose the expense type"

                                            }

                                        },
                                        submitHandler: function (form) {                                           
                                            var $form = $("#expenseform");
                                            $.ajax({
                                                type: $form.attr('method'),
                                                url: $form.attr('action'),
                                                data: $form.serialize(),                                                
                                                dataType: 'json'
                                            }).done(function (response) {

                                                if (response.status == "1")
                                                {
                                                    window.location = "<?php echo base_url() . 'reports/otherexpenses'; ?>";
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
                                    
                                });                                
</script>