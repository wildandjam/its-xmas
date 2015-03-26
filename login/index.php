<?php
//Connect to database
require('../res/connect.php');
if ($_REQUEST){
	$lname = $_REQUEST['lname'];
	$lpass = $_REQUEST['lpass'];
	$pass = md5($lpass);
}

require('../res/user.php');
$msg = '';
if ($_POST) {
	if (isset($connect)) {
	// check if email is in database
	$emailcheck = mysqli_query($connect, "SELECT * FROM users WHERE userEmail='$lname'");
	$ecount = mysqli_num_rows($emailcheck);
		if ($ecount == 0){
			$usercheck = mysqli_query($connect, "SELECT * FROM users WHERE userName='$lname'");
			$ucount = mysqli_num_rows($usercheck);
				if ($ucount == 0){
					$msg =  "<p class=\"errorMsg\">Sorry, the elves don't recgonise your email address or username - have you tried <a href='/register'>registering</a>?</p>";
				} else {
				// check password
					$check = mysqli_query($connect, "SELECT * FROM users WHERE userName='$lname' AND userPassword='$pass'");
					$count = mysqli_num_rows($check);
					if ($count != 1) {
						$msg =  "<p class=\"errorMsg\">Have you been drinking too much eggnog? Your password doesn't match the username of email address. Have another go.</p>";
					} else {
						while($row = mysqli_fetch_assoc($check)) {
							$auth = $row['userAuth'];
							$uid = $row['userID'];
						}
						if ($auth == "0"){
							$msg = "<p class=\"errorMsg\">oops - the elves have sent you an authorisation email - please check your emails and follow the intructions.</p>";
						} else {
							setcookie('id',$uid, time() + (10 * 365 * 24 * 60 * 60), "/");
							$_SESSION['id']=$uid;
							
							mysqli_query($connect, "INSERT INTO log VALUES ('','$uid', 'date(\"Y-m-d H:i:s\")')");
							header("Location: /member/my-christmas/");
							
						}
					}
				}
		} else {
			//check password
			$check = mysqli_query($connect, "SELECT * FROM users WHERE userEmail='$lname' AND userPassword='$pass'");
			$count = mysqli_num_rows($check);
			if ($count != 1) {
				$msg =  "<p class=\"errorMsg\">Have you been drinking too much eggnog? Your password doesn't match the username of email address. Have another go.</p>";
			} else {
				while($row = mysqli_fetch_assoc($check)) {
					$auth = $row['userAuth'];
					$uid = $row['userID'];
				}
				if ($auth == "0"){
					$msg = "<p class=\"errorMsg\">Oops - the elves have sent you an authorisation email - please check your emails and follow the intructions.</p>";
				} else {
					setcookie('useremail',$lname, time() + (10 * 365 * 24 * 60 * 60) , "/");
					session_start();
					$_SESSION['useremail']=$lname;
					
					mysqli_query($connect, "INSERT INTO log VALUES ('','$uid', 'date(\"Y-m-d H:i:s\"')");
					header("Location: /member/my-christmas/");
				}
			}
		}
	} else {
		$msg =  "<p class=\"errorMsg\">The elves have eaten too many mince pies and something has gone wrong. Please try again.</p>";
	}
} else {
	$msg = "<p class='normal'>Please let the elves have your details below:</p>";
}
?>
<?php 
	$pageID = 1;
	require('../res/meta.php'); 
	
	if (!$seoDone){	?>
		<title>Sign in to the Christmas spirit | It's Christmas</title>
	<?php
	}
?>

</head>

<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
	<div id="pageHeader">
        <h1 class="small">Sign in to the Christmas spirit</h1>
        <?php require('../res/userPortal.php'); ?>
        <div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li>Sign in</li>
            </ul>
        </div>
    </div>
	<div class="content login">
   		
		<?php echo $msg; 
		
		require('../forms/login.php'); ?>
	</div>
	<?php require('../res/sidebars.php'); ?>
</div>
<?php require('../res/admin.php'); ?>
</body>
</html>