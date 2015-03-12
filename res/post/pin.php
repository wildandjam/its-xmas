<div class='item'>
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
			<?php 
					}
				} else { ?>
	            <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" onError="this.onerror=null;this.src='/images/errorImage.jpg';" />
            <?php } ?>
        </a>
        
        
    </div>
    <div class="itemTitle">
        <a href="/post/?id=<?php echo $postID; ?>"><?php echo $title; ?></a>
    </div>
    <div class="itemActions" data-id='<?php echo $postID; ?>' data-token='<?php echo $id ?>' data-userid='<?php echo $userID; ?>'>
	 </a>
		<?php 
			if (isset($id) && $id != $userID){
				if (isset($likeStatus) && $likeStatus == "like"){
					echo "<span class=\"likePost on hint--bottom\" data-hint=\"Liked!\"></span>";
				} else {
					echo "<span class=\"likePost hint--bottom\" data-hint=\"Like post\"></span>";
				} 
	
				if (isset($likeStatus) && $likeStatus == "dislike"){
					echo "<span class=\"dislikePost on  hint--bottom\" data-hint=\"Disliked!\"></span>";
				} else {
					echo "<span class=\"dislikePost hint--bottom\" data-hint=\"Dislike post\"></span>";
				} 
			}
        		if ($inlist  == true){
        	?>
        		 <span class="collection on hint--bottom" data-hint="Collection Options"></span>
        		<?php
        		} else {
        		?>
        		 <span class="collection hint--bottom" data-hint="Collection Options"></span>
        		 <?php
        		}
        		?>
        <?php if (isset($id) && $id != $userID){ 
				if ($isFriend == "yes"){ ?>
                	<a class="itemFriend on hint--bottom" data-hint="<?php echo $username; ?>" href="/user/?uid=<?php echo $userID ?>"></a>
                <?php } else { ?>
		        	<a class="itemFriend hint--bottom" data-hint="<?php echo $username; ?>" href="/user/?uid=<?php echo $userID ?>"></a>
        <?php 	}
		} ?>
        <span class="report hint--bottom" data-hint="Report post"></span></span>
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
