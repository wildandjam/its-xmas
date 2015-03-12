<?php
	require('connect.php');
	$getcat = mysqli_query($connect, "SELECT * FROM categories WHERE categoryParent =  '0' ORDER BY categoryName ");
	$categorycount = mysqli_num_rows($getcat);
	if (isset($mobileselect) && $mobileselect === true){
		echo "<select id='category' name='category' class='handheld'>";
		if ($searchCat > 0){
			echo "<option value='" . $searchCat . "'>" . $searchCatName . "</option>";	
		} else {
			echo "<option value='0'>Select</option>";
			
		}
		while($catrow = mysqli_fetch_assoc($getcat)) {
			$categoryname = $catrow['categoryName'];
			$categoryid = $catrow['categoryID'];
			echo "<option value='" . $categoryid . "'>" . $categoryname . "</option>";
		} 
		$subCatQuery = mysqli_query($connect, "SELECT * FROM categories WHERE categoryParent =  '$categoryid' ORDER BY categoryName ");
		$subCatCount = mysqli_num_rows($subCatQuery);
			
		if ($subCatCount > 0){
			while ($subRow = mysqli_fetch_array($subCatQuery)){
				$subID = $subRow['categoryID'];
				$subName  =  $subRow['categoryName'];
				echo "<option>- " . $subName . "</option>";
			}
		}
		echo "</select>";
	} else if (isset($selectbox) && $selectbox === true){
		echo "<select id='category' name='category' class='jquerySelect nonHandheld'>";
		if ($searchCat > 0){
			echo "<option value='" . $searchCat . "'>" . $searchCatName . "</option>";	
		} else {
			echo "<option value='0'>Select</option>";
			
		}
		while($catrow = mysqli_fetch_assoc($getcat)) {
			$categoryname = $catrow['categoryName'];
			$categoryid = $catrow['categoryID'];
			echo "<option value='" . $categoryid . "'>" . $categoryname . "</option>";
		} 
		$subCatQuery = mysqli_query($connect, "SELECT * FROM categories WHERE categoryParent =  '$categoryid' ORDER BY categoryName ");
		$subCatCount = mysqli_num_rows($subCatQuery);
			
		if ($subCatCount > 0){
			while ($subRow = mysqli_fetch_array($subCatQuery)){
				$subID = $subRow['categoryID'];
				$subName  =  $subRow['categoryName'];
				echo "<option>- " . $subName . "</option>";
			}
		}
		echo "</select>";
		
	} else if (isset($navigation) && $navigation === true){
		echo "<ul id='category' class='navUL'>";
		echo "<li class='link'>Select Category <ul>";
		while($catrow = mysqli_fetch_assoc($getcat)) {
			$categoryname = $catrow['categoryName'];
			$categoryid = $catrow['categoryID'];
			echo "<li><a href='" . $base . "category=" . $categoryname . "'>" . $categoryname . "</a></li>";
			
			$subCatQuery = mysqli_query($connect, "SELECT * FROM categories WHERE categoryParent =  '$categoryid' ORDER BY categoryName ");
			$subCatCount = mysqli_num_rows($subCatQuery);
			
			if ($subCatCount > 0){
				while ($subRow = mysqli_fetch_array($subCatQuery)){
					$subID = $subRow['categoryID'];
					$subName  =  $subRow['categoryName'];
					echo "<li>" . $subName . "</li>";
				}
			}
		}
		echo "</ul></li></ul>";
	} else if ($getCats){
		echo "<select id='category' name='category'>";
			echo "<option value='" . $getCats . "'>" . $categoryName . "</option>";
			while($catrow = mysqli_fetch_assoc($getcat)) {
				$categoryname = $catrow['categoryName'];
				$categoryid = $catrow['categoryID'];
				echo "<option value='" . $categoryid . "'>" . $categoryname . "</option>";
				
			}
		echo "</select>";
		
	} else {
		$categoryname = $catrow['categoryName'];
		$categoryid = $catrow['categoryID'];
		echo $categoryname;
	}
?>