<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Customer                    
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?php echo ($id != "") ? "Edit" : "Add"; ?> Customer</h2>                        
                    </div>
                    <div class="body">
                        <div class="alert bg-red" style="display:none;">

                        </div>
                        <form id="customerform" method="POST" name="customerform" action="<?php echo base_url() . 'customer/ajaxsave/' . $id; ?>">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($customer_list[0]['name']) ? $customer_list[0]['name'] : ''; ?>" required>
                                    <label class="form-label">Name</label>
                                </div>
                            </div>                                                                                  
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="address" id="address" cols="30" rows="5" class="form-control no-resize" required><?php echo isset($customer_list[0]['address']) ? $customer_list[0]['address'] : ''; ?></textarea>
                                    <label class="form-label">Address</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="mobileno" id="mobileno" maxlength="10" value="<?php echo isset($customer_list[0]['mobileno']) ? $customer_list[0]['mobileno'] : ''; ?>" required>
                                    <label class="form-label">Mobile No</label>
                                </div>
                            </div>             
                            <a href="<?php echo base_url(); ?>customer" class="btn bg-blue-grey waves-effect" onclick="return confirm('Are you sure cancel the data?')">Cancel</a>
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

                                    $('#customerform').validate({
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
                                            name: {
                                                required: true,
                                                minlength: 3,
                                                maxlength: 150

                                            },
                                            address: {
                                                required: true,
                                                maxlength: 250,
                                            },
                                            mobileno: {
                                                required: true,
                                                digits: true,
                                                minlength: 10,
                                                maxlength: 10,
                                                existcustomer: true
                                            }
                                        },
                                        messages: {
                                            name: {
                                                required: "Please enter customer name"

                                            },
                                            address: {
                                                required: "Please enter customer address"

                                            },
                                            mobileno: {
                                                required: "Please enter mobile number"

                                            }
                                        },
                                        submitHandler: function (form) {
                                            var $form = $("#customerform");
                                            $.ajax({
                                                type: $form.attr('method'),
                                                url: $form.attr('action'),
                                                data: $form.serialize(),
                                                dataType: 'json'
                                            }).done(function (response) {

                                                if (response.status == "1")
                                                {
                                                    window.location = "<?php echo base_url() . 'customer'; ?>";
                                                }
                                                else
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

                                    $.validator.addMethod("existcustomer", function (value, element) {
                                        var checkCustomer = check_exist_customer(value);
                                        if (checkCustomer == "1")
                                        {
                                            return false;
                                        }
                                        return true;

                                    }, "Mobile No Already Exists!");
                                });
                                function check_exist_customer(mobileno) {
                                    var isSuccess = 0;
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_url(); ?>customer/exist_customer_check",
                                        data: "mobileno=" + mobileno + "&id=" + "<?php echo $id; ?>",
                                        async: false,
                                        success:
                                                function (msg) {
                                                    isSuccess = msg === "1" ? 1 : 0
                                                }
                                    });
                                    return isSuccess;
                                }
</script>