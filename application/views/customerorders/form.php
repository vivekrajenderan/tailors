<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Customer Orders                    
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?php echo ($id != "") ? "Edit" : "Create"; ?> Customer Orders <?php echo isset($order_list[0]['orderno']) ? " - ".$order_list[0]['orderno'] : ''; ?></h2>                        
                    </div>
                    <div class="body">
                        <div class="alert bg-red" style="display:none;">

                        </div>
                        <form id="orderform" method="POST" name="orderform" action="<?php echo base_url() . 'customerorders/ajaxsave/' . $id; ?>">
                            <div class="form-group form-float">
                                <label class="form-label">Customer</label>
                                <div class="form-line">
                                    <select class="form-control show-tick" id="order_person_id" name="order_person_id">
                                        <option value="">-- Please Select Customer--</option>
                                        <?php
                                        foreach ($customer_list as $list) {
                                            $selectedcustomer = "";
                                            if (isset($order_list[0]['order_person_id']) && !empty($order_list[0]['order_person_id'])) {
                                                if ($order_list[0]['order_person_id'] == $list['id']) {
                                                    $selectedcustomer = "selected";
                                                }
                                            }
                                            echo "<option value='" . $list['id'] . "' $selectedcustomer>" . $list['name'] . "- ".$list['mobileno']."</option>";
                                        }
                                        ?>

                                    </select>                                    
                                </div>
                            </div>                           
                            <div class="form-group form-float">
                                <label class="form-label">Order Date</label>
                                <div class="form-line">
                                    <input type="text" name="orderdate" id="orderdate" class="datepicker form-control" placeholder="Please choose order date..." value="<?php echo isset($order_list[0]['orderdate']) ? $order_list[0]['orderdate'] : ''; ?>">                                   
                                </div>
                            </div>  
                            <div class="form-group form-float">
                                <label class="form-label">Price</label>
                                <div class="form-line">
                                    <input type="text" class="form-control totalamount" name="price" id="price" value="<?php echo isset($order_list[0]['price']) ? $order_list[0]['price'] : ''; ?>" required>

                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Quantity</label>
                                <div class="form-line">
                                    <input type="text" class="form-control totalamount" name="quantity" id="quantity" value="<?php echo isset($order_list[0]['quantity']) ? $order_list[0]['quantity'] : ''; ?>" required>

                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Total Amount</label>
                                <div class="form-line">
                                    <input type="text" class="form-control balanceamount" name="total_amount" id="total_amount" value="<?php echo isset($order_list[0]['total_amount']) ? $order_list[0]['total_amount'] : ''; ?>" disabled="" required>

                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Paid Amount</label>
                                <div class="form-line">
                                    <input type="text" class="form-control balanceamount" name="paid_amount" id="paid_amount" value="<?php echo isset($order_list[0]['paid_amount']) ? $order_list[0]['paid_amount'] : ''; ?>" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Balance Amount</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="balance_amount" id="balance_amount" value="<?php echo isset($order_list[0]['balance_amount']) ? $order_list[0]['balance_amount'] : ''; ?>" disabled="" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Product</label>
                                <div class="form-line">
                                    <select class="form-control show-tick" id="product_id" name="product_id" <?php echo isset($order_list[0]['product_id']) ? "disabled" : ""; ?> onchange="getmeasuredetails(this.value)">
                                        <option value="">-- Please Select Product--</option>
                                        <?php
                                        foreach ($products_list as $plist) {
                                            $selectedproduct = "";
                                            if (isset($order_list[0]['product_id']) && !empty($order_list[0]['product_id'])) {
                                                if ($order_list[0]['product_id'] == $plist['id']) {
                                                    $selectedproduct = "selected";
                                                }
                                            }
                                            echo "<option value='" . $plist['id'] . "' $selectedproduct>" . $plist['productname'] . "</option>";
                                        }
                                        ?>

                                    </select>  

                                </div>
                            </div>
                            <div class="row clearfix" id="measureval">                                

                            </div>
                            <br>

                            <a href="<?php echo base_url(); ?>customerorders" class="btn bg-blue-grey waves-effect" onclick="return confirm('Are you sure cancel the data?')">Cancel</a>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Validation -->        
</div>
</section>

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
                                            order_person_id: {
                                                required: true
                                            },
                                            orderdate: {
                                                required: true
                                            },
                                            product_id: {
                                                required: true
                                            },
                                            price: {
                                                required: true,
                                                minlength: 2,
                                                maxlength: 10,
                                                digits: true,
                                            },
                                            quantity: {
                                                required: true,
                                                minlength: 1,
                                                maxlength: 10,
                                                digits: true,
                                            },
                                            total_amount: {
                                                required: true,
                                                minlength: 2,
                                                maxlength: 10,
                                                digits: true,
                                            },
                                            paid_amount: {
                                                required: true,
                                                minlength: 2,
                                                maxlength: 10,
                                                digits: true,
                                            }
                                        },
                                        messages: {
                                            order_person_id: {
                                                required: "Please choose customer name"

                                            },
                                            orderdate: {
                                                required: "Please choose order date"

                                            },
                                            product_id: {
                                                required: "Please choose product"

                                            },
                                            price: {
                                                required: "Please enter price"

                                            },
                                            quantity: {
                                                required: "Please enter quantity"

                                            },
                                            total_amount: {
                                                required: "Please enter total amount"

                                            },
                                            paid_amount: {
                                                required: "Please enter paid amount"

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
                                                    window.location = "<?php echo base_url() . 'customerorders'; ?>";
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
                                var product_id = $("#product_id option:selected").val();
                                getmeasuredetails(product_id);
                                function getmeasuredetails(product_id)
                                {
                                    if (product_id != "")
                                    {
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo base_url(); ?>customerorders/measurementdetails",
                                            data: "product_id=" + product_id + "&order_id=" + "<?php echo $id; ?>",
                                            async: false,
                                            success:
                                                    function (msg) {
                                                        $("#measureval").html(msg);
                                                    }
                                        });
                                    }
                                }
                                $('#price #quantity').on('blur change', blurChange);
                                function blurChange(e) {
                                    alert("came");
                                }
                                $(".totalamount").on("click blur change", function (event) {
                                    var totalamount = $("#price").val() * $("#quantity").val();
                                    $("#total_amount").val(totalamount);
                                });
                                $(".balanceamount").on("click blur change", function (event) {
                                    var balanceamount = $("#total_amount").val() - $("#paid_amount").val();
                                    $("#balance_amount").val(balanceamount);
                                });

//                   
</script>