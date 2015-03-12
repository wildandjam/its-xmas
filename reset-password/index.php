<?php require('../res/meta.php'); ?>
<title>Reset your Password | It's Christmas</title>
</head>
<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
	<div class="content">
    	<h1>Reset your password</h1>
		<?php 
        $email = $_REQUEST['email'];
        $reset = $_REQUEST['resetcode'];
        $mdemail = md5($email);
		$status = $_REQUEST['status'];
		$showform = true;
		if ($status) {
			switch ($status){
				case "success":
					$pagemsg = "<p class='successMsg'>Your password has been changed!</p>";
					$showform = false;	
					break;
				case "error":
					$pagemsg = "<p class='errorMsg'>There has been an error changing your password, please <a href='/contact/'>contact us</a></p>";
					break;
				case "noaccount":
					$pagemsg = "<p class='errorMsg'>Sorry, the elves don't have those details on file. If you think they've made a mistake, please <a href='/contact'>let Santa know</a>!</p>";
					break;
				case "incorrectreset":
					$pagemsg = "<p class='errorMsg'>Sorry, the elves don't have those details on file. If you think they've made a mistake, please <a href='/contact'>let Santa know</a>!</p>";
					break;
				case "password":
					$pagemsg = "<p class='errorMsg'>Your passwords do not match, please try again.</p>";
				default:
					break;		
			}
		}
		if ($showform == true){
       	 if ($mdemail == $reset){
				if (!$pagemsg){
					echo "<p>Please enter a new password below</p>";
				} else {
					echo $pagemsg;
				}
				?>
				<form id="newpassword" name="newpassword" method="post" action="/process/newpassword.php">	
					<input type="password" name="password" id="password" placeholder="New password" autofocus/>
					<input type="password" name="rpassword" id="rpassword" placeholder="Repeat new password" />
					<input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
					<input type="hidden" name="reset" id="reset" value="<?php echo $reset ?>" />
					<input type="submit" value="Create new password" />
				</form>
				<?php
			} else {
	            echo "<p class='errorMsg'>Sorry, the elves don't have those details on file. If you think they've made a mistake, please <a href='/contact'>let Santa know</a>!</p>";
	        } 
		} else {
			echo "<p class='successMsg'>Your password has been changed!</p>";
        }
        ?>
    </div>
</div>
<?php require('../res/sidebars.php'); ?>
</body>
</html>
