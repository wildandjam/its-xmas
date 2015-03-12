<?php require('../../res/meta.php'); 
require('../../res/connect.php');
	$licheck = mysqli_query($connect, "SELECT * FROM userlist WHERE userID='$id'");
    $licount = mysqli_num_rows($licheck);

?>
<title>My Lists | It's Christmas</title>
</head>
<body>
<?php require('../../res/headnav.php'); ?>
<div id="container" class="myCollectionsContainer">
        <div id="listBanner" class="banner">
        <?php if ($id){?>
            <div id="breadcrumbs">
                <ul>
                    <li><a href="/member/my-christmas/">My Christmas</a></li>
                    <li><a href="/member/lists/">My Lists</a></li>
                </ul>
            </div>
        <?php } ?>
        <h1>My Lists</h1>
        
        <?php if ($id){
			require_once('../../res/create.php'); 
		}
    ?>
	<?php if (!$id){ ?>
    	<div class="content content1000">
			<p class="errorMsg">To have the ability to make lists you need to <a href="/login/">sign in</a> to the Christmas spirit.</p>
        </div>
	<?php } ?>
            <div id="myListPanel">
		<?php 
            if ($licount > 0){
                
                echo "<ul>";
                while ($liRow = mysqli_fetch_array($licheck)){ ?>
                    <li>
                    	<a class="christmasList" href='/list/?listid=<?php  echo $liRow['userListID'] ?>'>
                        	<?php if ($liRow['userListType'] == 2){ ?>
                            	<div class="listPreview gift"></div>
                            <?php } else { ?>
	                        	<div class="listPreview card"></div>
                            <?php } ?>
                            <div class="listName"><?php echo $liRow['userListName'] ?></div>
                         </a>
                   	</li>
          <?php }
                echo "</ul>";
            } else {
                echo "<p>You haven't created a list yet - <a href='/member/create-list/'>do you want to</a>?</p>";	
            }
        ?>
        </div>
	</div>
	<?php 
	
		require('../../res/sidebars.php'); ?>
</div>

</body>
</html>