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
                                <label class="form-label">Type</label>
                                <div class="form-line">
                                    <select class="form-control show-tick" id="ptype" name="ptype">
                                        <option value="">-- Please Type--</option>
                                        <option value="Outsourcing" <?php
                                        if (isset($products_list[0]['ptype']))
                                            if ($products_list[0]['ptype'] == "Outsourcing") {
                                                echo "selected";
                                            }
                                        ?>>Outsourcing</option>
                                        <option value="Insourcing" <?php
                                        if (isset($products_list[0]['ptype']))
                                            if ($products_list[0]['ptype'] == "Insourcing") {
                                                echo "selected";
                                            }
                                        ?>>Insourcing</option>

                                    </select> 
                                </div>
                            </div>
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
                                <h5>Product Measurement</h5>
                                <hr>
                                <button class="add_field_button btn bg-pink waves-effect">Add More Fields</button>
                                <div class="row">
                                    <div class="col-sm-6 input_fields_wrap">
                                        <?php
                                        if (count($measurements_list) > 0) {
                                            foreach ($measurements_list as $key => $value) {
                                                ?>
                                                <div class="form-group">                                        
                                                    <div class="form-line">                                            
                                                        <input class="form-control measure" placeholder="Name" type="text" name="measurements[]" data-id="<?php echo $value['id']; ?>" value="<?php echo $value['mname']; ?>">
                                                        <span class="remove_field pull-right"><a href="javascript:void(0);"><i class="material-icons">remove_circle</i></a></span>
                                                    </div>
                                                </div>  
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="form-group">                                        
                                                <div class="form-line">                                            
                                                    <input class="form-control measure" placeholder="Name" type="text" data-id="0" name="measurements[]">
                                                    <span class="remove_field pull-right"><a href="javascript:void(0);"><i class="material-icons">remove_circle</i></a></span>
                                                </div>
                                            </div>  
                                        <?php } ?>
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

                                $(document).ready(function () {
                                    var wrapper = $(".input_fields_wrap"); //Fields wrapper
                                    var add_button = $(".add_field_button"); //Add button ID

                                    var x = 1; //initlal text box count
                                    $(add_button).click(function (e) { //on add input button click
                                        e.preventDefault();
                                        x++; //text box increment
                                        $(wrapper).append('<div class="form-group"><div class="form-line"><input type="text" name="measurements[]" data-id="0" class="form-control measure" placeholder="Name"/><span class="remove_field pull-right"><a href="javascript:void(0);"><i class="material-icons">remove_circle</i></a></span></div></div>'); //add input box

                                    });
                                    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                                        e.preventDefault();
                                        $(this).parent('div').remove();
                                        x--;
                                    })
                                });

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
                                            ptype: {
                                                required: true
                                            },
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
                                            ptype: {
                                                required: "Please choose product type"

                                            },
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
                                            var measurementkeyarray = [];
                                            $(".measure").each(function () {
                                                if ($(this).val().replace(/^\s+|\s+$/g, "").length != 0)
                                                {
                                                    measurementkeyarray.push({id: $(this).attr("data-id"), mname: $(this).val()});
                                                }
                                            });
                                            formData.append('measurementkeyarray', JSON.stringify(measurementkeyarray));
                                            formData.append('existmeasurementarray', JSON.stringify(<?php echo json_encode($measurements_list); ?>));
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