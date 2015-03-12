<?php 
	require('../res/user.php');
	require('../res/connect.php');
	
	$view = $_REQUEST['view'];
	$from = $_REQUEST['from'];
	$perPage = $_REQUEST['perPage'];
	
	if ($id){
		$viewQ = mysqli_query($connect, "SELECT * FROM preferences WHERE userID = '$id'");
		$viewQCount = mysqli_num_rows($viewQ);
		if ($viewQCount == 1){
			//update
			echo "update";
			mysqli_query($connect, "UPDATE preferences SET viewID='$view', perPage='$perPage' WHERE userID = '$id'");
			header("location: $from");
		} else {
			$viewInsert = mysqli_query($connect, "INSERT INTO preferences VALUES ('','$id','$view', '$perPage','days')");
			header("location: $from");
		}
	} else {
		$_SESSION['perPage']=$perPage;
		$_SESSION['view']=$view;
		header("location: $from");
	} 
	

?>