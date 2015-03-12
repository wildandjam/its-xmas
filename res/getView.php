<?php
	if (isset($id)){
		$viewQ = mysqli_query($connect, "SELECT * FROM preferences WHERE userID = '$id'");
		$viewQCount = mysqli_num_rows($viewQ);
		if ($viewQCount == 1){
			while($viewQRow = mysqli_fetch_array($viewQ)){
				$view = $viewQRow['viewID'];
				$perPage = $viewQRow['perPage'];	
			}
		} else {
			$viewInsert = mysqli_query($connect, "INSERT INTO preferences VALUES ('','$id','1', '')");
			$view = 1;
		}
	} else {
		if ($_SESSION){
			if ($_SESSION['view']){
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