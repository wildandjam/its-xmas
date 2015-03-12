<?php require('../res/meta.php'); ?>
<title>Register | It's Christmas</title>
</head>

<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
	<div class="content">
        	<?php

$status = $_GET['status'];

if ($status == "success") {

	$remail = $_GET['email'];
	$ruser = $_GET['user'];

	echo "<div id='mainContent'><div align='center'>You have successfully registered, please check your e-mail to verify your account before <a href='login.php'>logging in</a>.<br /><br />
	
	Username:<strong> $ruser </strong><br />
	Email Address: <strong>$remail</strong> <br /><br />
	Thank you for registering,
	<br /><br />
	It's Christmas
	</div></div>";
} else {
?>
	<div class="content">
<?php

	$remail = $_GET['remail'];
	$ruser = $_GET['ruser'];
	$rterms = $_GET['rterms'];

	
	if ($status == "empty" or $status == "") {
		$msg = "Please fill in all the fields";
	} else if ($status == "connection" or $status == "database" or $status == "email"){
		$msg = 	"Unfortunately, there is an issue our end. Please <a href='/iC/contact-us/'>contact us</a>";
	} else if ($status == "registered"){
		$msg = 	"This e-mail address is already registered, have you <a href='iC/forgot-password/'>forgotten your password</a>?";
	} else if ($status == "username"){
		$msg = 	"Unfortunately this username is taken, please try again.";
	} else if ($status == "password"){
		$msg = 	"Your passwords do not match, please try again.";
	} else if ($status == "terms"){
		$msg = 	"To register, you need to read through the terms and conditions and then accept them.";
	}
	echo "<font style='color:red;font-size:12px;'><strong>";
	echo $msg;
	echo "</strong></font><br /><br />";
	require('../forms/register.php'); 
	echo "<div class='loginLinks'>Already registered? <a href='/login/'>Click here to log in</a></div>";
	echo "</div>";
	
}
?>
        

    </div>
</div>
<?php require('../res/sidebars.php'); ?>
</body>
</html>
