<?php 
	if ($id){
		$adminuser = false;
		$adminCheck = mysqli_query($connect, "SELECT * FROM admin WHERE userID = '$id'");
		$adminCount = mysqli_num_rows($adminCheck);
		
		if ($adminCount == 1){
			while($adminRow = mysqli_fetch_array($adminCheck)){
				$adminLevel = $adminRow['adminLevel'];
				if ($adminLevel > 3){
					$adminuser = true;	
				}
			}
		}

		if ($adminuser){
			if ($pageID){
				$ppQuery = mysqli_query($connect, "SELECT * FROM seo WHERE pageID = '$pageID'");
				$ppCount = mysqli_num_rows($ppQuery);
				if ($ppCount == 1){
					while($ppRow = mysqli_fetch_array($ppQuery)){
						$ppTitle = $ppRow['pageTitle'];
						$ppDescription = $ppRow['pageDescription'];
					}
				}
			} else {
				
			}
	
	
		}
	}
?>