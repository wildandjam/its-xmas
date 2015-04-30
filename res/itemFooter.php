 <div id="paginationContainer">
    <div id="pagination">
    	<?php 
    	if (isset($wholecount) && $wholecount > 0){ ?>
       		<div class="paginationHeader">Pages:</div>
       		<?php if (isset($pagination)){ 
       			echo $pagination;
			} else {
				echo "<div class='paginationHeader'><em>0 pages</em></div>";
			}
		}
		?>
   	</div>
    <form action='/process/changeView.php?from=<?php echo $_SERVER["REQUEST_URI"]; ?>' method='post' id="formView" >
	    <div id="perPageContainer">
	        <div class="paginationHeader">Items per page:</div>
	        <select id="perPage" name="perPage">
	        	<?php if ($perPage == 10){
					echo "<option selected>10</option>";
				} else {
					echo "<option>10</option>";
				}
				if ($perPage == 25){
					echo "<option selected>25</option>";
				} else {
					echo "<option>25</option>";
				}
				if ($perPage == 50){
					echo "<option selected>50</option>";
				} else {
					echo "<option>50</option>";
				}
				if ($perPage == 100){
					echo "<option selected>100</option>";
				} else {
					echo "<option>100</option>";
				}
				if ($perPage == "All"){
					echo "<option selected>All</option>";
				} else {
					echo "<option>All</option>";
				}
				?>
	        </select>
	    </div>
	    <div id="changeView">
	        <div class="paginationHeader">Change View:</div>
	        <?php
	            $viewQuery = mysqli_query($connect, "SELECT * FROM views");
	            $viewCount = mysqli_num_rows($viewQuery);
	            
	            if ($viewCount > 0){
	                echo "<select id='view' name='view'>";
	                while ($viewRow = mysqli_fetch_array($viewQuery)){
	                    $viewID = $viewRow['viewID'];
	                    $viewName = $viewRow['viewName'];
						if ($viewID == $view){
							echo "<option selected value='" . $viewID . "'>" . $viewName . "</option>";
						} else {
							echo "<option value='" . $viewID . "'>" . $viewName . "</option>";
						}
	                }
	                echo "</select>";
	            }
	        ?>
	    </div>
	    <div id="updateView">
	        <div class="paginationHeader">&nbsp;</div>
	    	<input type="hidden" id="userID" name="userID" value="<?php echo $id; ?>" />
	        <button type="submit">Change</button>
	    </div>
	</form>
</div>