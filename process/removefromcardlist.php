<?php
	session_start();
	require('../res/connect.php');
	require('../res/user.php');
	$listID = $_REQUEST["listid"];
	$cardID = $_REQUEST["cardid"];
	
	
	if ($id){
		$checkQuery = "SELECT * FROM userlistcard WHERE cardID = '$cardID' AND userID = '$id'";
		echo $checkQuery;
		$checkRow = mysqli_query($connect, $checkQuery);
		if (mysqli_num_rows($checkRow) == 1){
			$deleteRow = mysqli_query($connect, "DELETE FROM userlistcard WHERE cardID = '$cardID' AND userID = '$id'");
		}		
	}
	echo "<br /><br />";
	print_r($_REQUEST);
	
	header ("location: /list/?listid=" . $listID . "");

	
	
?>