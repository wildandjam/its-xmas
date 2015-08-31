<?php 
    $membercheck = true;
    require('../../res/meta.php');
?>
<title>Create List | It's Christmas</title>
</head>
<body>
<?php require('../../res/headnav.php'); ?>
<div id="container">
	<h1>Create a list</h1>
	<?php require('../../res/connect.php'); 
	
		$listName = $_REQUEST['listName'];
		$listType = $_REQUEST['listType'];
		$error = $_REQUEST['error'];
		
		if ($error){
			switch ($error){
				case "already":
					$msg = "Unfortauntely, you've already added a list with this name.";
					break;
				case "database":
					$msg = "The elves have eaten too many mince pies and something has gone wrong. Please try again.";
					break;
				case "missing":
					$msg = "Please fill in all fields";
					break;
				
			}
		}
	
	?>
    <div class="content content600">
    	<?php 
			if ($error){
				echo "<p class='errorMsg'>" . $msg . "</p>";				
			}
		
			if ($id){ ?>
                <form method="post" action="/process/create-list.php" name="createList" id="createList">
                
                    <label for="listName">What would you like to call the list?</label>
                    <input type="text" id="listName" name="listName" value="<?php echo $listName; ?>" />
                    <label for="listType">What type of list would you like to create?</label>
                    <?php 
                    
                        $listTypeQuery = mysqli_query($connect, "SELECT * FROM userlisttype WHERE userListTypeHidden = '0'");
                        if (mysqli_num_rows($listTypeQuery)){
                            while($listTypeRow = mysqli_fetch_array($listTypeQuery)){
                                $listTypeID = $listTypeRow['userListTypeID'];
                                switch ($listTypeRow['userListTypeName']){
                                    case "card":
                                        $listTypeImg = "/images/card-blue.png";
										$listTypeName = "Cards";
                                        break;
                                    case "others":
                                        $listTypeImg = "/images/gift-blue.png";
										$listTypeName = "Gifts";
                                        break;
                                }
                                
                                echo "<div class='listTypeOption' data-listtypeno='" . $listTypeID . "'>";
								echo "<img src='" . $listTypeImg . "' alt='List option' />";
								echo $listTypeName;
								echo "</div>";
                                
                            } ?>		
                            <input type="hidden" name="listType" id="listType" value="<?php echo $listType; ?>" />
                            
                    <?php
                        }
                    ?>    
                    <label for="listPrivacy">Do you want your list to be private?</label>
                    <select id="listPrivacy" name="listPrivacy">
                    	<option value="0" selected>No</option>
                        <option value="1">Yes</option>
                    </select>    
                    <button style="float:right;">Create list</button>
                </form>
                <p>Did you mean to go to your <a href="/member/nice-list/">nice list</a> or <a href="/member/naughty-list/">naughty list</a>?</p>
               
           <?php } else {
			   echo "<p class='errorMsg'>Unfortunately you must be <a href='/login/'>logged in</a> to create a list.</p>";
		   } ?>
	</div>		
	<?php require('../../res/sidebars.php'); ?>
</div>
<script type="text/javascript">
	$(function(){
		$(".listTypeOption").click(function(){
			$(".listTypeOption").removeClass("selected");
			$(this).addClass("selected");
			var	valueID = $(this).attr("data-listtypeno");
			$("input#listType").val(valueID);
		});
	});
	
</script>
</body>
</html>