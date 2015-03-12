<?php
require('../res/connect.php');
$name = $_REQUEST['email'];

$emailcheck = mysqli_query($connect, "SELECT * FROM users WHERE userEmail='$name'");
$ecount = mysqli_num_rows($emailcheck);
if ($ecount == 0){
	$usercheck = mysqli_query($connect, "SELECT * FROM users WHERE userName='$name'");
	$ucount = mysqli_num_rows($usercheck);
		if ($ucount == 0){
			header("Location: ../forgotten-password/?status=fail");
		} else {
			$username = $name;
			while($row = mysqli_fetch_assoc($usercheck)) {
				$email = $row['userEmail'];
			}
		}
} else {
	$email = $name;

}
if ($email){
	$reset = md5($email);
	require('../phpmailer/class.phpmailer.php'); 
	$mail = new PHPMailer(); 
	
	$mail->IsSMTP();
	$mail->Host = "smtp.netcetera.co.uk";
	$mail->SMTPAuth = true;
	$mail->Username = "admin@its-xmas.co.uk";
	$mail->Password = "genius029";
	
	$mail->From = "admin@its-xmas.co.uk";
	$mail->FromName = "It's Christmas";
	$mail->AddAddress($email);
	$mail->AddBCC("user@its-xmas.co.uk");
	$mail->IsHTML(true);
	$mail->Subject = "Forgotten Password | It's Christmas";
	$emailtype = "forgottenpassword";
	require('../emails/email.php');

	$mail->Body = $echoprintmsg;
	
	/*"
		To reset your password, please click on this link and follow the steps:
		<a href='http://www.its-xmas.co.uk/reset-password/?email=$email&resetcode=$reset'>
		http://www.its-xmas.co.uk/reset-password/?email=$email&resetcode=$reset
		</a>";*/
	$mail->Send();
	
	
	if ($mail) {
		header("Location: /forgotten-password/?status=success");
		
	} else {
		header("Location: /forgotten-password/?status=email");
	}


}
?>