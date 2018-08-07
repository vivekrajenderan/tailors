<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Staff                    
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
                        <form id="userform" method="POST" name="userform" action="<?php echo base_url() . 'users/ajaxsave/' . $id; ?>" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo isset($users_list[0]['firstname']) ? $users_list[0]['firstname'] : ''; ?>" required>
                                    <label class="form-label">First Name</label>
                                </div>
                            </div>                           
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo isset($users_list[0]['lastname']) ? $users_list[0]['lastname'] : ''; ?>" required>
                                    <label class="form-label">Last Name</label>
                                </div>
                            </div>                           
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="address" id="address" cols="30" rows="5" class="form-control no-resize" required><?php echo isset($users_list[0]['address']) ? $users_list[0]['address'] : ''; ?></textarea>
                                    <label class="form-label">Address</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="mobileno" id="mobileno" maxlength="10" value="<?php echo isset($users_list[0]['mobileno']) ? $users_list[0]['mobileno'] : ''; ?>" required>
                                    <label class="form-label">Mobile No</label>
                                </div>
                            </div>                           
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($users_list[0]['username']) ? $users_list[0]['username'] : ''; ?>" required>
                                    <label class="form-label">User Name</label>
                                </div>
                            </div>                  
                            <div class="form-group form-float">
                                <label class="form-label">Gender</label>
                                <div class="form-line">
                                    <input name="gender" type="radio" id="radio_1" <?php echo (isset($users_list[0]['gender']) && $users_list[0]['gender'] == "male") ? "checked" : ''; ?> value="male" required=""/>
                                    <label for="radio_1">Male</label>
                                    <input name="gender" type="radio" id="radio_2" <?php echo (isset($users_list[0]['gender']) && $users_list[0]['gender'] == "female") ? "checked" : ''; ?> value="female" required=""/>
                                    <label for="radio_2">Female</label>

                                </div>
                            </div>                  
                            <div class="form-group form-float">

                                <?php
                                $display = "";
                                if (isset($users_list[0]['userimage']) && !empty($users_list[0]['userimage'])) {
                                    $display = "none";
                                    if (file_exists("./upload/users/" . $users_list[0]['userimage'])) {
                                        $image_name = $users_list[0]['userimage'];
                                    } else {
                                        $image_name = "no_image.png";
                                    }
                                    ?>

                                    <div id='usershowimage'> 
                                        <img class="img-thumbnail" src="<?php echo base_url() . 'upload/users/' . $image_name; ?>" alt="" width="100" height="100"/>
                                        &nbsp;&nbsp;<a href="javascript:void(0);" onclick="RemoveImage();" class="btn bg-brown waves-effect" title="Delete Product">Remove</a>
                                    </div>

                                <?php } ?>
                                <div class="form-line">
                                    <div id="userimagecontent" style="padding-left: 5px;display:<?php echo $display; ?>;">
                                        <input type="file" name="userimage" id="userimage" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                                    </div>
                                </div>

                            </div>


                            <a href="<?php echo base_url(); ?>users" class="btn bg-blue-grey waves-effect" onclick="return confirm('Are you sure cancel the data?')">Cancel</a>
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
                                    $("#usershowimage").hide();
                                    $("#userimagecontent").show();
                                }
                                $(function () {

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
                                            firstname: {
                                                required: true,
                                                minlength: 3,
                                                maxlength: 150
                                            },
                                            lastname: {
                                                required: true,
                                                minlength: 3,
                                                maxlength: 150
                                            },
                                            address: {
                                                required: true,
                                                maxlength: 250,
                                            },
                                            gender: {
                                                required: true
                                            },
                                            mobileno: {
                                                required: true,
                                                digits: true,
                                                minlength: 10,
                                                maxlength: 10
                                            },
                                            username: {
                                                required: true,
                                                minlength: 3,
                                                maxlength: 150,
                                                existusername: true
                                            }
                                        },
                                        messages: {
                                            firstname: {
                                                required: "Please enter first name"

                                            },
                                            lastname: {
                                                required: "Please enter last name"

                                            },
                                            address: {
                                                required: "Please enter the address"

                                            },
                                            gender: {
                                                required: "Please choose the gender"

                                            },
                                            mobileno: {
                                                required: "Please enter mobile number"

                                            },
                                            username: {
                                                required: "Please enter user name"

                                            }
                                        },
                                        submitHandler: function (form) {
                                            var formData = new FormData($('#userform')[0]);
                                            formData.append('userimage', $('input[type=file]')[0].files[0]);
                                            var $form = $("#userform");
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
                                                    window.location = "<?php echo base_url() . 'users'; ?>";
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