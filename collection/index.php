<?php 
	require('../res/meta.php'); 
	if (isset($_REQUEST['collectionid']) && $_REQUEST['collectionid']){
		$listID = $_REQUEST['collectionid'];
		$listQuery = mysqli_query($connect, "SELECT * FROM collections WHERE listID='" . $listID ."'");
		$listRows = mysqli_num_rows($listQuery);
		
		while($row = mysqli_fetch_assoc($listQuery)){
			$listName = $row['listName'];	
			$userID = $row['userID'];
			$listUserID = $row['userID'];
			$listDescription = $row['listDescription'];
			$listPrivate = $row['listPrivate'];
			$listParent = $row['listParentID'];
			$listViewQuery = mysqli_query($connect, "SELECT * FROM preferences WHERE userID = '$id'");
			if (mysqli_num_rows($listViewQuery) == '1'){
				while ($listViewQRow = mysqli_fetch_array($listViewQuery)){
					$listView = $listViewQRow['viewID']; 	
				}
			} else {
				$listView = 1;
			}
			
			
			switch ($listView){
				case "1":
					$viewPath = '../res/post/pin.php';
					$viewName = 'pin';
					break;
				case "2":
					$viewPath = '../res/post/images.php';
					$viewName = 'images';
					break;
				case "3":
					$viewPath = '../res/post/minimal.php';
					$viewName = 'minimal';
					break;
				case "4":
					$viewPath = '../res/post/rows.php';
					$viewName = 'rows';
					break;
				case "5":
					$viewPath = '../res/post/text.php';
					$viewName = 'text';
					break;
				default:
					$view = 1;
					$viewPath = '../res/post/pin.php';
					$viewName = 'pin';
					break;	
			}
				if (isset($view) && ($view == "1" or $view == "2")){ ?>
					<script src="/res/jquery.masonry.min.js"></script>
					<script type="text/javascript">
					$(document).ready(function(){	
						if ($('#itemholder')){
							var itemwidth = $('#itemholder').width(),
								$container = $('#itemholder');
							$container.imagesLoaded(function(){
								$container.masonry({
									itemSelector : '.item',
									columnWidth : 0,
									isAnimated: true,
									"isFitWidth": true
								});
							});
						}
					});
					
					</script>
				<?php } 
		}
		$authorQuery = mysqli_query($connect, "SELECT * FROM users WHERE userID='" . $userID . "'");
		while($arow = mysqli_fetch_assoc($authorQuery)){
			$authorName = $arow['userName'];
		}
	?>
<title><?php echo $listName; ?> | <?php echo $authorName; ?> | It's Christmas</title>
</head>
<body>
<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function () {

	FB.init({
		appId: '655466264547809',
		status: true,
		xfbml: true
	});
	$("#fblikeholder").click(function(){
		FB.ui(
		  {
			method: 'share',
			href: document.URL
		  },
		  function(response) {
			return true;
		  }
		);
	});
};
	
	(function () {
		if (document.getElementById('facebook-jssdk')) { return; }
		var firstScriptElement = document.getElementsByTagName('script')[0],
			facebookJS = document.createElement('script');
		facebookJS.id = 'facebook-jssdk';
		facebookJS.src = '//connect.facebook.net/en_US/all.js';
		firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
	}());
</script>
<?php require('../res/headnav.php'); ?>
<div id="container" class="list">
	<div id="breadcrumbs">
    	<ul>
        	<?php if ($id == $userID){ ?>
            <li><a href="/member/my-christmas/">My Christmas</a></li>
				<li><a href="/member/collections/">My Collections</a></li>
			<?php } else { ?>
            	<li><a href="/user/?uid=<?php echo $userID; ?>"><?php echo $authorName; ?></a></li>
            <?php } ?>
        	<?php  
				if ($listParent){
					if ($listParent != '0'){ ?>
						<li><a href="/collection/?collectionid=<?php echo $listParent; ?>">
						<?php 
							$parentQuery = mysqli_query($connect, "SELECT * FROM collections WHERE listID = '$listParent'");
							if (mysqli_num_rows($parentQuery) == '1'){
								while ($parentRow = mysqli_fetch_array($parentQuery)){
									echo $parentRow['listName'];	
								}
							} else {
								echo "Collection";
							}
						?>
						</a></li>
						
					<?php } 
				}?>
            <li><?php echo $listName; ?></li>
        </ul>
    </div>
	<?php 
		
		if ($listRows > 0){ ?>
			<h1><?php echo $listName; ?></h1>
    		<h2 class="subheading">A collection by <a href="/user/?uid=<?php echo $userID; ?>"><?php echo $authorName; ?></a></h2>
            <?php if (isset($_REQUEST['status'])){
				switch ($_REQUEST['status']){
					case "deleteitemsuccess":
						echo "<p class='successMsg'>Post removed from collection</p>";
						break;
				}
				
			}
			
		
		?>
        
            
		<?php 
            if ($id){ 
				if ($listPrivate == '1' && ($id != $userID)){
					echo "<div class='content content600'><p class='errorMsg'>Sorry, someone wants to keep a Christmas secret!</p></div>";	
				} else {
					$subQuery = mysqli_query($connect, "SELECT * FROM collections WHERE listParentID = '$listID'");
					if (mysqli_num_rows($subQuery) > 0){
						echo "<div class='content content1000'><ul>";
						while ($subRow = mysqli_fetch_array($subQuery)){
							
							echo "<li><a class=\"christmasList\" href='/collection/?collectionid=" . $subRow['listID'] . "'>";
                            $subpostquery = mysqli_query($connect, "SELECT * FROM collectionposts WHERE listID='" .$subRow['listID'] ."'");
                            $subpostcount = mysqli_num_rows($subpostquery);
                            if ($subpostcount == 0){
                                echo "<div class='listImage noPosts'>This collection is empty!</div>";
                            } else {
                                if ($subpostcount > 4){
                                    $subpostqueryfour = mysqli_query($connect, "SELECT * FROM collectionposts WHERE listID='" .$subRow['listID'] ."' LIMIT 0,4");
                                    while ($arrayRow = mysqli_fetch_array($subpostqueryfour)){
                                        $fourpostquery = mysqli_query($connect, "SELECT * FROM posts WHERE postID = '" . $arrayRow['postID'] . "'");
                                        while($fourpost = mysqli_fetch_array($fourpostquery)){
                                            echo "<div style='background: url(" . $fourpost['postImage'] . ") no-repeat;' class='fourPost'/></div>";
                                        }
                                    }								
                                } else {
                                    $subpostqueryone = mysqli_query($connect, "SELECT * FROM collectionposts WHERE listID='" .$subRow['listID'] ."' LIMIT 0,1");
                                    while ($arrayRowOne = mysqli_fetch_array($subpostqueryone)){
                                        $onepostquery = mysqli_query($connect, "SELECT * FROM posts WHERE postID = '" . $arrayRowOne['postID'] . "'") or die(mysqli_error($connect));
                                        while($onepost = mysqli_fetch_array($onepostquery)){
                                            echo "<div style='float:left;width:200px;height:200px;background: url(" . $onepost['postImage'] . ") no-repeat;background-size: 100% auto;' class='fourPost'/></div>";
                                        }
                                    }
                                }							
                            }
                            echo "<div class='listName'>" . $subRow['listName'] . "</div></a></li>";
							
						}
						echo "</ul></div>";
					}
					$licheck = mysqli_query($connect, "SELECT * FROM collectionposts WHERE listID = '$listID'");
					$licount = mysqli_num_rows($licheck);
					if ($licount > 0){?>
						<div id="itemholder" class="<?php echo Name ?>">
							<?php 
							while($listRow = mysqli_fetch_array($licheck)){
								$postcheck = mysqli_query($connect, "SELECT * FROM posts WHERE postHidden = '0' AND postID = '" . $listRow['postID'] . "'");
								$count = mysqli_num_rows($postcheck);
								if ($count == 1) {
									$deletetype = "collection";
									$deleteuserid = $listUserID;
									$deletelistid = $listID;
									while($row = mysqli_fetch_assoc($postcheck)) {
										require('../res/prepPost.php');
										require($viewPath); 
									}
								}
							} ?>
						</div>
					<?php
					} else {
						echo "<div id=\"itemholder\"><div class='errorNoItems error'>It'll be lonely this Christmas, with no posts no hold</div></div>";
						echo '<div id="bigSearch"><div id="bigSearchForm">';
						echo "<p>&nbsp;</p><strong style='text-align:center;width:100%;display:block;font-size:12px;'>Search for a post to add to this collection:</strong>";
						require('../forms/bigsearch.php');
						echo '</div></div>';
					} 
				} ?>
				<div class="clearBoth"><a href="/process/deletecollection.php?deleteid=<?php echo $listID;?>&deletecode=<?php echo md5($listID);?>" class="delete"> Delete collection</a>
				<div id="shareThisPage" class="collectionShare">
                    <h3>Share:</h3>
                    <span id="fblikeholder" class="facebookLike hint--bottom" data-hint="Share on Facebook"><img src="/images/social/facebook.png" /></span>
                    <a href="https://plus.google.com/share?url=www.its-xmas.co.uk/collection/?collectionid=<?php echo $listID;?>" onClick="javascript:window.open(this.href,
                    '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="hint--bottom" data-hint="Share on Google+"><img
                    src="/images/social/google.png" alt="Share on Google+"/></a>
                    <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" class="hint--bottom" data-hint="Pin on Pinterest">
                        <img src="/images/social/pinterest.png" alt="Pinterest pin-it button">
                    </a>
                    <a href="https://twitter.com/share?via=NowItsChristmas&amp;text=Check out the <?php echo $listName; ?> collection on It's Christmas at http://www.its-xmas.co.uk/collection/?collectionid=<?php echo $listID;?>" target="_blank" class="hint--bottom" data-hint="Tweet page"><img src="/images/social/twitter.png" /></a>
               </div>	
       		</div>		
            
<?php       
			require('../res/create.php');
     } else { ?>
                <div id="pleaseLogin">Whoops, you need to <a href="/login/?from=/collection/?collectionid=<?php echo $listID; ?>">sign in</a> to the Christmas spirit to see this!"</div>
            <?php } 
		} else {
			echo "<h1>Collection</h1>";
			echo "<p class='errorMsg'>Maybe you've had too much eggnog. This collection doesn't exist!</p>";	
		}
	} else if ($_REQUEST['postid']){ ?>
		 <title>Collections by post | It's Christmas</title>
        </head>
        <body>
        <?php require('../res/headnav.php'); ?>
        <div id="container" class="list">
	        <h1>Collections by post</h1>
            <?php 
				$postID = $_REQUEST['postid'];
				$colquery = "SELECT * FROM collections INNER JOIN collectionposts ON (collections.listID = collectionposts.listID) WHERE listPrivate = '0' AND postID = '$postID'";
				$colbypost = mysqli_query($connect, $colquery);
				$colCount = mysqli_num_rows($colbypost);
				if ($colCount > 0){
					echo "<div class='content content1000 postsbycollection'><div id='myCollectionPanel'>";
					while($listRow = mysqli_fetch_assoc($colbypost)) {
                            $listID = $listRow['listID'];
                            $listName = $listRow['listName'];
                            $listPrivate = $listRow['listPrivate'];
                            echo "<a class=\"christmasList\" href='/collection/?collectionid=" . $listID . "'>";
                            $listpostquery = mysqli_query($connect, "SELECT * FROM collectionposts WHERE listID='$listID'");
                            $listpostcount = mysqli_num_rows($listpostquery);
                            if ($listpostcount == 0){
                                echo "<div class='listImage noPosts'></div>";
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
                                            echo "<div style='background-image: url(" . $onepost['postImage'] . ");' class='onePost'/></div>";
                                        }
                                    }
                                        
                                    
                                }							
                            }
                            echo "<div class='listName'>" . $listName . "<span>";
							$userQuerySpan = mysqli_query($connect, "SELECT * FROM users WHERE userID = '" . $listRow['userID'] . "'");
							if (mysqli_num_rows($userQuerySpan) == 1){
								while ($userSpanRow = mysqli_fetch_array($userQuerySpan)){
									echo "A collection by " . $userSpanRow['userName'];	
								}
							}
							
							echo "</span></div></a>";
                        }
					echo "</div>";
				} else {
					echo "<p class='errorMsg'>Unfortunately, there aren't any collections that have <a href='/post/?id=" . $postID . "'>this post</a> in it.</p>";
				}	
			
			
			?>	
	<?php	
	} else { 
    	if ($id){
			header("location: /member/collections/");	
		}
		?>
        <title>Collections | It's Christmas</title>
        </head>
        <body>
        <?php require('../res/headnav.php'); ?>
        <div id="container" class="list">
        <?php
		
		echo "<h1>Collection</h1>";
		echo "<p class='errorMsg'>Maybe you've had too much eggnog. This collection doesn't exist!</p>";	
		require('../res/create.php');
	}
			$definitionNeeded = "collection";
			require('../res/definitions/define.php');

    require_once('../res/listOverlay.php'); 
	require_once('../res/reportOverlay.php');
	$limitType = "collection";
	$limitLink = "/collection/?collectionid=" . $listID;
	?>
</div>
</body>
</html>
