<?php
	session_start();
	require('../res/connect.php');
	require('../res/user.php');
	$listID = $_REQUEST['listID'];
	print_r($_REQUEST);
	echo "<br />";
	echo "<br />";
	$number = ((count($_REQUEST)/6)*2);
	$listMode = $_REQUEST['listMode'];
	$updateView = mysqli_query($connect, "UPDATE userlist SET userMode = '$listMode' WHERE userListID = '$listID'");

	for ($i = 1; $i < $number; $i++){
		echo $i . "<br />";
		$name = mysqli_real_escape_string($connect, $_REQUEST["entry" . $i . "Name"]);
		$entryID = $_REQUEST["entry" . $i . "id"];
		if ($name != ""){
			if (array_key_exists("entry" . $i . "Name",($_REQUEST))){
				$relationship  = 0;
				$type =  0;
				$url = 0;
				$price = 0;
				$purchased = 0;
				$delivered = 0;
				$received = 0;
				
				$personquery = mysqli_query($connect, "SELECT * FROM userlistcard WHERE cardID = '$entryID'");
				$relationship  = mysqli_real_escape_string($connect, $_REQUEST["entry" . $i . "Relationship"]);
				$type =  mysqli_real_escape_string($connect, $_REQUEST["entry" . $i . "CardType"]);
				$url =  mysqli_real_escape_string($connect, $_REQUEST["entry" . $i . "Url"]);
				$formprice =  mysqli_real_escape_string($connect,$_REQUEST["entry" . $i . "Price"]);
   				$price = preg_replace("/[^0-9,.]/", "", $formprice);
				echo "Price: " .$price;
				
				$purchased =  isset($_REQUEST["entry" . $i . "purchased"]);
				$delivered = isset($_REQUEST["entry" . $i . "delivered"]);
				$received =  isset($_REQUEST["entry" . $i . "received"]);
				$date = date("Y-m-d H:i:s");
				
				if (mysqli_num_rows($personquery) == 0){
					$query = "INSERT INTO userlistcard VALUES ('','$listID','$id', '$name','$relationship','$type','$url','$price','$purchased','$delivered','$received','$date')";
					
				} else {
					$query = "UPDATE userlistcard SET cardReceiver = '$name', cardRelationship = '$relationship', cardType = '$type', cardURL = '$url', cardPrice = '$price', cardPurchased = '$purchased', cardDelivered = '$delivered', cardReceived = '$received', rowUpdated = '$date' WHERE cardID = '$entryID'";
				}
				
				echo $query;
				echo "<br />";
				echo "<br />";
				$runQuery = mysqli_query($connect, $query);

				
						
			} else {
				header("location: /list/?listid=" . $listID . "");			
			}
		} else {
		}
		echo "here";
		header("location: /list/?listid=" . $listID);	
	}
?>