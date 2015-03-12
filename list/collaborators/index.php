<?php require('../../res/meta.php'); 
	require('../../res/connect.php'); ?>
	<title>Manage collaborators | It's Christmas</title>
</head>
<body>
<?php require('../../res/headnav.php'); ?>
<div id="container" class="CollaboratorList">
	<div class="content">
        <h1>Manage collaborators</h1>

        
        
        <div id="collaboratorHolder">
        <?php 
			require('../../res/connect.php');
			$getLists = mysqli_query($connect, "SELECT * FROM userlist WHERE userID = '$id'");
			if (mysqli_num_rows($getLists) > 0){
				while ($listRow = mysqli_fetch_array($getLists)){
					echo "<div class=\"collaboratorRow\"><div class=\"listName\">" . $listRow['userListName'] . "</div>";
						echo "<div class=\"collabUsers\">";
						$collabQuery = mysqli_query($connect, "SELECT * FROM userlistcontributor WHERE listID = '" . $listRow['listID'] . "'");
						if (mysqli_num_rows($collabQuery) > 0){
							
						} 
						
						$userAddCollab = mysqli_query($connect, "SELECT * FROM relationships WHERE (userID1 = '$id' AND relationshipTypeID = '2') OR (userID1 = '$id' AND relationshipTypeID = '4') OR (userID2 = '$id' AND relationshipTypeID = '3') OR (userID2 = '$id' AND relationshipTypeID = '4')");
						if (mysqli_num_rows($userAddCollab) > 0){
							echo "<select>";
							echo "<option>Choose collaborator...</option>";
							while($userAdd = mysqli_fetch_array($userAddCollab)){
								$id1 = $userAdd['userID1'];
								$id2 = $userAdd['userID2'];	
								
								if ($id == $id1){
									$userFriendID = $id2;
								} else {
									$userFriendID = $id2;
								}
								
								$userNameLookUp = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$userFriendID'");
								if (mysqli_num_rows($userNameLookUp) == 1){
									while($userNameRow = mysqli_fetch_array($userNameLookUp)){
										echo "<option value='" . $userFriendID . "'>" . $userNameRow['userName'] . "</option>";
									}
								}
							}
							echo "</select>";
						}
						echo "</div>";
					echo "</div>";
				}
			} else {
				echo "Unfortunately you have no lists to collaborate on.";	
			}
            	
				
				?>					
                     <div class="collaboratorRow">
							
        
      
        	</div>
		</div>
    <?php require('../../res/sidebars.php'); ?>
    </div>
	
</div>
<script type="text/javascript">
	$(".collaboratorRow .listName").click(function(){
		$this = $(this).parent(".collaboratorRow");
		if ($this.hasClass("show")){
			$this.removeClass("show");	
		} else {
			$this.addClass("show");	
		}
	});
</script>
</body>
</html>
