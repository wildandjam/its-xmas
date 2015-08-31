<?php 
    $membercheck = true;
    require('../../res/meta.php');
?>
<title>My Christmas | It's Christmas</title>
</head>
<body>
<?php require('../../res/headnav.php'); ?>
<div id="container" class="myChristmasContainer">
    <?php 
        $pgTitle = "My Christmas";
        $pgBreadcrumb = "<li>My Christmas</li>";
        require('../../res/pageHeader.php');
    ?>
    
	<?php if (!isset($id)){ ?>
		<p class="errorMsg">To have the ability to make lists, collections and posts, you need to <a href="/login/">sign in</a> to the Christmas spirit.</p>		
	<?php } else { 
		if (isset($_REQUEST['deleteStatus']) && $_REQUEST['deleteStatus'] == "success"){
				echo "<p class='successMsg'>Your post has been deleted.</p>";
			}
		
	?>  
        
        <?php
            if (isset($_REQUEST['reporting'])){
                $reporting = $_REQUEST['reporting'];
                
                switch ($reporting){
                    case "successful":
                        $reportStatus = "<p class='successMsg'>Thank you for submitting your report, we will try to deal with the post in question, as soon as possible</p>";
                        break;
                    case "unsuccessful":
                        $reportStatus = "<p class='errorMsg'>Unforunately there was an issue in sending your report. Please try and contact us again, so we can look at the post in quesstion, as soon as possible</p>";
                        break;
                    case "brokenemail":
                        $reportStatus = "<p class='successMsg'>Thank you for submitting your report, there was a slight issue our end, but you're report was sent, and we'll try and sort it out as soon as possible</p>";
                }
                
                
                if ($reporting){
                    echo "<div class=\"feedbackBar\">" . $reportStatus . "</div>";
                    
                }
            }
			
        ?>
        <div id="myChristmasBoxes">
        <?php 
            $collectionquery = mysqli_query($connect, "SELECT * FROM collections WHERE userID='$id' AND listParentID = '0'");
            $collectioncount = mysqli_num_rows($collectionquery); 
        ?>
            <div id="collectionPreview" class="nonHandheld">
                Collections (<?php echo $collectioncount; ?>)
            </div>
            <div id="collectionPreview" class="handheld">
                <a href="/member/collections/">
                    Collections (<?php echo $collectioncount; ?>)
                </a>
            </div>
            <?php 
                    $licheck = mysqli_query($connect, "SELECT * FROM userlist WHERE userID='$id'");
                    $licount = mysqli_num_rows($licheck);
                ?>
            <div id="listPreview" class="nonHandheld">
                Lists (<?php echo $licount; ?>)
            </div>
    
            <div id="listPreview" class="handheld">
                <a href="/member/lists/">
                    Lists (<?php echo $licount; ?>)
                </a>
            </div>
    
            
            <div id="myChristmasAccount">
                <ul>
                    <li><a href="/member/notifications/">Notifications (<?php echo $notificationCount; ?>)</a></li>
                    <?php 
                        $postcheck = mysqli_query($connect, "SELECT * FROM posts WHERE postHidden = '0' AND userID='$id'");
                    ?>
                    <li><a href="/user/?uid=<?php echo $id; ?>">View my page</a></li>
                    <li><a href="/member/nice-list/">Nice list</a></li>
                    <li><a href="/member/naughty-list/">Naughty list</a></li>
                    <li><a href="/member/details/">My details</a></li>
                    <li class="handheld"><a href="/member/preferences/">My preferences</a></li>
                </ul>
            </div>
            <div class="previewPanel" id="collectionPanel" style="display:none;">
                <?php 
                    if ($collectioncount < 1){
                        echo "You haven't added any collections yet - do you want to add one?";
                    } else {
						$collectionWidth = $collectioncount * 220;
						$collectionWidth = $collectionWidth + 220;
                        echo "<ul style='min-width:" . $collectionWidth . "px;'>";
                        while($listRow = mysqli_fetch_assoc($collectionquery)) {
                            $listID = $listRow['listID'];
                            $listName = $listRow['listName'];
                            $listPrivate = $listRow['listPrivate'];
                            echo "<li><a class=\"christmasList\" href='/collection/?collectionid=" . $listID . "'>";
                            $listpostquery = mysqli_query($connect, "SELECT * FROM collectionposts WHERE listID='$listID'");
                            $listpostcount = mysqli_num_rows($listpostquery);
                            if ($listpostcount == 0){
                                echo "<div class='listImage noPosts' style='background-image:url(/images/errorImage.jpg)';'></div>";
                            } else {
                                if ($listpostcount > 4){
                                    $listpostqueryfour = mysqli_query($connect, "SELECT * FROM collectionposts WHERE listID='$listID' LIMIT 0,4");
                                    while ($arrayRow = mysqli_fetch_array($listpostqueryfour)){
                                        $fourpostquery = mysqli_query($connect, "SELECT * FROM posts WHERE postID = '" . $arrayRow['postID'] . "'");
                                        while($fourpost = mysqli_fetch_array($fourpostquery)){
                                            echo "<div style='background-image: url(" . $fourpost['postImage'] . ");' class='fourPost'/></div>";
                                        }
                                    }								
                                } else {
                                    $listpostqueryone = mysqli_query($connect, "SELECT * FROM collectionposts WHERE listID='$listID' LIMIT 0,1");
                                    while ($arrayRowOne = mysqli_fetch_array($listpostqueryone)){
                                        $onepostquery = mysqli_query($connect, "SELECT * FROM posts WHERE postID = '" . $arrayRowOne['postID'] . "'") or die(mysqli_error($connect));
                                        while($onepost = mysqli_fetch_array($onepostquery)){
                                            echo "<div style='float:left;width:200px;height:200px;background-image: url(" . $onepost['postImage'] . ");background-repeat: no-repeat;background-size:auto 100%;background-position:center;' class='fourPost'/></div>";
                                        }
                                    }
                                        
                                    
                                }							
                            }
                            echo "<div class='listName'>" . $listName . "</div></a></li>";
                        }
						echo "<li class='fauxLi'>&nbsp;</li>";
                        echo "</ul>";
                    }
                ?>
                <div class="prevButton"><div class="prevButtonImage"></div></div>
                <div class="nextButton"><div class="nextButtonImage"></div></div>
            </div>
            <div class="previewPanel" id="listPanel" style="display:none;">
                <?php 
                    if ($licount > 0){
                        $liWidth = $licount * 220;
						$liWidth = $liWidth + 220;
                        echo "<ul style='min-width:" . $liWidth . "px;'>";
                        while ($liRow = mysqli_fetch_array($licheck)){
                            echo "<li><a class=\"christmasList\" href='/list/?listid=" . $liRow['userListID'] . "'>";
							if ($liRow['userListType'] == 2){ ?>
                            	<div class="listPreview gift"></div>
                            <?php } else { ?>
	                        	<div class="listPreview card"></div>
                            <?php } 
							
							echo "<div class=\"listName\">" . $liRow['userListName'] . "</div></a></li>";
                        }
						echo "<li class='fauxLi'>&nbsp;</li>";
                        echo "</ul>";
                    } else {
                        echo "<p>You haven't created a list yet - <a href='/member/create-list/'>do you want to</a>?</p>";	
                    }
                ?>
                <div class="prevButton"><div class="prevButtonImage"></div></div>
                <div class="nextButton"><div class="nextButtonImage"></div></div>
            </div>
	   	<?php
			$definitionNeeded = "my-christmas";
			require('../../res/definitions/define.php');
		?>
	</div>
	<?php 
	}
    ?>
</div>
<script type="text/javascript" src="/res/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript">
	$(function(){
		$("#collectionPreview, #listPreview").click(function(){
			$("#collectionPreview, #listPreview").removeClass("selected");
			$(this).addClass("selected");
			if ($(this).attr("id") == "collectionPreview"){
				$("#listPanel").hide();
				$("#collectionPanel").show();
			} else {
				$("#listPanel").show();
				$("#collectionPanel").hide();
			}
		});
		$(".previewPanel").jcarousel();
		$(".previewPanel .nextButton").click(function(){
			$(this).parent(".previewPanel").jcarousel('scroll', '+=2');
		});
		$(".previewPanel .prevButton").click(function(){
			$(this).parent(".previewPanel").jcarousel('scroll', '-=2');
		});
	});
</script>
</body>
</html>