<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ob_start();
	require('../res/meta.php');

	$avatarID = $_REQUEST['avatarID'];
	$userID = $_REQUEST['uid'];

	if ($userID == $xID){
		$checkQuery = mysqli_query($connect, "SELECT * FROM userAvatars WHERE userID = '$userID' AND userAvatarID = '$avatarID'");
		$checkCount = mysqli_num_rows($checkQuery);
		if ($checkCount == 1){
			$updateQuery = mysqli_query($connect, "UPDATE userAvatars SET userAvatarSelected = '1' WHERE userID = '$userID' AND userAvatarID = '$avatarID'");
			if ($updateQuery){
				$clearQuery = mysqli_query($connect, "UPDATE userAvatars SET userAvatarSelected = '0' WHERE userAvatarID != '$avatarID'");
				if ($clearQuery){
					header("location: /member/details/avatar/?swapStatus=success");
				}
			} else {
				header("location: /member/details/avatar/?swapStatus=error");
			}
		} else {
			header("location: /member/details/avatar/?swapStatus=noavatar");
		}
	} else {
		header("location: /member/details/avatar/?swapStatus=userauth");
	}
?>