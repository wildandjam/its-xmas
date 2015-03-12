<?php 
	if (isset($id)){
		$adminCheck = mysqli_query($connect, "SELECT * FROM admin WHERE userID = '$id'");
		$adminRows = mysqli_num_rows($adminCheck);
		if ($adminRows == 0){
			header("location: /");
		}
	} else {
		header("location: /");
	}
?>
<link href="/res/style/admin.css" rel="stylesheet" />
 <meta name="robots" content="noindex, nofollow" />