<?php require('../res/meta.php'); ?>
<title>Authenticate your Account | It's Christmas</title>
</head>

<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
	<div id="pageHeader">
        <h1>Authenticate</h1>
        <?php require('../res/userPortal.php'); ?>
        
        <div class="clearfix"></div>
        <div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li>Authenticate your account</li>
            </ul>
        </div>
    </div>

	<?php

	$ruser = $_REQUEST['ruser'];
	$authcode = $_REQUEST['authcode'];
	if (isset($ruser)){
		$mduser = md5($ruser);
	}


if (isset($connect)){
	if ($authcode == $mduser) {
		$authCheck = mysqli_query($connect, "SELECT * FROM users WHERE userName='$ruser'");
		$authCount = mysqli_num_rows($authCheck);
		
		if ($authCount == 1){
			while($authRow = mysqli_fetch_assoc($authCheck)) {
				$auth = $authRow['userAuth'];
				$userID = $authRow['userID'];
				
				if ($auth === '0'){
					$updinf = mysqli_query($connect, "UPDATE users SET userAuth=1 WHERE userName='$ruser'");
					$createUDQ = "INSERT INTO userdetails VALUES ('','$userID','','','','1900-01-01 00:00','','7','#183051','#e8e8e8','','0')";
					$createUD = mysqli_query($connect,$createUDQ);
					
					if ($updinf){
						$status = "<p class='successMsg'>Your account has been authorised, please <a href='/login'>log in</a></p>";	
					} else {
						$status = "<p class='errorMsg'>Unfortunately, there has been an error authenticating your account, please <a href='/contact'>contact us</a></p>";
					}
				} else {
					$status = "<p class='successMsg'>Your account is already authenticated. Please <a href=\"/login\">log in</a></p>";
				}
			}
		} else {
			$status = "<p class='errorMsg'>Unfortunately, there has been an error authenticating your account, please <a href='/contact'>contact us</a></p>";
		}
	} else {
		$status = "<p class='errorMsg'>Unfortunately, there has been an error authenticating your account, please <a href='/contact'>contact us</a></p>";
	}
} else {
	$status = "<p class='errorMsg'>Unfortunately, there has been an error authenticating your account, please <a href='/contact'>contact us</a></p>";	
}
echo $status."<br />";
?>
</div>
<?php require('../res/gtm.php'); ?>
</body>
</html>