<?php
session_start();
require('../res/user.php');
require('../res/connect.php');
$listID = $_REQUEST['listID'];
$muser = $_REQUEST['id'];
if ($id){
	if (md5($id) == $muser){
		$listQuery = mysqli_query($connect, "SELECT * FROM userlist WHERE userListID = '$listID' AND userID = '$id'");
		if (mysqli_num_rows($listQuery) == 1){
			$removeQuery = mysqli_query($connect, "DELETE FROM userlist WHERE userListID = '$listID' AND userID='$id'");
			if ($removeQuery){
				header("location: /member/my-christmas/");
			} else {
				header("location: /list/?listid=" . $listID . "&error=error");
			}

		} else {
			header("location: /list/?listid=" . $listID . "&error=error");
		}
	} else {
		header("location: /list/?listid=" . $listID . "&error=error");	
	}
} else {
	header("location: /login/");	
}

?>