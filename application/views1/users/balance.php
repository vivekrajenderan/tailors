<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Staff  Amount                  
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?php echo ($id != "") ? "Edit" : "Add"; ?> Staff</h2>                        
                    </div>
                    <div class="body">
                        <div class="alert bg-red" style="display:none;">

                        </div>
                        <form id="userform" method="POST" name="userform" action="<?php echo base_url() . 'users/ajaxbalancesave/' . $id; ?>" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <label class="form-label">Staff Name</label>
                                <div class="form-line">
                                    <select class="form-control show-tick" id="user_id" name="user_id">
                                        <option value="">-- Please Select Staff--</option>
                                        <?php
                                        foreach ($users_list as $plist) {
                                            $selecteduser = "";
                                            if (isset($balance_list[0]['user_id']) && !empty($balance_list[0]['user_id'])) {
                                                if ($balance_list[0]['user_id'] == $plist['id']) {
                                                    $selecteduser = "selected";
                                                }
                                            }
                                            echo "<option value='" . $plist['id'] . "' $selecteduser>" . $plist['firstname'] . " " . $plist['lastname'] . "</option>";
                                        }
                                        ?>

                                    </select> 
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Amount</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="amount" id="amount" value="<?php echo isset($balance_list[0]['amount']) ? $balance_list[0]['amount'] : ''; ?>" required>
                                </div>
                            </div>                           
                            <div class="form-group form-float">
                                <label class="form-label">Date</label>
                                <div class="form-line">
                                    <input type="text" class="datepicker form-control" placeholder="Please choose to date..." name="buydate" id="buydate" value="<?php echo isset($balance_list[0]['buydate']) ? $balance_list[0]['buydate'] : ''; ?>" required>
                                </div>
                            </div>                           
                             
                            <a href="<?php echo base_url(); ?>users/staffbalance" class="btn bg-blue-grey waves-effect" onclick="return confirm('Are you sure cancel the data?')">Cancel</a>
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
                                    $(document).ready(function () {
                                        $('.datepicker').bootstrapMaterialDatePicker({
                                            format: 'YYYY-MM-DD',
                                            clearButton: true,
                                            weekStart: 1,
                                            time: false
                                        });
                                    });
                                    $('#userform').validate({
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
                                            user_id: {
                                                required: true
                                            },
                                            buydate: {
                                                required: true
                                            }

                                        },
                                        messages: {
                                            amount: {
                                                required: "Please enter the amount"

                                            },
                                            user_id: {
                                                required: "Please choose the staff"

                                            },
                                            buydate: {
                                                required: "Please choose the date"

                                            },

                                        },
                                        submitHandler: function (form) {                                           
                                            var $form = $("#userform");
                                            $.ajax({
                                                type: $form.attr('method'),
                                                url: $form.attr('action'),
                                                data: $form.serialize(),                                                
                                                dataType: 'json'
                                            }).done(function (response) {

                                                if (response.status == "1")
                                                {
                                                    window.location = "<?php echo base_url() . 'users/staffbalance'; ?>";
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
                                    $.validator.addMethod("existusername", function (value, element) {
                                        var checkUser = check_exist_user(value);
                                        if (checkUser == "1")
                                        {
                                            return false;
                                        }
                                        return true;

                                    }, "User Name Already Exists!");
                                });
                                function check_exist_user(username) {
                                    var isSuccess = 0;
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_url(); ?>users/exist_users_check",
                                        data: "username=" + username + "&id=" + "<?php echo $id; ?>",
                                        async: false,
                                        success:
                                                function (msg) {
                                                    isSuccess = msg === "1" ? 1 : 0
                                                }
                                    });
                                    return isSuccess;
                                }
</script>