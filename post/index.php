<?php 
	$ignoreOG = true;
	require('../res/meta.php'); 
	require_once('../res/connect.php');
	$postid = $_REQUEST["id"];
	$postcheck = mysqli_query($connect, "SELECT * FROM posts WHERE postID = '$postid' AND postHidden = '0'");
	$count = mysqli_num_rows($postcheck);
	if ($count == 1) {
		while($row = mysqli_fetch_assoc($postcheck)) {
			$image = $row['postImage'];
			$title = $row['postTitle'];
			$url = $row['postURL'];
			$itemDate = $row['postDate'];
			$postRotate = $row['postImageRotate'];
			$userID = $row['userID'];
			$postID = $row['postID'];
			$catID = $row['categoryID'];
			$postDesc = $row['postDesc'];
			$postType = $row['postType'];
			$postPrivacy = $row['postPrivacy']; 			
			$postRating = $row['postRating'];
				
			if (isset($id)){
				$likeCheck = mysqli_query($connect, "SELECT * FROM postLikes WHERE postID = '$postID' AND userID = '$id'");
				$likeCount = mysqli_num_rows($likeCheck);
				
				if ($likeCount > 0){
					while ($likeRow = mysqli_fetch_array($likeCheck)){
						$liked = $likeRow['liked'];
						$disliked = $likeRow['disliked'];
						if ($liked == '1'){
							$likeStatus = "like";
						} else if ($disliked == "1"){
							$likeStatus = "dislike";
						} else {
							$likeStatus = false;
						}
					}
				} else {
					$likeStatus = false;
				}
			} else {
				$likeStatus = false;
			}
		}
		?>
			<title><?php echo $title; ?> | It's Christmas</title>
            <meta itemprop="name" property="og:title" content="<?php echo $title; ?> | It's Christmas" />
        <meta itemprop="description" property="og:description" name="description" content="<?php if ($postDesc) {echo $postDesc;} else { echo "It's Christmas " . $countphp;}?>" />
        <?php 
		if ($postType == "text"){ ?>
        	<meta itemprop="image" property="og:image" content="http://www.its-xmas.co.uk/images/logo/fbimage.jpg" />
        <?php } else if ($postType == "video"){ ?>
        	<meta itemprop="image" property="og:image" content="<?php echo $postRotate; ?>" />
            <meta itemprop="video" property="og:video" content="<?php echo $url; ?>" />
            <link rel="video_src" href="<?php echo $url; ?>" />
            <link rel="image_src" href="<?php echo $url; ?>" />
  		<?php } else {
		
			if (isset($postURL) && ($postURL == "0" || $postURL == "")){ 
			if (strpos($postURL, "../../../") !== FALSE){
				$imageNew = str_replace("../../../","http://www.its-xmas.co.uk/",$image); 
			} else {
            	$imageNew = $image; 
           } ?>
				
				<meta itemprop="image" property="og:image" content="<?php echo $imageNew; ?>" />
			<?php } else { ?>
				<meta itemprop="image" property="og:image" content="<?php echo $image; ?>" />
			<?php } 
		}?>

        
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
        <?php if (isset($id) && $userID == $id){ ?>
        	<form method="post" action="/process/updatePost.php">
        <?php } ?>
			<div id="container">
				<div id="pageHeader">
					<div id="breadcrumbs">
				        <ul>
				            <li><a href="/">Home</a> > </li>
				            <li><a href="/posts/">Posts</a> > </li>
				        </ul>
				    </div>
			        <h1 class="small"><?php echo $title; ?></h1>
			        <?php require('../res/userPortal.php'); ?>
			        
			        <div id="pageHeaderLinks">
			           
			            
			        </div>
			    </div>
		
			<div id='itemPost' data-id='<?php echo $postID; ?>' data-token='<?php echo $id ?>' data-userid='<?php echo $userID; ?>'>
            	<?php 
            	if ($_REQUEST){
            		if (isset($_REQUEST['status'])){
	            		$status = $_REQUEST['status'];
		            	if (isset($status)){
							if ($_REQUEST['status'] == "successful"){
								echo "<p class='successMsg'>The North Pole can confirm that your post is live!!</p>";
							}					
						} else {
							if ($_REQUEST['deleteStatus']){
								echo "<p class='errorMsg'>That darn polar bear is loose again! Your delete action didn't work... blame the polar bear! Can you try again please?</p>";						
							}
						}
					} 
				}
				?>
				<div id="itemMain">
					<div class="itemImg">
                    	<?php if ($postType == "text"){ 
							echo "<div id='itemImgText'>" . $image . "</div>";
							if ($id == $userID){
								echo "<div id='editTextPost'>Edit</div>";
								echo "<textarea id=\"itemText\" name=\"itemText\">" . $image . "</textarea>";
								echo "<div id='editTextPostButton'>Edit post</div>";
								echo "<div id='cancelEditTextPost'>Cancel</div>";
							}
						} else if ($postType == "video"){ 
							switch($image){
								case "iframe": 
                                	echo '<iframe src="' . $url . '" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
									break;
								case "jwplayer": ?>
                                	<script src="http://jwpsrv.com/library/P1ehQj67EeS+YSIACyaB8g.js"></script>
									<script type="text/javascript">
                                    $(function(){
                                        jwplayer("video").setup({
                                            file: "<?php echo $url; ?>",
                                            width: 640,
                                            height: 360
                                        });
                                    });
                                    </script>
                            <div id="video"></div>
                                
                                <?php 
									break;
								case "none":
								
									break;
								
							} 
						?>
							
							
							<?php
						} else { 
							if ($url){ ?>
								
									<a href="<?php echo $url ?>"><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" /></a>
						<?php
						 	} else {
						?>
							 <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" />
						 <?php 
						 }
						 
						 
						 } ?>
					</div>
					<div class="itemRating">
                    <?php
						$likeInfoCheck = mysqli_query($connect, "SELECT * FROM postLikes WHERE postID = '$postID' AND liked = '1'");
						$likeInfoCount = mysqli_num_rows($likeInfoCheck);
						if ($likeInfoCount == "1"){
							$likeEnd = "";	
						} else {
							$likeEnd = "s";
						}	
						
						$dislikeInfoCheck = mysqli_query($connect, "SELECT * FROM postLikes WHERE postID = '$postID' AND disliked = '1'");
						$dislikeInfoCount = mysqli_num_rows($dislikeInfoCheck);
						if ($dislikeInfoCount == "1"){
							$dislikeEnd = "";	
						} else {
							$dislikeEnd = "s";
						}
					
					?>
							<span class="blue"><?php echo $likeInfoCount; ?> like<?php echo $likeEnd; ?>.</span> <span class="dgrey"><?php echo $dislikeInfoCount; ?> dislike<?php echo $dislikeEnd; ?>.</span>
					</div>
					 <div class="itemActions" data-id='<?php echo $postID; ?>' data-token='<?php echo $id ?>' data-userid='<?php echo $userID; ?>'>
						<?php 
						if (isset($id) && $id != $userID){
							if ($likeStatus == "like"){
								echo "<span class=\"likePost on hint--bottom\" data-hint=\"Liked!\"></span>";
							} else {
								echo "<span class=\"likePost hint--bottom\" data-hint=\"Like post\"></span>";
							} 
							if ($likeStatus == "dislike"){
								echo "<span class=\"dislikePost on  hint--bottom\" data-hint=\"Disliked!\"></span>";
							} else {
								echo "<span class=\"dislikePost hint--bottom\" data-hint=\"Dislike post\"></span>";
							} 
						}
						?>
				        <?php
				        	if (isset($id)){
								$listQuery = mysqli_query($connect, "SELECT * FROM collectionposts WHERE postID = '$postid' AND userID = '$id'");
								$listCount = mysqli_num_rows($listQuery);
							
								if ($listCount > 0){
									$inlist = true;	
								}
							}
				        	if (isset($inlist) && $inlist  == true){
				        ?>
				    		<span class="collection on hint--bottom" data-hint="Collection Options"></span>
				    	<?php
				    		} else {
				    	?>
				    		 <span class="collection hint--bottom" data-hint="Collection Options"></span>
				    	<?php
				    		}
				    	?>
				        <span class="report hint--bottom" data-hint="Report post"></span>
    				</div>
					<div id="listholder">
						<?php
							
							
						if (isset($id) && $id){ ?>
							Collections (<?php echo $listCount; ?>): 
            			<?php
							$lnc = 0;
                       		while ($listedRow = mysqli_fetch_array($listQuery)){
								$lnc = $lnc+1;
								$listedID = $listedRow['listID'];
								$listNameQuery  = mysqli_query($connect, "SELECT * FROM collections WHERE listID  = '$listedID'");
								$listNameCount  =  mysqli_num_rows($listNameQuery);
								if ($listNameCount  == 1){
									
									while ($listNameRow  = mysqli_fetch_array($listNameQuery)){
										
										
										if ($lnc == $listCount){
											echo "<a href='/collection/?collectionid=" . $listNameRow['listID'] . "'>" . $listNameRow['listName'] . "</a>";
										} else {
											echo "<a href='/collection/?collectionid=" . $listNameRow['listID'] . "'>" . $listNameRow['listName'] . "</a>, ";
										}
										
									}
								} else {
									echo "There has been an error";
								}
								
							}
						?>
                            <div id="addToListBox">
		                        <?php 
									$listExists = mysqli_query($connect, "SELECT * FROM collections WHERE userID = '$id'");
									$listExistsNo = mysqli_num_rows($listExists);
									
									if ($listExistsNo < 1){
										echo "You don't have any collections set up - do you want to <a href='/member/add-collection/'>create a collections <span class=\"icon-list\"></span></a>?";	
									} else {
										echo "<span id='openOverlay'>Add to collection? <span class=\"icon-list\"></span></span>";
									}
								?>
                    	</div>
					<?php							
						} 
					?>
					</div>
				</div>
				<div id="itemSide">
					<div id="itemTitle">
						<?php if (isset($id) && $userID == $id){ ?>
							<input type="text" value="<?php echo $title; ?>" name="title" id="title" class="editPost"/>
						<?php } ?>
					</div>
                    <?php if ($postDesc){ ?>
                        <div id="postDescription">
                            <?php echo $postDesc; ?>
                            
                        </div>
						                       
					<?php 
					}
					if (isset($id) && $userID == $id){ ?>
                        <textarea id="postDescriptionInput" name="postDescriptionInput" placeholder="Description"><?php echo $postDesc; ?></textarea>
                    <?php } 
					$ucheck = mysqli_query($connect, "SELECT * FROM users WHERE userID = ". $userID ."");
					$ucount = mysqli_num_rows($ucheck);
						if ($ucount === 1){
							while($urow = mysqli_fetch_assoc($ucheck)) {
								$userName = $urow['userName'];
								$userEmail = $urow['userEmail']; 
					?>
							<div id="itemUser">
								Posted by: <a href="/user/?uid=<?php echo $userID; ?>"><?php echo $userName; ?></a>

								<?php if (true == true) {//check if friends ?>
									<a class="itemFriend hint--bottom added" data-hint="Visit <?php echo $userName; ?>" href="/user/?uid=<?php echo $userID; ?>"></a>
								<?php } else { ?>
									<span class="itemFriend hint--bottom" data-hint="Add <?php echo $userName; ?>" data-userID="<?php echo $userID; ?>"></span>
								<?php } ?>
							</div>

					<?php							
							}
						}
					?>
                    <div id="itemDate">
                    	<?php
							$itemFixedDate = date("d M Y", strtotime($itemDate));
							echo "Posted on: <span class='blue'>" . $itemFixedDate . "</span>";
						
						?>
                    </div>
					<div id='itemURL'>
						<?php
							if ($url == "0"){
								echo "Uploaded by: ";
						?>
                            <a href="/user/?uid=<?php echo $userID; ?>"><?php echo $userName; ?></a>
                        <?php							
							} else {						
								$seg = explode("/", $url);
								$item = "Shared from: ";
								$item .= "<a href='" . $url . "'>";
								if ((substr($seg[2],0,4)) == "www."){
									$item .=  substr($seg[2],4);
								} else {
									$item .=  $seg[2];
								}
								$item .=  "</a>";
								echo $item;
							}
						?>
					</div>
					<div id="itemCat">
                    	<label for="category">Category: </label>
						<?php 
							$catQuery = mysqli_query($connect, "SELECT * FROM categories WHERE categoryID = '$catID'");
							$catCount = mysqli_num_rows($catQuery);
							if ($catCount == 1){
								while ($catRow = mysqli_fetch_assoc($catQuery)){
									$categoryName = $catRow['categoryName'];
									echo "<a href=\"/?category=" . $categoryName . "\">" . $categoryName . "</a>";
								}
							}
							if (isset($id)){
								$getCats = $catID;
								require('../res/category.php');
							}
						?>
					</div>
                    <?php if (isset($id) && $id == $userID){ ?>
                        <div id="itemPrivacy">
                            <label for="itemPrivacy">Shared with: </label>
                            <?php 
								if ($postPrivacy == 1){
									echo "<span class='blue hideThis'>Just me</span>";
								} else {
									echo "<span class='blue hideThis'>Everyone</span>";
								}
							?>
                            <select name="itemPrivacy" id="itemPrivacy">
                            	<?php 
									if ($postPrivacy == 1){ ?>
										<option value="1" selected>Just me</option>
                                        <option value="0">Everyone</option>
									<?php } else { ?>
										<option value="0" selected>Everyone</option>
                                        <option value="1">Just me</option>
									<?php }
								?>
                            </select>
                        </div>
					<?php  } ?>
                    <div id="postShare">
                        <span>Share: </span> 
                        <span id="fblikeholder" class="facebookLike hint--bottom" data-hint="Share on Facebook"><img src="/images/social/facebook.png" alt="Share on Facebook" alt="Share on Facebook" /></span>
                        <a href="https://plus.google.com/share?url=www.its-xmas.co.uk/post/?id=<?php echo $postID; ?>" onClick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="hint--bottom" data-hint="Share on Google+"><img
  src="/images/social/google.png" alt="Share on Google+"/></a>
                       <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" class="hint--bottom" data-hint="Pin on Pinterest">
                            <img src="/images/social/pinterest.png" alt="Pinterest pin-it button">
                        </a>
                       <a href="https://twitter.com/share?via=NowItsChristmas&amp;text=<?php echo $title; ?> on It's Christmas http://www.its-xmas.co.uk/<?php echo $_SERVER["REQUEST_URI"]; ?>" target="_blank" class="hint--bottom" data-hint="Tweet page"><img src="/images/social/twitter.png" alt="Share with Twitter"/></a> 
                    </div>
                    <?php if (isset($id) && $userID == $id){ ?>
                    	<input type="hidden" name="userID" id="userID" value="<?php echo $userID; ?>" />
                        <input type="hidden" name="postID" id="postID" value="<?php echo $postID; ?>" />
                        <div id="editPost">
                            <a id="addEdit" href="#">Edit post</a>
                            <button>Edit post</button>
                        </div>
                        <div id="deletePost">
                            <a href="/process/deletePost.php?postid=<?php echo $postid; ?>&userid=<?php echo $userID; ?>&deletecode=<?php echo md5($postid)?><?php echo md5($userID); ?>">
                                Delete post
                            </a>
                        </div>
                	<?php } ?>
                    <div id="relatedPosts">
                    <h3>Related posts</h3>
                    <ul>
                    <?php 
                        $categoryRelated = mysqli_query($connect, "SELECT * FROM posts WHERE categoryID = '$catID' AND postID != '$postid' AND postHidden = '0' AND postPrivacy = '0' ORDER BY 'postDate' LIMIT 3");
                        $categoryRelatedRows = mysqli_num_rows($categoryRelated);
                        while ($categoryRelatedRow = mysqli_fetch_array($categoryRelated)){ ?>
                            <li>
                                <a href="/post/?id=<?php echo $categoryRelatedRow['postID']; ?>">
                                    <?php if ($categoryRelatedRow['postType'] == "text"){ ?>
                                        <div class="textImage">
                                            <span class="icon-write12"></span>
                                        </div>
                                    <?php } else if ($categoryRelatedRow['postType'] == "video")  { ?>
                                        <div class="videoIcon">
                                            <span class="icon-play"></span>
                                         </div>
                                    <?php } else { ?>
                                        <img src="<?php echo $categoryRelatedRow['postImage']; ?>" alt="<?php echo $categoryRelatedRow['postTitle']; ?>" />

                                    <?php } ?>
                                        <span class='relatedPost image'><?php echo $categoryRelatedRow['postTitle']; ?></span>
                                    
                                                               
                                </a>
                                <em>Same category as this post</em>
                            
                            </li>
                            
                        <?php }
                        if ($categoryRelatedRows != 3){
                            $remaining = 3 - $categoryRelatedRows;
                            $userRelated = mysqli_query($connect, "SELECT * FROM posts WHERE userID = '$userID' AND postID != '$postid' AND postHidden = '0' AND postPrivacy = '0' ORDER BY RAND() LIMIT $remaining");
                            $userRelatedRows = mysqli_num_rows($userRelated);
                            while ($userRelatedRow = mysqli_fetch_array($userRelated)){?>
                            <li>
                                <a href="/post/?id=<?php echo $userRelatedRow['postID']; ?>">
                                    <?php if ($userRelatedRow['postType'] == "text"){ ?>
                                        <div class="textImage">
                                            <span class="icon-write12"></span>
                                        </div>
                                    <?php } else if ($userRelatedRow['postType'] == "video")  { ?>
                                        <div class="videoIcon">
                                            <span class="icon-play"></span>
                                         </div>
                                    <?php } else { ?>
                                        <img src="<?php echo $userRelatedRow['postImage']; ?>" alt="<?php echo $userRelatedRow['postTitle']; ?>" />
                                        
                                        
                                    <?php } ?>
                                        <span class='relatedPost image'><?php echo $userRelatedRow['postTitle']; ?></span>
                                    
                                                               
                                </a>
                                <em>Same poster</em>
                            
                            </li>
                            
                        <?php }
							$remaining = $remaining - $userRelatedRows;
							if ($remaining == '3'){
									echo "<li><em>There are no related posts</em></li>";
								
								
							}
                        }
                         
                        
                
                    ?>
                    </ul>
                </div>
				</div>
               <?php if (isset($id) && $userID == $id){ ?>
        	</form>
        <?php } ?>
				
				<div id="comments">
				<h2>Comments</h2><a name="comments">&nbsp;</a>

				<?php 
					if(isset($_REQUEST['comment'])){
						$comment = $_REQUEST['comment'];

						if ($comment == 'fail'){
							echo "<p class='errorMsg'>Unfortunately, there has been an error.</p>";
						} else if ($comment == 'success'){
							if (isset($_REQUEST['moderate'])){
								$moderate = $_REQUEST['moderate'];
								if ($moderate == "true"){
									echo "<p class='successMsg'>We're just checking out your comment.</p>";
								} else {
									echo "<p class='successMsg'>Your comment has been posted.</p>";
								}
							} else {
								echo "<p class='successMsg'>Your comment has been posted.</p>";
							}
						}

						


					}

				require_once('comments.php'); ?>

    
			</div>
            
            <?php require('../res/admin.php'); ?>

    	<?php
		} else {
			?>
            <title>No post found | It's Christmas</title>
			</head>
            <body>
            <?php require('../res/headnav.php'); ?>
            <div id="container">
                <div id='itemPost'>
					<div class='errorNoItems error'>It'll be lonely this Christmas, with no posts no hold</div>
                </div>
            <?php
		} 
		require_once('../res/listOverlay.php'); 
		require_once('../res/reportOverlay.php');
		require('../res/sidebars.php'); ?>
	
</div>



    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
			$(function(){
				/*if ($("textarea:visible").length > 0) {
					CKEDITOR.replace( 'postDescriptionInput' );
					CKEDITOR.replace( 'itemText' );
				}*/
				$(".commentActionsReply").click(function(){
					var parent = $(this).parents('.comment');
					parent.next(".comment.reply").toggle();	
				});
			});
			
			$(document).on("click", "#editTextPost", function(){
				$("textarea#itemText, #editTextPostButton").show();
				$("#itemImgText, #editTextPost").hide();
			});
			$(document).on("click", "#cancelEditTextPost", function(){
				$("textarea#itemText, #editTextPostButton").hide();
				$("#itemImgText, #editTextPost").show();
			});
			
		</script>
        <script src="https://apis.google.com/js/plusone.js"></script>
</body>
</html>