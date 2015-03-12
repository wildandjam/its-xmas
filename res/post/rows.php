<div class='item' data-id='<?php echo $postID; ?>' data-token='<?php echo $id ?>'>
	<div class="itemUserBox">
    	<div class="itemUserAvatar">
        	<span class="avatar small <?php echo $avatarSpan; ?>" style="color:<?php echo $userAvatarFore; ?>;background:<?php echo $userAvatarBack; ?>;"></span>
        </div>
        <div class="itemAuthor">
        	<a href="/user/?uid=<?php echo $userID ?>"><?php echo $username; ?></a>
        </div>
    </div>
    
    <div class="itemInfo">
    	<div class="itemImg">
        	<?php if ($postType == "text"){ ?>
				<a href="/post/?id=<?php echo $postID; ?>">
                	<?php echo $image; ?>
                </a>
            <?php } else if ($postType == "video"){ ?>
            
            		<script type="text/javascript">
					$(function(){
						jwplayer("videoP<?php echo $postID; ?>").setup({
							file: "<?php echo $url; ?>",
							width: 640,
							height: 360
						});
					});
					</script>
            
                	<div id="videoP<?php echo $postID; ?>"></div>
                
                
			<?php } else { ?>
                <a href="/post/?id=<?php echo $postID; ?>">
                    <img src="<?php echo $image; ?>"  onError="this.onerror=null;this.src='/images/errorImage.jpg';"/>
                </a>
            <?php } ?>
        </div>
        <div class="itemTitle">
            <a href="/post/?id=<?php echo $postID; ?>"><?php echo $title; ?></a>
        </div>
        <div class="itemDesc">
        	<p><?php echo $postDesc; ?></p>
        </div>
        <div class="itemCategory">
        	Category: <a href="/?category=<?php echo $categoryName; ?>"><?php echo $categoryName; ?></a>
        </div>
        <?php if ($url) { ?>
            <div class="itemFrom">
                <?php echo $itemURL; ?>
            </div>
        <?php } ?>
        <div class="itemAuthor">
        	Posted by: <a href="/user/?uid=<?php echo $userID ?>"><?php echo $username; ?></a>
        </div>
        <div class="itemLikes">
        	<?php echo $likeInfoCount; ?> likes
        </div>
        <div class="itemDislikes">
        	<?php echo $dislikeInfoCount; ?> dislikes
        </div>
        <?php 
		if ($deletetype){
			if ($id == $deleteuserid){
				switch($deletetype){
					case "collection":
						echo "<a class='removeFromCollection' href='/process/deletefromcollection.php?listID=" . $deletelistid . "&postID=" .  $postID . "'>Remove from collection</a>";
						break;
					
				
				}
			}
		} 
		?>
    </div>
     
</div>
