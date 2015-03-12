<?php 
if (isset($postID)){
	if (isset($id)){
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
		if ($adminuser == true){
			$reportQuery = mysqli_query($connect, "SELECT * FROM reported WHERE postID = '$postID'");
			$reportCount = mysqli_num_rows($reportQuery);
			
			echo "<div id='itemReport'><h3>Reported ( " . $reportCount . " )</h3>";	
			
			if ($reportCount > 0) {
				while ($reportRow = mysqli_fetch_array($reportQuery)){
					echo $reportRow['reasonReport'];	
				}
			}
			echo "</div>";
			
		}
	}
	
} else {
	if (isset($id)){
		
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

		if (isset($adminuser)){
			if ($pageID){
				$ppQuery = mysqli_query($connect, "SELECT * FROM seo WHERE pageID = '$pageID'");
				$ppCount = mysqli_num_rows($ppQuery);
				if ($ppCount == 1){
					while($ppRow = mysqli_fetch_array($ppQuery)){
						$ppTitle = $ppRow['pageTitle'];
						$ppDescription = $ppRow['pageDescription'];
						$ppKeywords = $ppRow['pageKeywords'];
						$ppImage = $ppRow['pageImage'];
					}
				}
			} else {
				
			} ?>
			<form id="changeMeta" action="/process/changeMeta.php" method="post">
         <?php   
         	if (isset($_REQUEST['metaUpdate'])){
				$metaUpdate = $_REQUEST['metaUpdate'];

				if ($metaUpdate == "success"){
					echo "<h3>Updated!</h3>";
				} else if ($metaUpdate == "fail"){
					echo "<h3>Fail!</h3>";
				}
			}
		?>            
            
                <label>Title</label><input id="seoTitle" name="seoTitle" type="text" value="<?php echo $ppTitle; ?>" />
                <label>Description</label><input id="seoDesc" name="seoDesc" type="text" value="<?php echo $ppDescription; ?>"/>
                <label>Keywords</label><input id="seoKeywords" name="seoKeywords" type="text" value="<?php echo $ppKeywords; ?>"/>
				<label>Image</label><input id="seoImage" name="seoImage" type="text" value="<?php echo $ppImage; ?>"/>
                <input type="hidden" name="admin" id="admin" value="<?php echo $id; ?>" />
                <input type="hidden" name="pageID" id="pageID" value="<?php echo $pageID; ?>" />
                <input type="hidden" name="pageURL" id="pageURL" value="<?php echo $_SERVER["REQUEST_URI"]; ?>" />
                <button>Change</button>                        
            </form>
		<?php
		}
	}
}
?>