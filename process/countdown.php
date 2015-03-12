<?php 
	require('../res/user.php');
	require('../res/meta.php'); 
	$type = $_REQUEST['type'];
	$name = $_REQUEST['name'];
	
	if ($id){
		require('../res/connect.php');
		$rowCheck = mysqli_query($connect, "SELECT * FROM preferences WHERE userID = '$name'");
		if (mysqli_num_rows($rowCheck) == 1){
			$mysqliQuery = "UPDATE preferences SET countdownType = '$type' WHERE userID = '$name'";
		} else {
			$mysqliQuery = "INSERT INTO preferences VALUES ('','$id','1','25','$type')";
		}		
		$pushQuery = mysqli_query($connect, $mysqliQuery);
		if ($pushQuery){
			header("location: /countdown?update=success");
		} else {
			header("location: /countdown?update=unsuccessful");
		}
	} else {
		header("location: /countdown/?type=" . $type);
		
	}
?>