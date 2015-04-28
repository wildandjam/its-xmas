<?php require('../../res/meta.php'); ?>
<?php require('../../res/membercheck.php'); ?>
<title>Preferences | It's Christmas</title>
</head>
<body>
<?php require('../../res/headnav.php'); ?>
<div id="container" class="pagePreferences">
	<div class="content">
		<h1>Preferences</h1>
        <?php 
        	if (isset($_REQUEST['mode'])){
        		$mode = $_REQUEST['mode'];
        	}
			if (isset($_REQUEST['viewType']) && isset($_REQUEST['perPage']) && isset($_REQUEST['countdownType'])){
				$viewType = $_REQUEST['viewType'];
				$perPage = $_REQUEST['perPage'];
				$countdownType = $_REQUEST['countdownType'];
			}
						
			if (isset($xID)){
				$viewQ = mysqli_query($connect, "SELECT * FROM preferences WHERE userID = '$xID'");
				$viewQCount = mysqli_num_rows($viewQ);
				if ($viewQCount == 0){
					$viewInsert = mysqli_query($connect, "INSERT INTO preferences VALUES ('','$xID','$view', $perPage','days')");
				}
			}
			
			if (isset($mode) && $mode == "changed"){
				$updateQuery = mysqli_query($connect, "UPDATE preferences SET viewID='$viewType', perPage = '$perPage', countdownType = '$countdownType' WHERE userID = '$id'");
				if ($updateQuery){
					echo "<p class='successMsg'>The elves have your new preferences!</p>";	
				} else {
					echo "<p class='errorMsg'>A polar bear sneezed whilst we tried to change your preferences, can you try again please?</p>";
				}
			}
			
			$prefQuery = mysqli_query($connect, "SELECT * FROM preferences WHERE userID = '$id'");
			$prefCount = mysqli_num_rows($prefQuery);
			while ($prefRow = mysqli_fetch_array($prefQuery)){
				$viewID = $prefRow['viewID'];
				$perPage = $prefRow['perPage'];
				$viewQuery = mysqli_query($connect, "SELECT * FROM views WHERE viewID = '" . $viewID . "'");
				$viewCount = mysqli_num_rows($viewQuery);
				$countdownType = $prefRow['countdownType'];
				
			}
			if ($viewCount > 0){
				while ($viewRow = mysqli_fetch_array($viewQuery)){
					$viewName = $viewRow['viewName'];
					if ($viewName == "default"){
						$view = "Pin";
					} else {
						$view = $viewName;
					}
				}
			}
			
			if (isset($mode) && $mode == "change"){ ?>
            	<form id="changePref" name="changePref" action="/member/preferences/">
                	<label for="viewType">View type:</label>
                    <?php
                    $viewChangeQuery = mysqli_query($connect, "SELECT * FROM views");
                    $viewChangeCount = mysqli_num_rows($viewChangeQuery);
                    
                    if ($viewChangeCount > 0){
                        
                        echo "<select id='viewType' name='viewType'>";
						echo "<option selected value='" . $viewID . "'>" . $viewName . "</option>";
                        while ($viewChangeRow = mysqli_fetch_array($viewChangeQuery)){
                            $viewChangeID = $viewChangeRow['viewID'];
                            $viewChangeName = $viewChangeRow['viewName'];
							echo "<option value='" . $viewChangeID . "'>" . $viewChangeName . "</option>";
                        }
                        echo "</select>";
                    }
                    
                ?>
                    <label for="perPage">Items per page:</label>
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
                    <label for="countdownType">Countdown duration</label>
                    <select id="countdownType" name="countdownType" style="text-transform: capitalize;">
                    	<option value="<?php echo $countdownType; ?>"><?php echo $countdownType; ?> (selected)</option>
                    	<option value="seconds">Seconds</option>
                    	<option value="minutes">Minutes</option>
                    	<option value="hours">Hours</option>
                    	<option value="days">Days</option>
                        <option value="weeks">Weeks</option>
                    </select>
                    <input type="hidden" name="mode" id="mode" value="changed" />
                    <button>Change preferences</button>
                </form>
            
            
				
			<?php	
			} else {
					
					$prefHTML = '<div class="formRow"><span class="title">View type:</span><span class="info"><span class="infoContent"> ' . $view . '</span></div>';
					$prefHTML .= '<div class="formRow"><span class="title">Items per page:</span><span class="info"><span class="infoContent"> ' . $perPage . '</span></div>';
					$prefHTML .= '<div class="formRow"><span class="title">Countdown duration:</span><span class="info"><span class="infoContent" style="text-transform: capitalize;"> ' . $countdownType . '</span></div>';
					
					
				
				echo $prefHTML;
				echo "<a href='/member/preferences/?mode=change' class='fakeButton link'>Change</a>";
			
			}
		?>
        
    </div>
    <?php require('../../res/sidebars.php'); ?>
</div>

</body>
</html>
