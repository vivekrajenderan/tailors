<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Product Type                   
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?php echo ($id != "") ? "Edit" : "Add"; ?> Product Type</h2>                        
                    </div>
                    <div class="body">
                        <div class="alert bg-red" style="display:none;">

                        </div>
                        <form id="producttypeform" method="POST" name="producttypeform" action="<?php echo base_url() . 'producttype/ajaxsave/' . $id; ?>" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="typename" id="typename" value="<?php echo isset($producttype_list[0]['typename']) ? $producttype_list[0]['typename'] : ''; ?>" required>
                                    <label class="form-label">Type Name</label>
                                </div>
                            </div>                           
                            <div class="form-group form-float">
                                <label class="form-label">Product</label>
                                <div class="form-line">
                                    <select class="form-control show-tick" id="product_id" name="product_id">
                                        <option value="">-- Please Select Product--</option>
                                        <?php
                                        foreach ($products_list as $plist) {
                                            $selectedproduct = "";
                                            if (isset($producttype_list[0]['product_id']) && !empty($producttype_list[0]['product_id'])) {
                                                if ($producttype_list[0]['product_id'] == $plist['id']) {
                                                    $selectedproduct = "selected";
                                                }
                                            }
                                            echo "<option value='" . $plist['id'] . "' $selectedproduct>" . $plist['productname'] . "</option>";
                                        }
                                        ?>

                                    </select>  

                                </div>
                            </div>                           
                            <div class="form-group form-float">

                                <?php
                                $display = "";
                                if (isset($producttype_list[0]['typeimage']) && !empty($producttype_list[0]['typeimage'])) {
                                    $display = "none";
                                    if (file_exists("./upload/producttype/" . $producttype_list[0]['typeimage'])) {
                                        $image_name = $producttype_list[0]['typeimage'];
                                    } else {
                                        $image_name = "no_image.png";
                                    }
                                    ?>

                                    <div id='productshowimage'> 
                                        <img class="img-thumbnail" src="<?php echo base_url() . 'upload/producttype/' . $image_name; ?>" alt="" width="100" height="100"/>
                                        &nbsp;&nbsp;<a href="javascript:void(0);" onclick="RemoveImage();" class="btn bg-brown waves-effect" title="Delete Product">Remove</a>
                                    </div>

                                <?php } ?>
                                <div class="form-line">
                                    <div id="productimagecontent" style="padding-left: 5px;display:<?php echo $display; ?>;">
                                        <input type="file" name="typeimage" id="typeimage" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                                    </div>
                                </div>                                
                            </div>


                            <a href="<?php echo base_url(); ?>producttype" class="btn bg-blue-grey waves-effect" onclick="return confirm('Are you sure cancel the data?')">Cancel</a>
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

                                    $('#producttypeform').validate({
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
                                            typename: {
                                                required: true,
                                                minlength: 3,
                                                maxlength: 150
                                            },
                                            product_id: {
                                                required: true
                                            },
                                            typeimage: {
                                                required: true,
                                                imagefilecheck: true
                                            }
                                        },
                                        messages: {
                                            typename: {
                                                required: "Please enter product type name"

                                            },
                                            product_id: {
                                                required: "Please choose product"

                                            },
                                            typeimage: {
                                                required: "Please choose image"

                                            }
                                        },
                                        submitHandler: function (form) {
                                            var formData = new FormData($('#producttypeform')[0]);
                                            formData.append('typeimage', $('input[type=file]')[0].files[0]);
                                            var $form = $("#producttypeform");
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
                                                    window.location = "<?php echo base_url() . 'producttype'; ?>";
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

                                    $.validator.addMethod("imagefilecheck", function (value, element) {
                                        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                                        if ($.inArray(value.split('.').pop().toLowerCase(), fileExtension) == -1) {
                                            return false;
                                        } else
                                        {
                                            return true;
                                        }
                                    }, "Please choose format type .jpg, .jpeg, .png, .gif, .bmp");
                                });
</script>