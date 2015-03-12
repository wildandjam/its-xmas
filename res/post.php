<div class='item' data-id='<?php echo $postID; ?>' data-token='<?php echo $id ?>'>
    <div class="itemImg">
        <a href="/post/?id=<?php echo $postID; ?>">
            <img src="<?php echo $image; ?>" />
        </a>
        
        
    </div>
    <div class="itemTitle">
        <a href="/post/?id=<?php echo $postID; ?>"><?php echo $title; ?></a>
    </div>
    <div class="itemActions">
	
		<?php 
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
		?>
        <span class="rating hint--bottom" data-hint="<?php echo $postRating; ?>% Rating"><span style="width:<?php echo $postRating; ?>%;"></span></span>
        
        <?php
        		if ($inlist  == true){
        	?>
        		 <span class="listAction on hint--bottom" data-hint="List Options"></span>
        		<?php
        		} else {
        		?>
        		 <span class="listAction hint--bottom" data-hint="List Options"></span>
        		 <?php
        		}
        		?>
        <a class="itemFriend hint--bottom" data-hint="<?php echo $username; ?>" href="/user/?uid=<?php echo $userID ?>"></a>
        <span class="report hint--bottom" data-hint="Report post"></span>
    </div>
    <!--<div class="itemRating">
        <span class="blue"><?php echo $postLikes; ?> likes.</span> <span class="dgrey"><?php echo $postDislikes; ?> dislikes.</span>
        
    </div>
    <div class="itemScore">
            <div class="itemPerc" style="width:<?php echo $postRating; ?>%;">
                
            </div>
    </div>-->
    
        <?php 
       /* $ucheck = mysqli_query($connect, "SELECT * FROM users WHERE userID = ". $userID ."");
        $ucount = mysqli_num_rows($ucheck);
        if ($ucount === 1){
            while($urow = mysqli_fetch_assoc($ucheck)) {
                $userName = $urow['userName'];

            }
        ?>
            <div class="itemUser"><a href="/user/?uid=<?php echo $userID; ?>"><?php echo $userName; ?></a></div>
        <?php }	
        if ($url == "0"){
            echo "<div class='itemURL uploaded'>";
            echo "<a href='/user/?uid=" . $userID . "'>";
            echo "Uploaded";
            echo "</a>";
            echo "</div>";
        } else {
            $seg = explode("/", $url);
            if ((substr($seg[2],0,4)) == "www."){
                $str = substr($seg[2],4);
            } else {
                $str = $seg[2];
            }
            echo "<div class='itemURL'>";
            echo "<a href='" . $url . "' title='" . $str . "'>";
            echo $str;
            echo "</a>";
            echo "</div>";
        }*/
        
        ?>
        
</div>