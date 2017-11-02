<?php
session_start();
require_once 'class.user.php';
$user = new USER();

if($user->is_logged_in()!="")
{
    $user->redirect('home.php');
}

if(isset($_POST['btn-submit']))
{
    $email = $_POST['txtemail'];
    
    $stmt = $user->runQuery("SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1");
    $stmt->execute(array(":email"=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);  
    if($stmt->rowCount() == 1)
    {
        $id = base64_encode($row['userID']);
        $code = md5(uniqid(rand()));
        
        $stmt = $user->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email");
        $stmt->execute(array(":token"=>$code,"email"=>$email));
        
        $message= "
                   Hello , $email
                   <br /><br />
                   We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore                   this email,
                   <br /><br />
                   Click Following Link To Reset Your Password 
                   <br /><br />
                   <a href='http://localhost/x/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
                   <br /><br />
                   thank you :)
                   ";
        $subject = "Password Reset";
        
        $user->send_mail($email,$message,$subject);
        
        $msg = "<div class='alert alert-success'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    We've sent an email to $email.
                    Please click on the password reset link in the email to generate new password. 
                </div>";
    }
    else
    {
        $msg = "<div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Sorry!</strong>  this email not found. 
                </div>";
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
                      
                            <div class="login-box">
                                <a href="index.php" class="logo-name text-lg text-center">FarmKonnect Nigeria</a>
                                <p class="text-center m-t-md">Forgot Password</p>
                                <form class="m-t-md" action="" method="POST">

                                                     <?php
                                if(isset($msg))
                                {
                                    echo $msg;
                                }
                                else
                                {
                                    ?>
                                    <div class='alert alert-info'>
                                    Please enter your email address. You will receive a link to create a new password via email.!
                                    </div>  
                                    <?php
                                }
                                ?>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="txtemail" placeholder="Email" required>
                                    </div>
                                    
                                    <button type="submit" name="btn-submit" class="btn btn-success btn-block">Generate New Password</button>
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