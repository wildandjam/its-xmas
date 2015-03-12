<?php
	$fail = false;
	require('../res/user.php');
	require('../res/connect.php');
	$listID = $_REQUEST['listID'];
	"<br />";
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
				$personDelete = $_REQUEST["entry" . $i . "removePerson"];
				
				echo "<h2>" . $name . "</h2>";
				echo $relationship;
				echo "<br />";
				echo $budget;
				echo "<br />";
				$date = date("Y-m-d H:i:s");
				
				if ($personDelete == "1"){
					$query = "DELETE FROM userlistfor WHERE userItemForID = '$entryID'";
					
				} else {
				
					if (mysqli_num_rows($personquery) == 0){
						echo "INSERT";
						$query = "INSERT INTO userlistfor VALUES ('','$listID','$id', '$name','$relationship','$budget','0','0','0','0','$date')";
						
					} else {
						echo "UPDATE";
						$query = "UPDATE userlistfor SET userItemForPerson = '$name', userItemRelationship = '$relationship', userItemForBudget = '$budget', userItemForDate = '$date' WHERE userItemForID = '$entryID'";
					}
				}
				echo $query;
				echo "<br />";
				echo "<br />";
				$runQuery = mysqli_query($connect, $query) or mysqli_error($connect);
				if ($runQuery){
					echo "Success";
					echo "<br />";
					echo "<br />";
					for ($j = 1; $j < $number; $j++){
						if (array_key_exists("entry" . $i . "Name" . $j,($_REQUEST)) || array_key_exists("entry" . $i . "Shop" . $j,($_REQUEST)) || array_key_exists("entry" . $i . "URL" . $j,($_REQUEST)) || array_key_exists("entry" . $i . "Price" . $j,($_REQUEST)) || array_key_exists("entry" . $i . "Ideas" . $j,($_REQUEST))){
							$rowName = "";
							$rowSymbol = "";
							$rowURL = "";
							$rowShop = "";
							$formPrice = "";
							$rowPrice = "";
							$rowInspiration = "";
							$rowDelete = "";
							
							$rowName = mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Name' . $j]);
							$rowSymbol = mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Symbol' . $j]);
							$rowURL = mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'URL' . $j]);
							$rowShop = mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Shop' . $j]);
							$formPrice = mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Price' . $j]);
							$rowPrice = preg_replace("/[^0-9,.]/", "", $formPrice);
							$rowInspiration = mysqli_real_escape_string($connect, $_REQUEST['entry' . $i . 'Ideas' . $j]);
							$rowDelete = $_REQUEST['entry' . $i . 'Remove' . $j];
							
							if ($rowSymbol == 0){
								$rowSymbol = 1;	
							}
							
							if ($rowName != '' || $rowURL != '' || $rowShop != '' || $rowPrice != '' || $rowInspiration != ''){
							
								if ($_REQUEST["entry" . $i . "RowID" . $j]){
									if ($rowDelete != '1'){
										$subquery = "UPDATE userlistforperson SET itemName = '" . $rowName . "' , itemURL = '" . $rowURL . "', itemShop = '" . $rowShop . "', itemSymbol = '" . $rowSymbol . "', itemPrice = '" . $rowPrice . "', itemDateUpdate = '$date' WHERE personID = '" . $_REQUEST['entry' . $i . 'RowID' . $j] . "'";
									} else {
										$subquery = "DELETE FROM userlistforperson WHERE personID = '" . $_REQUEST['entry' . $i . 'RowID' . $j] . "'";
									}
								} else {
									if (!$entryID){
										echo "<hr />";
										$getEntryQuery = "SELECT * FROM userlistfor WHERE userItemForPerson = '$name' AND userItemRelationship = '$relationship' AND userItemForBudget = '$budget' AND userID = '$id' AND listID = '$listID'";
										$getEntry = mysqli_query($connect, $getEntryQuery);
										echo "<h1>Adding new line</h1>";
										echo $getEntryQuery;
										if (mysqli_num_rows($getEntry) == 1){
											while ($getEntryRow = mysqli_fetch_array($getEntry)){
												$entryID = $getEntryRow['userItemForID'];
											}
										} 
										echo "<hr />";
									}
									if ($rowDelete != '1'){
										$subquery = "INSERT INTO userlistforperson VALUES ('', '$entryID', '$id', '$rowName', '$rowURL', '$rowShop', '$rowPrice','$rowSymbol', '$rowInspiration', '0', '0', '0', '$date')";
									} else {
										$subquery = "";
									}
								}
								echo $subquery . "<br />";
								$querySub = mysqli_query($connect, $subquery);
								if ($querySub){
									echo "<BR />SUCCESS<HR />";
									$fail = false;
								}  else {
									echo "<BR />FAIL<HR />";
									$fail = true;
								}
							}
						}
						
					}
				} else {
					header("location: /list/?listid=" . $listID . "&staus=fail");	
				}

				
						
			} else {
				if ($fail == true){
					header("location: /list/?listid=" . $listID . "");			
				} else {
					header("location: /list/?listid=" . $listID . "&staus=fail");
				}
			}
		} else {
			
		}
		if ($fail == true){
			header("location: /list/?listid=" . $listID . "");			
		} else {
			header("location: /list/?listid=" . $listID . "&staus=fail");
		}
	}
	
?>
<hr />
<hr /><br />
<?php print_r($_REQUEST); ?>