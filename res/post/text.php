<div class="item">
    <div class="itemTitle">
        <a href="/post/?id=<?php echo $postID; ?>"><?php echo $title; ?></a>
    </div>
    <div class="itemInfo">
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
        	<?php echo $likeInfoCount; ?> like<?php if ($likeInfoCount != '1'){ echo "s";}?>
        </div>
        <div class="itemDislikes">
        	<?php echo $dislikeInfoCount; ?> dislike<?php if ($dislikeInfoCount != 1){ echo "s";}?>
        </div>
	</div>
     <?php 
		if ($deletetype){
			if ($id == $deleteuserid){
				switch($deletetype){
					case "collection":
						echo "<a class='deleteClose' href='/process/deletefromcollection.php?listID=" . $deletelistid . "&postID=" .  $postID . "'><span class='icon-close'></span></a>";
						break;
					
				
				}
			}
		} 
		?>
</div>