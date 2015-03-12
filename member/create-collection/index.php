<?php require('../../res/meta.php'); ?>
<title>Create Collection | It's Christmas</title>
</head>
<body>
<?php require('../../res/headnav.php'); ?>
<div id="container">
	<div class="static content content600">
	<?php require('../../res/connect.php'); ?>
	
    <h1>Create collection</h1>
		<?php 
            $name = $_REQUEST['listName'];
            $date = date('Y-m-d', strtotime(today));
            $parent = $_REQUEST['parent'];
            if ($parent){
                $parentID = $parent;
            } else {
                $parentID = "0";
            }		
            
            if ($name){
				$doubleCheck = mysqli_query($connect, "SELECT * FROM collections WHERE userID = '$id' AND listName = '$name'");
				if (mysqli_num_rows($doubleCheck) > 0){
					
					
				} else {
					$addList = mysqli_query($connect, "INSERT INTO collections VALUES ('','$name','$id','','','$date','1','$parentID','')");
										
					if ($addList){
						$findID = mysqli_query($connect, "SELECT * FROM collections WHERE listName = '$name' AND userID = '$id'");
						if (mysqli_num_rows($findID)){
							$findIDrow = mysqli_fetch_array($findID);
							echo "<p class='successMsg'>Collection added! <a href='/collection/?collectionid=" . $findIDrow['listID'] . "'>View it here</a></p>";
						} else {
							echo "<p class='successMsg'>Collection added!</p>";
						}
						
					} else {
						echo "<p class='errorMsg'>Our elves must be trying out the new mulled wine - please try again in a few moments.</p>";
					}
					
				}
										
            }
                
        ?>
	
        <form id="addList" name="addList" method="post" action="/member/create-collection/">
            <input type="text" placeholder="Collection name" id="listName" name="listName" />
            <button>Create Collection</button>
        </form>
        <?php 
			$definitionNeeded = "collection";
			require('../../res/definitions/define.php');
		?>
	</div>		
	<?php 

	
	require('../../res/sidebars.php'); ?>
</div>
</body>
</html>