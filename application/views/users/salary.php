<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Staff  Salary
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?php echo ($id != "") ? "Edit" : "Add"; ?> Staff Salary</h2>                        
                    </div>
                    <div class="body">
                        <div class="alert bg-red" style="display:none;">

                        </div>
                        <form id="userform" method="POST" name="userform" action="<?php echo base_url() . 'users/ajaxsalarysave/' . $id; ?>" enctype="multipart/form-data">
                            <input type="hidden" name="sallary_id" id="sallary_id" value="<?php echo isset($balance_list[0]['id']) ? $balance_list[0]['id'] : ''; ?>">
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

                            <h4>Product Details</h4><br>
                            <?php
                            $total_amount = 0;
                            foreach ($product_list as $key => $value) {
                                ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group form-float" style="margin-top: 25px !important;">
                                            <div>
                                                <input type="checkbox" id="producttype_<?php echo $key; ?>" name="producttype[<?php echo $value['id']; ?>]" class="chk-col-red" <?php echo $value['typevalue']; ?> onclick="productcalc('<?php echo $key; ?>');"/>
                                                <label for="producttype_<?php echo $key; ?>"><?php echo $value['productname']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-float">
                                            <label class="form-label">Quantity</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="quantity_<?php echo $key; ?>" name="quantity[<?php echo $value['id']; ?>]" value="<?php echo isset($value['quantity']) ? $value['quantity'] : ''; ?>" <?php
                                                if (empty($value['typevalue'])) {
                                                    echo "disabled";
                                                }
                                                ?> onchange="calculatetot('<?php echo $key; ?>')">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-float">
                                            <label class="form-label">Price</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="price_<?php echo $key; ?>" name="price[<?php echo $value['id']; ?>]" value="<?php echo isset($value['price']) ? $value['price'] : ''; ?>" <?php
                                                if (empty($value['typevalue'])) {
                                                    echo "disabled";
                                                }
                                                ?> onchange="calculatetot('<?php echo $key; ?>')">

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-float">

                                            <label class="form-label">Total</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="total_<?php echo $key; ?>" name="total[]" value="<?php echo (!empty($value['price']) && !empty($value['quantity'])) ? $value['price'] * $value['quantity'] : ''; ?>" disabled="" class="totalamountcalc">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php                                
                                $total_amount += (!empty($value['price']) && !empty($value['quantity'])) ? $value['price'] * $value['quantity'] : 0;
                            }
                            ?>
                            <div class="form-group form-float">

                                <label class="form-label">Total Amount</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="totalamount" id="totalamount" value="<?php echo $total_amount; ?>" onchange="balancecalculation()" disabled="">
                                </div>
                            </div> 

                            <div class="form-group form-float">

                                <label class="form-label">Debit Amount</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="debitamount" id="debitamount" value="<?php echo isset($balance_list[0]['debitamount']) ? $balance_list[0]['debitamount'] : 0; ?>" onchange="balancecalculation()" required>
                                </div>
                            </div> 

                            <div class="form-group form-float">

                                <label class="form-label">Balance Amount</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="balanceamount" id="balanceamount" value="<?php echo isset($balance_list[0]['balanceamount']) ? $balance_list[0]['balanceamount'] : 0; ?>" disabled>
                                </div>
                            </div> 



                            <a href="<?php echo base_url(); ?>users/staffsalary" class="btn bg-blue-grey waves-effect" onclick="return confirm('Are you sure cancel the data?')">Cancel</a>
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

                                function productcalc(key)
                                {
                                    if ($("#producttype_" + key).prop("checked") == true) {
                                        $("#quantity_" + key).removeAttr('disabled');
                                        $("#price_" + key).removeAttr('disabled');

                                    } else
                                    {
                                        $("#quantity_" + key).attr("disabled", true);
                                        $("#price_" + key).attr("disabled", true);
                                        $("#quantity_" + key).val('');
                                        $("#price_" + key).val('');
                                        $("#total_" + key).val('');
                                        calculatetot(key);
                                    }
                                }
                                function calculatetot(key)
                                {
                                    var quantity = $("#quantity_" + key).val();
                                    var price = $("#price_" + key).val();
                                    if (quantity && price)
                                    {

                                        var total = $("#total_" + key).val(parseFloat(quantity) * parseFloat(price));

                                    }
                                    balancecalculation();
                                }

                                function balancecalculation()
                                {
                                    var totalSum = 0;
                                    $('input[name="total[]"]').each(function (index) {
                                        if ($("#total_" + index).val())
                                        {
                                            totalSum += parseFloat($("#total_" + index).val());
                                        }
                                    });
                                    if (parseFloat($("#debitamount").val()) > 0)
                                    {                                        
                                        $("#balanceamount").val(parseFloat(totalSum) - parseFloat($("#debitamount").val()));
                                    } else
                                    {
                                        $("#balanceamount").val(parseFloat(totalSum));
                                    }
                                    $("#totalamount").val(parseFloat(totalSum));
                                }

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
                                            debitamount: {
                                                required: true,
                                                minlength: 1,
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
                                            debitamount: {
                                                required: "Please enter the debit amount"

                                            },
                                            user_id: {
                                                required: "Please choose the staff"

                                            }


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
                                                    window.location = "<?php echo base_url() . 'users/staffsalary'; ?>";
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

</script>