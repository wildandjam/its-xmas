<?php 
	require('../res/user.php');
	require('../res/connect.php');
	//deletefromcollection.php?listID=" . $deletelistid . "'>Remove from collection</a>
	$listID = $_REQUEST['listID'];
	$postID = $_REQUEST['postID'];
	
	$ownQuery = mysqli_query($connect, "SELECT * FROM collectionposts WHERE listID = '$listID' AND userID = '$id' AND postID = '$postID'");
	if (mysqli_num_rows($ownQuery) == 1){
		
			$deletequery = "DELETE FROM collectionposts WHERE listID = '$listID' AND userID = '$id' AND postID = '$postID'";
			$thisDelete = mysqli_query($connect, $deletequery);
			if ($thisDelete){
				header("location: /collection/?collectionid=" . $listID . "&status=deleteitemsuccess");
			} else {
				header("location: /collection/?collectionid=" . $listID . "&status=deleteitemfail");	
			}
	} else {
		if ($listID) {
			header("location: /collection/?collectionid=" . $listID . "&status=deleteitemfail");	
		} else {
			header("location: /member/my-christmas/");	
		}
		
	}
	
	
	
?>




