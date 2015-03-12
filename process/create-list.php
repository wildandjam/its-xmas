<?php 
	require('../res/user.php');
		
		
	$listName = $_REQUEST['listName'];
	$listType = $_REQUEST['listType'];
	$listPrivacy = $_REQUEST['listPrivacy'];
	$date = date("Y-m-d");
	
	
	echo "ID: " . $id . "<br />";
	echo "List Name: " . $listName . "<br />";
	echo "List Type: " . $listType . "<br />";
	echo "Privacy: " . $listPrivacy . "<br />";
	
	if ($id){
		if ($listName && $listType){
			require("../res/connect.php");
			
			$listNameChecker = mysqli_query($connect, "SELECT * FROM userlist WHERE userID = '$id' AND userListName = '$listName'");
			echo "num rows: " . mysqli_num_rows($listNameChecker);
			if (mysqli_num_rows($listNameChecker) != 0){
				header("location: /member/create-list/?error=already&listName=" . $listName . "&listType=" . $listType . "&listPrivacy=" . $listPrivacy. "");
			} else {	
				echo "insertlistline";
				$insertList = mysqli_query($connect, "INSERT INTO userlist VALUES ('','$listName','$listType','$id', '$listPrivacy', '$date','')");
				if ($insertList){
					$listNameReChecker = mysqli_query($connect, "SELECT * FROM userlist WHERE userID = '$id' AND userListName = '$listName'");
					
					if (mysqli_num_rows($listNameReChecker) == 1){
						while ($listNameReCheckerRow = mysqli_fetch_array($listNameReChecker)){
							header("location: /list/?listID=" . $listNameReCheckerRow['userListID'] ."");	
						}
					} else {
						header("location: /member/create-list/?error=database&listName=" . $listName . "&listType=" . $listType . "&listPrivacy=" . $listPrivacy. "");	
					}
				} else {
					header("location: /member/create-list/?error=database&listName=" . $listName . "&listType=" . $listType . "&listPrivacy=" . $listPrivacy. "");
				}		
			}
		} else {
			header("location: /member/create-list/?error=missing&listName=" . $listName . "&listType=" . $listType . "&listPrivacy=" . $listPrivacy. "");
		}
	} else {//no user ID
		header("location: /login/");
	}
	

?>