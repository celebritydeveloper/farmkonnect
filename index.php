<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
    $user_login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtupass']);
    
    if($user_login->login($email,$upass))
    {
        $user_login->redirect('home.php');
    }
}
?>


<!DOCTYPE html>
<html>
    
<head>
        
        <!-- Title -->
        <title>FarmKonnect | Login - Sign in</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Farm Konnect Admin Dashboard" />
        <meta name="keywords" content="admin,dashboard,farm" />
        <meta name="author" content="Webtoonic Interactive" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.png">
        <link rel="icon" href="favicon.png" type="image/x-icon">
        
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        
        <!-- Theme Styles -->
        <link href="assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
        <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body class="page-login">
        <main class="page-content">
            <div class="page-inner">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-3 center">
                                    <?php 
                        if(isset($_GET['inactive']))
                        {
                            ?>
                            <div class='alert alert-error'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
                            </div>
                            <?php
                        }
                        ?>
                            <div class="login-box">
                                <a href="index.php" class="logo-name text-lg text-center">FarmKonnect Nigeria</a>
                                <p class="text-center m-t-md">Please login into your account.</p>
                                <form class="m-t-md" action="" method="POST">

                                  <?php
                                                 if(isset($_GET['error']))
                                                    {
                                                        ?>
                                                        <div class='alert alert-success'>
                                                            <button class='close' data-dismiss='alert'>&times;</button>
                                                            <strong>Wrong Details!</strong> 
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>

                                    <div class="form-group">
                                        <input type="email" class="form-control" name="txtemail" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="txtupass" placeholder="Password" required>
                                    </div>
                                    <button type="submit" name="btn-login" class="btn btn-success btn-block">Login</button>
                                    <a href="fpassword.php" class="display-block text-center m-t-md text-sm">Forgot Password?</a>
                                    <p class="text-center m-t-xs text-sm">Do not have an account?</p>
                                    <a href="register.php" class="btn btn-default btn-block m-t-md">Create an account</a>
                                </form>
                                <p class="text-center m-t-xs text-sm">2017 &copy; FarmKonnect by <a href="http://www.webtoonic.com" target="_blank"> Webtoonic Interactive.</a></p>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
	

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/pace-master/pace.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="assets/plugins/waves/waves.min.js"></script>
        <script src="assets/js/modern.min.js"></script>
        
    </body>

<!-- Mirrored from steelcoders.com/modern/admin3/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Oct 2017 20:21:05 GMT -->
</html>