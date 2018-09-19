<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Change Password                    
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Change Password</h2>                        
                    </div>
                    <div class="body">
                        <div class="alert bg-red" style="display:none;">

                        </div>
                        <?php if ($this->session->flashdata('SucMessage') != '') {
                            ?>
                            <div class="alert bg-green alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?php echo $this->session->flashdata('SucMessage'); ?>
                            </div>                            
                        <?php } ?>
                        <form id="userform" method="POST" name="userform" action="<?php echo base_url() . 'users/ajaxchangepassword/'; ?>">
                            <div class="input-group form-group form-float">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock</i>
                                </span>
                                <div class="form-line">
                                    <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="input-group form-group form-float">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock</i>
                                </span>
                                <div class="form-line">
                                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required>
                                </div>
                            </div>

                            <button class="btn btn-primary waves-effect" type="submit">Update</button>
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
                newpassword: "required",
                confirmpassword: {
                    equalTo: "#newpassword"
                }
            },
            messages: {
                newpassword :" Enter Password",
    		confirmpassword :" Enter Confirm Password Same as Password"
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
                        window.location = "<?php echo base_url() . 'users/changepassword'; ?>";
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