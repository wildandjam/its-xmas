<?php 
	$pageID = 2;
	require("../res/connect.php");
	require('../res/meta.php'); 
	
	if (!$seoDone){	?>
		<title>Register | It's Christmas</title>
	<?php
	}
?>
<script>
  var RecaptchaOptions = { theme : 'clean' };
</script>
</head>

<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
	<div class="content registerContent">
    	<h1>Register</h1>
        	<?php

$status = $_GET['status'];

if ($status == "success") {

	$remail = $_GET['email'];
	$ruser = $_GET['user'];

	echo "<div id='mainContent'><div align='center'><p class='successMsg'>You have successfully registered, please check your e-mail to verify your account before <a href='/login/'>signing in to the Christmas Spirit</a>.</p><br />
			Username:<strong> $ruser </strong><br />
			Email Address: <strong>$remail</strong>
			</div></div>";
} else {
	$remail = $_GET['remail'];
	$ruser = $_GET['ruser'];
	$rterms = $_GET['rterms'];

	
	if ($status == "empty" or $status == "") {
		$msg = "<p>Please fill in all the fields</p>";
	} else if ($status == "connection" or $status == "database" or $status == "email"){
		$msg = 	"<p class=\"errorMsg\">The elves have eaten too many mince pies and something has gone wrong! Please try again.</p>";
	} else if ($status == "registered"){
		$msg = 	"<p class=\"errorMsg\">The elves already have your details on file - have you had too much eggnog and <a href='/forgotten-password/'>forgotten your password</a>?</p>";
	} else if ($status == "username"){
		$msg = 	"<p class=\"errorMsg\">Sorry, that username is just too popular, please try again.</p>";
	} else if ($status == "password"){
		$msg = 	"<p class=\"errorMsg\">Your passwords do not match, please try again.</p>";
	} else if ($status == "terms"){
		$msg = 	"<p class=\"errorMsg\">To register, you need to read through the terms and conditions and then accept them.</p>";
	} else if ($status == "recaptcha"){
		$msg = 	"<p class=\"errorMsg\">Sorry, the Recaptcha wasn't entered correctly. Please try again.</p>";
	}
	echo $msg;
	require('../forms/register.php'); 
	echo "<div class='loginLinks'><div><a href='/login/'>Already registered?</a></div></div>";
	
}
?>
        

    </div>
<?php require('../res/sidebars.php'); ?>
</div>
<?php require('../res/admin.php'); ?>
</body>
</html>
