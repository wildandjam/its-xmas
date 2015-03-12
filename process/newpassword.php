<?php 
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$rpassword = $_REQUEST['rpassword'];
	$reset = $_REQUEST['reset'];
	$memail = md5($email);
	
	if ($password == $rpassword){
		$mdpassword = md5($password);
		if ($reset == $memail){
			require('../res/connect.php');
			$passQuery = mysqli_query($connect, "SELECT * FROM users WHERE userEmail = '$email'");
			$passRows = mysqli_num_rows($passQuery);
			if ($passRows == "1"){
				$newPass = mysqli_query($connect,"UPDATE users SET userPassword = '$mdpassword' WHERE userEmail = '$email'");
				
				if ($newPass){
					header("location: /reset-password/?status=success");
				} else {
					header("location: /reset-password/?status=error&email=" . $email . "&resetcode=" . $reset);
				}			
			} else {
				header("location: /reset-password/?status=noaccount&email=" . $email . "&resetcode=" . $reset);
			}		
		} else {
			header("location: /reset-password/?status=incorrectreset&email=" . $email . "&resetcode=" . $reset);
		}	
	} else {
		header("location: /reset-password/?status=password&email=" . $email . "&resetcode=" . $reset);
	}

?>