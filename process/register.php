<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

//Register form - if unsuccessful, send to static page


//Connect to database
require_once('../res/connect.php');
$remail = $_POST['r-email'];
$ruser = $_POST['r-user'];
$rpass = strtolower(strip_tags($_POST['r-pass']));
$repass = strtolower(strip_tags($_POST['re-pass']));
if ($_POST['r-terms']){
	$rterms = $_POST['r-terms'];
}
require_once('../res/recaptchalib.php');
$privatekey = "6LfH0e8SAAAAAJKcjMLFwzpve9SX7rOyaS3D3r2Y";
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
	header("Location: ../register/?status=recaptcha&remail=$remail&ruser=$ruser&rterms=$rterms");
} else {
	if ($remail&&$ruser&&$rpass) {
		if ($connect) {
		// check if email is in database
		$emailcheck = mysqli_query($connect, "SELECT * FROM users WHERE userEmail='$remail'");
		$ecount = mysqli_num_rows($emailcheck);
		if ($ecount==0) {
			//check if username is used	
			$usernamecheck = mysqli_query($connect, "SELECT * FROM users WHERE userName='$ruser'");
			$ucount = mysqli_num_rows($usernamecheck);
			if ($ucount==0)
			{ 
				//check if passwords match
				if ($rpass == $repass) {
						//check if terms have been ticked
						if ($rterms == "1") {
							$rpass = md5($rpass);
							//Input to database and send e-mail
							
							
							$queryreg = mysqli_query($connect, "INSERT INTO users VALUES ('','$remail','$ruser','$rpass','$rterms','0','0','','0')");
							if ($queryreg) {
								
								$authcode = md5($ruser);
								require('../phpmailer/class.phpmailer.php'); 

								$mail = new PHPMailer(); 
								
								$mail->IsSMTP();
								$mail->Host = "smtp.netcetera.co.uk";
								$mail->SMTPAuth = true;
								$mail->Username = "admin@its-xmas.co.uk";
								$mail->Password = "genius029";
								
								$mail->From = "admin@its-xmas.co.uk";
								$mail->FromName = "It's Christmas";
								$mail->AddAddress($remail);
								$mail->AddBCC("user@its-xmas.co.uk");
								$mail->IsHTML(true);
								$mail->Subject = "Welcome | It's Christmas";
								$emailtype = "register";
								require('../emails/email.php');
								
								$mail->Body = $echoprintmsg;
								$mail->Send();
								
								if ($mail) {
									header("Location: ../register/?status=success&email=$remail&user=$ruser");
									
								} else {
									header("Location: ../register/?status=email&remail=$remail&ruser=$ruser&rterms=$rterms");
								}
							} else {
								header("Location: ../register/?status=database&remail=$remail&ruser=$ruser&rterms=$rterms");
							}
						} else {
							header("Location: ../register/?status=terms&remail=$remail&ruser=$ruser&rterms=$rterms");
						}
				} else {
					header("Location: ../register/?status=password&remail=$remail&ruser=$ruser&rterms=$rterms");			
					}
			} else {
				header("Location: ../register/?status=username&remail=$remail&ruser=$ruser&rterms=$rterms");	
			}
		} else {
			header("Location: ../register/?status=registered&remail=$remail&ruser=$ruser&rterms=$rterms");	
		}
	} else {
		header("Location: ../register/?status=connection&remail=$remail&ruser=$ruser&rterms=$rterms");
	}
	} else {
		header("Location: ../register/?status=empty&remail=$remail&ruser=$ruser&rterms=$rterms");
	}
}




?>