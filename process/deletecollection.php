<?php 
	require('../res/user.php');
	require('../res/connect.php');
	
	$deleteid = $_REQUEST['deleteid'];
	$deletecode = $_REQUEST['deletecode'];
	
	$ownQuery = mysqli_query($connect, "SELECT * FROM collections WHERE listID = '$deleteid' AND userID = '$id'");
	if (mysqli_num_rows($ownQuery) == 1){
		if ($deletecode == md5($deleteid)){
			$deletequery = "DELETE FROM collections WHERE listID = '$deleteid' AND userID = '$id'";
			$thisDelete = mysqli_query($connect, $deletequery);
			if ($thisDelete){
				$updateOthers = mysqli_query($connect, "UPDATE collections SET listParentID = '0' WHERE listParentID = '$deleteid'");
				header("location: /member/collections/?status=deletesuccess");
			} else {
				header("location: /collection/?collectionid=" . $deleteid . "&status=deletefail");	
			}
		} else {
			if ($deleteid) {
				header("location: /collection/?collectionid=" . $deleteid . "&status=deletefail");	
			} else {
				header("location: /member/my-christmas/");	
			}
		}
		
	} else {
		if ($deleteid) {
			header("location: /collection/?collectionid=" . $deleteid . "&status=deletefail");	
		} else {
			header("location: /member/my-christmas/");	
		}
		
	}
	
	
	
?>




