<?php
	if (isset($xID)){
		$viewQ = mysqli_query($connect, "SELECT * FROM preferences WHERE userID = '$xID'");
		$viewQCount = mysqli_num_rows($viewQ);
		if ($viewQCount == 1){
			while($viewQRow = mysqli_fetch_array($viewQ)){
				$view = $viewQRow['viewID'];
				$perPage = $viewQRow['perPage'];	
			}
		} else {
			$viewInsert = mysqli_query($connect, "INSERT INTO preferences VALUES ('','$xID','1', '')");
			$view = 1;
		}
	} else {
		if (isset($_SESSION)){
			if (isset($_SESSION['view'])){
				$view = $_SESSION['view'];
				$perPage = $_SESSION['perPage'];
			} else {
				$view = 1;	
				$perPage = 25;
			}
		} else {
			$view = 1;	
			$perPage = 25;
		}
	}
?>