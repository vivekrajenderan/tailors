<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Products                    
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?php echo ($id != "") ? "Edit" : "Add"; ?> Product</h2>                        
                    </div>
                    <div class="body">
                        <div class="alert bg-red" style="display:none;">

                        </div>
                        <form id="productform" method="POST" name="productform" action="<?php echo base_url() . 'products/ajaxsave/' . $id; ?>" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="productname" id="productname" value="<?php echo isset($products_list[0]['productname']) ? $products_list[0]['productname'] : ''; ?>" required>
                                    <label class="form-label">Name</label>
                                </div>
                            </div>                           
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="price" id="price" value="<?php echo isset($products_list[0]['price']) ? $products_list[0]['price'] : ''; ?>" required>
                                    <label class="form-label">Price</label>
                                </div>
                            </div>                           
                            <div class="form-group form-float">
                                
                                    <?php
                                    $display = "";
                                    if (isset($products_list[0]['product_image']) && !empty($products_list[0]['product_image'])) {
                                        $display = "none";
                                        if (file_exists("./upload/products/" . $products_list[0]['product_image'])) {
                                            $image_name = $products_list[0]['product_image'];
                                        } else {
                                            $image_name = "no_image.png";
                                        }
                                        ?>

                                        <div id='productshowimage'> 
                                            <img class="img-thumbnail" src="<?php echo base_url() . 'upload/products/' . $image_name; ?>" alt="" width="100" height="100"/>
                                            &nbsp;&nbsp;<a href="javascript:void(0);" onclick="RemoveImage();" class="btn bg-brown waves-effect" title="Delete Product">Remove</a>
                                        </div>

                                    <?php } ?>
                                <div class="form-line">
                                    <div id="productimagecontent" style="padding-left: 5px;display:<?php echo $display; ?>;">
                                        <input type="file" name="product_image" id="product_image" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                                    </div>
                                </div>
                            </div>


                            <a href="<?php echo base_url(); ?>products" class="btn bg-blue-grey waves-effect" onclick="return confirm('Are you sure cancel the data?')">Cancel</a>
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
                                function RemoveImage()
                                {
                                    $("#productshowimage").hide();
                                    $("#productimagecontent").show();
                                }
                                $(function () {

                                    $('#productform').validate({
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
                                            productname: {
                                            required: true,
                                                    minlength: 3,
                                                    maxlength: 150,
                                                    existproduct: true
                                            },
                                                    price: {
                                                    required: true,
                                                            minlength: 2,
                                                            maxlength: 10,
                                                            digits: true,
                                                    }
                                            },
                                            messages: {
                                            productname: {
                                            required: "Please enter product name"

                                            },
                                                    price: {
                                                    required: "Please enter price"

                                                    }
                                            },
                                            submitHandler: function (form) {
                                                var formData = new FormData($('#productform')[0]);
                                                formData.append('product_image', $('input[type=file]')[0].files[0]);
                                                var $form = $("#productform");
                                                $.ajax({
                                                type: $form.attr('method'),
                                                        url: $form.attr('action'),
                                                        data: formData,                                                        
                                                        async: false,
                                                        cache: false,
                                                        contentType: false,
                                                        processData: false,
                                                        dataType: 'json'
                                                }).done(function (response) {

                                                    if (response.status == "1")
                                                    {
                                                        window.location = "<?php echo base_url() . 'products'; ?>";
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
                                            $.validator.addMethod("existproduct", function (value, element) {
                                                var checkProduct = check_exist_product(value);
                                                if (checkProduct == "1")
                                                {
                                                    return false;
                                                }
                                                return true;

                                            }, "Product Name Already Exists!");
                                });
                                function check_exist_product(productname) {
                                    var isSuccess = 0;
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_url(); ?>products/exist_product_check",
                                        data: "productname=" + productname + "&id=" + "<?php echo $id; ?>",
                                        async: false,
                                        success:
                                                function (msg) {
                                                    isSuccess = msg === "1" ? 1 : 0
                                                }
                                    });
                                    return isSuccess;
                                }
</script>