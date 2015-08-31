<div class='item' data-id='<?php echo $postID; ?>' data-token='<?php echo $id ?>'>
    <div class="itemImg">
        <a href="/post/?id=<?php echo $postID; ?>" class="hint--bottom" data-hint="<?php echo $title; ?>">
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
            <div class="itemHover"><span><?php echo $title; ?></span></div>
        </a>
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