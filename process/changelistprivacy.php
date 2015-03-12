<?php
	require('../res/user.php');
	require('../res/connect.php');
	$urlid = $_REQUEST['userid'];
	$listid = $_REQUEST['listID'];
	$andlist = $_REQUEST['andlist'];
	$make = $_REQUEST['make'];

 	if ($andlist == md5($urlid) . md5($listid)){
		if ($id == $urlid){
			if ($make == "public"){
				$makeid = '0';	
			} else {
				$makeid = '1';
			}
			
			$updateQuery = mysqli_query($connect, "UPDATE userlist SET userListPrivate = '$makeid' WHERE userListID = '$listid' AND userID='$id'");
			if ($updateQuery){
				header("location: /list/?listid=" . $listid . "&privacystatus=success");
			} else {
				echo "UPDATE userlist SET userListPrivate = '$makeid' WHERE userListID = '$listid' AND userID='$id'";
				die();
				header("location: /list/?listid=" . $listid . "&privacystatus=query");
			}
			
		} else {
			header("location: /list/?listid=" . $listid . "&privacystatus=user");
		}
	} else {
		header("location: /list/?listid=" . $listid . "&privacystatus=nomatch");
	}

?>