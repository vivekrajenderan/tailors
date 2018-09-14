<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Sign In Tailor</title>
        <!-- Favicon-->
        <link rel="icon" href="../../favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="<?php echo base_url() . 'assets/font/font.css'; ?>" rel="stylesheet">
        <link href="<?php echo base_url() . 'assets/font/fontfamily.css'; ?>" rel="stylesheet">
        <!-- Bootstrap Core Css -->
        <link href="<?php echo base_url() . 'assets/plugins/bootstrap/css/bootstrap.css'; ?>" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="<?php echo base_url() . 'assets/plugins/node-waves/waves.css'; ?>" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="<?php echo base_url() . 'assets/plugins/animate-css/animate.css'; ?>" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="<?php echo base_url() . 'assets/css/style.css'; ?>" rel="stylesheet">
        <script>var base_url = '<?php echo base_url() ?>';</script>
    </head>

    <body class="login-page">
        <div class="login-box">
            <div class="logo">
                <a href="javascript:void(0);"><b>SS TAILOR</b></a>
                <small>Gen IT Design</small>
            </div>
            <div class="card">
                <div class="body">
                    <div class="alert bg-red" style="display:none;">
                        
                    </div>
                    <form id="sign_in" method="post" autocomplete="off" action="<?php echo base_url() . 'login/ajax_check'; ?>">
                        <div class="msg">Sign in to start your session</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 p-t-5">
                                <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                                <label for="rememberme">Remember Me</label>
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>

        <!-- Jquery Core Js -->
        <script src="<?php echo base_url() . 'assets/plugins/jquery/jquery.min.js'; ?>"></script>

        <!-- Bootstrap Core Js -->
        <script src="<?php echo base_url() . 'assets/plugins/bootstrap/js/bootstrap.js'; ?>"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="<?php echo base_url() . 'assets/plugins/node-waves/waves.js'; ?>"></script>

        <!-- Validation Plugin Js -->
        <script src="<?php echo base_url() . 'assets/plugins/jquery-validation/jquery.validate.js'; ?>"></script>

        <!-- Custom Js -->
        <script src="<?php echo base_url() . 'assets/js/admin.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/pages/examples/sign-in.js'; ?>"></script>
    </body>

</html>