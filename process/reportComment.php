<?php
	require('../res/connect.php');
	require('../res/user.php');
	if (isset($id)){
		if ($id == $_REQUEST['userID']){
			$userID = $_REQUEST['userID'];
			$postID = $_REQUEST['postID'];
			$commentID = $_REQUEST['commentID'];
			$date = date("Y-m-d H:i:s");

			$reportQuerySelect = "SELECT * FROM commentreported WHERE commentID = '$commentID' AND userID = '$id' AND commentReportActioned = '1'";
			$reportQuery = mysqli_query($connect, $reportQuerySelect);
			if (mysqli_num_rows($reportQuery) == 1){
				echo "already moderated";
			} else {
				$insertQuery = mysqli_query($connect, "INSERT INTO commentreported VALUES ('','$id','$commentID','$date','','0','','')");
				if ($insertQuery){
					echo "Inserted";
				} else {
					echo "failed";
				}
			}
		}
	}
?>