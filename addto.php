<?php
	require('../res/user.php');
	require('../res/connect.php');
	$listID = $_REQUEST['listID'];
	print_r($_REQUEST);
	echo "<br />";
	echo "<br />";
	$number = (count($_REQUEST));
	$listMode = $_REQUEST['listMode'];
	$updateView = mysqli_query($connect, "UPDATE userlist SET userMode = '$listMode' WHERE userListID = '$listID'");
	echo "<br /><br />";
	
	
	for ($i = 1; $i < $number; $i++){
		$name = mysqli_real_escape_string($connect, $_REQUEST["entry" . $i . "name"]);
		$entryID = $_REQUEST["entry" . $i . "person"];
		echo $entryID . " <br />";
		if ($name != ""){
			if (array_key_exists("entry" . $i . "name",($_REQUEST))){
				$relationship  = 0;
				$budget =  0;

				
				$personquery = mysqli_query($connect, "SELECT * FROM userlistfor WHERE userItemForID = '$entryID'");
				$relationship  = mysqli_real_escape_string($connect, $_REQUEST["entry" . $i . "relationship"]);
				$formbudget =  mysqli_real_escape_string($connect, $_REQUEST["entry" . $i . "budget"]);
				$budget = preg_replace("/[^0-9,.]/", "", $formbudget);
				
				echo "<h2>" . $name . "</h2><br/>";
				echo $relationship;
				echo "<br />";
				echo $budget;
				
				
				/*$bought =  isset($_REQUEST["entry" . $i . "bought"]);
				$wrapped =  isset($_REQUEST["entry" . $i . "wrapped"]);
				$delivered = isset($_REQUEST["entry" . $i . "delivered"]);
				$received =  isset($_REQUEST["entry" . $i . "received"]);*/
				$date = date("Y-m-d H:i:s");
				
				if (mysqli_num_rows($personquery) == 0){
					echo "INSERT";
//					$query = "INSERT INTO userlistfor VALUES ('','$listID','$id', '$name','$relationship','$budget','$bought','$wrapped','$delivered','$received','$date')";
					
				} else {
					echo "UPDATE";
					//$query = "UPDATE userlistfor SET userItemForPerson = '$name', userItemRelationship = '$relationship', userItemForBudget = '$budget', userItemForBought = '$bought', userItemForWrapped = '$wrapped', userItemForDelivered = '$delivered', userItemForReceived = '$received', userItemForDate = '$date' WHERE userItemForID = '$entryID'";
				}
				
				echo "<br />";
				echo "<br />";
				$runQuery = mysqli_query($connect, $query) or mysqli_error($connect);
				if ($runQuery){
					for ($j = 1; $j < $number; $j++){
						if (array_key_exists("entry" . $i . "Row" . $j . "Item",($_REQUEST)) || array_key_exists("entry" . $i . "Row" . $j . "URL",($_REQUEST)) || array_key_exists("entry" . $i . "Row" . $j . "Shop",($_REQUEST))){
							if ($_REQUEST["entry" . $i . "Row" . $j . "id"]){
								$subquery = "UPDATE userlistforperson SET itemName = '" . mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Row' . $j . 'Item']) . "' , itemURL = '" . mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Row' . $j . 'URL']) . "', itemShop = '" . mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Row' . $j . 'Shop']) . "' , itemPrice = '" . mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Row' . $j . 'Price']) . "' , itemBought = '" . isset($_REQUEST['entry' . $i . 'Row' . $j . 'Bought']) . "' , itemWrapped = '" . isset($_REQUEST['entry' . $i . 'Row' . $j . 'Wrapped']) . "' , itemDelivered = '" . isset($_REQUEST['entry' . $i . 'Row' . $j . 'Delivered']) . "' , itemDateUpdate = '$date' WHERE personID = '" . $_REQUEST['entry' . $i . 'Row' . $j . 'id'] . "'";
							} else {
								$subquery = "INSERT INTO userlistforperson VALUES ('', '$entryID', '$id', '" . mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Row' . $j . 'Item']) . "','" . mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Row' . $j . 'URL']) . "', '" . mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Row' . $j . 'Shop']) . "', '" . mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Row' . $j . 'Price']) . "', '', '" . isset($_REQUEST['entry' . $i . 'Row' . $j . 'Bought']) . "', '" . isset($_REQUEST['entry' . $i . 'Row' . $j . 'Wrapped']) . "', '" . isset($_REQUEST['entry' . $i . 'Row' . $j . 'Delivered']) . "', '$date')";
							}
							echo $subquery . "<br />";
							$querySub = mysqli_query($connect, $subquery);
							if ($querySub){
								$fail = false;
							}  else {
								$fail = true;
							}
						}
						
					}
				} else {
					//header("location: /list/?listid=" . $listID . "&staus=fail");	
				}

				
						
			} else {
				if ($fail == true){
					//header("location: /list/?listid=" . $listID . "");			
				} else {
					//header("location: /list/?listid=" . $listID . "&staus=fail");
				}
			}
		} else {
			
		}
		if ($fail == true){
			//header("location: /list/?listid=" . $listID . "");			
		} else {
			//header("location: /list/?listid=" . $listID . "&staus=fail");
		}
	}
?>