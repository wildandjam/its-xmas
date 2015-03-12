<?php
$reasonReport = $_REQUEST['reasonReport'];
$reporterID = $_REQUEST['reporterID'];
$reportedPost = $_REQUEST['reportedPost'];
$reportedPoster = $_REQUEST['reportedPoster'];
$reportDateTime = date('Y-m-d H:i');

echo $reportFrom;

require_once('../res/connect.php');
$reportQuery = mysqli_query($connect, "SELECT * FROM reported WHERE reporterID = '$reporterID' AND postID = '$reportedPost'");
$reportCount = mysqli_num_rows($reportQuery);

echo $reportCount;

if ($reportCount == 0){
	require('../phpmailer/class.phpmailer.php'); 
	if ($reportCount > 2){
		$hideQuery = mysqli_query($connect, "UPDATE posts SET postModerated = '1' WHERE postID = '$reportedPost'");
		$mail = new PHPMailer(); 
		
		$mail->IsSMTP();
		$mail->Host = "smtp.netcetera.co.uk";
		$mail->SMTPAuth = true;
		$mail->Username = "admin@its-xmas.co.uk";
		$mail->Password = "genius029";
		
		$mail->From = "admin@its-xmas.co.uk";
		$mail->FromName = "It's Christmas";
		$mail->AddAddress("admin@its-xmas.co.uk");
		$mail->AddBCC("user@its-xmas.co.uk");
		$mail->IsHTML(true);
		$mail->Subject = "Report | It's Christmas";
		$emailtype = "reportImportant";
		require('../emails/email.php');
		
		$mail->Body = $echoprintmsg;
		$mail->Send();
		
		if ($mail) {
			$insert = true;
			
		} else {
			$insert = false;
		}
			
	} else {
		$mail = new PHPMailer(); 
		
		$mail->IsSMTP();
		$mail->Host = "smtp.netcetera.co.uk";
		$mail->SMTPAuth = true;
		$mail->Username = "admin@its-xmas.co.uk";
		$mail->Password = "genius029";
		
		$mail->From = "admin@its-xmas.co.uk";
		$mail->FromName = "It's Christmas";
		$mail->AddAddress("admin@its-xmas.co.uk");
		$mail->AddBCC("user@its-xmas.co.uk");
		$mail->IsHTML(true);
		$mail->Subject = "Report | It's Christmas";
		$emailtype = "report";
		require('../emails/email.php');
		
		$mail->Body = $echoprintmsg;
		$mail->Send();
		
		if ($mail) {
			$insert = true;
			
		} else {
			$insert = false;
		}	
	}
	
	if ($insert == true){
		$insertReport = mysqli_query($connect, "INSERT INTO reported VALUES ('','$reportedPost','$reportedPoster','$reporterID','$reasonReport','$reportDateTime','', '', '' ,'')");

		if ($insertReport){
			header("location: http://www.its-xmas.co.uk/member/my-christmas/?reporting=successful");
			// Success
		} else {
			header("location: http://www.its-xmas.co.uk/member/my-christmas/?reporting=unsuccessful");
			//Insert error
		}
	} else {
		header("location: http://www.its-xmas.co.uk/member/my-christmas/?reporting=brokenemail");
		//Email issue
	}
} else {
	header("location: http://www.its-xmas.co.uk/member/my-christmas/?reporting=successful");
} 



?>