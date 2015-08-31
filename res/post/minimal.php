<div class='item' data-id='<?php echo $postID; ?>' data-token='<?php echo $id ?>'>
    <div class="itemImg">
        <a href="/post/?id=<?php echo $postID; ?>">
           	<?php if ($postType == "text"){ ?>
				<div class="textImage">
                	<span class="icon-write12"></span>
                    
                </div>
            <?php } else if ($postType == "video"){ 
					if ($postImageRotate != '0' && $postImageRotate != ""){ ?>
						<img src="<?php echo $postImageRotate; ?>" alt="<?php echo $title; ?>" />
                        <img src="/images/icon/video.png" alt="Video icon" class="videoIcon"/>
			<?php	} else {
			?>
            			<div class="videoIcon">
                            <span class="icon-play"></span>
                         </div>
            		
			<?php 
					}
				} else { ?>
	            <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" onError="this.onerror=null;this.src='/images/errorImage.jpg';" />
            <?php } ?>
        </a>
    </div>
    <div class="itemInfo">
        <div class="itemTitle">
            <a href="/post/?id=<?php echo $postID; ?>"><?php echo $title; ?></a>
        </div>
        <div class="itemCategory">
        	Category: <a href="/posts/?category=<?php echo $categoryName; ?>"><?php echo $categoryName; ?></a>
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
		if (isset($deletetype)){
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
