<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));

	$stmt = $reg_user->runQuery("SELECT * FROM farmkonnect_members WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if($stmt->rowCount() > 0)
	{
		$msg = "
              <div class='alert alert-error'>
                <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Sorry !</strong>  email allready exists , Please Try another one
              </div>
              ";
	}
	else
	{
		if($reg_user->register($uname,$email,$upass,$code))
		{
			$id = $reg_user->lasdID();
			$key = base64_encode($id);
			$id = $key;

			$message = '                    
                        Hello '.$uname.',
                        <br /><br />
                        Welcome to Coding Cage!<br/>
                        To complete your registration  please , just click following link<br/>
                        <br /><br />
                        <a href="http://localhost/x/verify.php?id='.$id.'&code='.$code.'">Click HERE to Activate :)</a>
                        <br /><br />
                        Thanks,';

			$subject = "Confirm Registration";

			$reg_user->send_mail($email,$message,$subject);
			$msg = "
                    <div class='alert alert-success'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account. 
                    </div>
                    ";
		}
		else
		{
			echo "sorry , Query could no execute...";
		}
	}
}
?>





<!DOCTYPE html>
<html>

<head>

	<!-- Title -->
	<title>FarmKonnect | Sign Up - Login</title>

	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta charset="UTF-8">
	<meta name="description" content="Admin Dashboard Template" />
	<meta name="keywords" content="admin,dashboard" />
	<meta name="author" content="Steelcoders" />

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
<body class="page-register">
<main class="page-content">
	<div class="page-inner">
		<div id="main-wrapper">
			<div class="row">
				<div class="col-md-3 center">
					<div class="login-box">
						<a href="index.php" class="logo-name text-lg text-center">FarmKonnect NIgeria</a>
						<p class="text-center m-t-md">Create a FarmKonnect account</p>
						<form class="m-t-md" method="POST">
							<div class="form-group">
								<input type="text" name="txtuname" class="form-control" placeholder="Name" required>
							</div>
							<div class="form-group">
								<input type="email" name="txtemail" class="form-control" placeholder="Email" required>
							</div>
							<div class="form-group">
								<input type="password" name="txtpass" class="form-control" placeholder="Password" required>
							</div>
							<label>
								<input type="checkbox"> Agree the terms and policy
							</label>
							<button type="submit" name="btn-signup" class="btn btn-success btn-block m-t-xs">Submit</button>
							<p class="text-center m-t-xs text-sm">Already have an account?</p>
							<a href="index.php" class="btn btn-default btn-block m-t-xs">Login</a>
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

<!-- Mirrored from steelcoders.com/modern/admin3/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Oct 2017 20:26:03 GMT -->
</html>
