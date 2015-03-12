<?php
	require('../res/connect.php');
	$userID = $_REQUEST['admin'];
	$pageID = $_REQUEST['pageID'];
	$title = mysqli_real_escape_string($connect, $_REQUEST['seoTitle']);
	$desc = mysqli_real_escape_string($connect, $_REQUEST['seoDesc']);
	$keywords = mysqli_real_escape_string($connect, $_REQUEST['seoKeywords']);
	$image = mysqli_real_escape_string($connect, $_REQUEST['seoImage']);
	$seoCheck = mysqli_query($connect, "SELECT * FROM seo WHERE pageID = '$pageID'");
	$seoCount = mysqli_num_rows($seoCheck);
	$pageURL = $_REQUEST['pageURL'];

	if ($seoCount == 1){
		$updateSEO = mysqli_query($connect, "UPDATE seo SET pageTitle = '$title', pageDescription = '$desc', pageKeywords = '$keywords', pageImage = '$image' WHERE pageID = '$pageID'") or die(mysqli_error($connect));
		if ($updateSEO){
			header("location: " . $pageURL . "?metaUpdate=success");
		} else {
			header("location: " . $pageURL . "?metaUpdate=fail");
		}	
	} else {
		$insertSEO = mysqli_query($connect, "INSERT INTO seo VALUES ('','$pageID','$title', '$desc', '$keywords', '$image')") or die(mysqli_error($connect));
		if ($insertSEO){
			header("location: " . $pageURL . "?metaUpdate=success");
		} else {
			header("location: " . $pageURL . "?metaUpdate=fail");
		}		
	}
	
	
?>