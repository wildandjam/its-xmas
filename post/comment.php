
<div class='commentRow'>
	<div class='comment' data-commentid="<?php echo $commentID; ?>">
		<div class="userArea">
			<?php
				$avatarQuery = mysqli_query($connect, "SELECT * FROM userAvatars WHERE userID = '$userID' AND userAvatarSelected ='1'");
				$avatarCount = mysqli_num_rows($avatarQuery);
				if ($avatarCount == 1){
					while($avatarRow = mysqli_fetch_object($avatarQuery)){
						echo "<img src='/images/avatars/" . $avatarRow->userAvatarSrc . "' alt=" . $commentUserName . "' width='50' /><br />";
					}
				}

			?>
			<a href='/user?uid=<?php echo $userID; ?>'><?php echo $commentUserName; ?></a>
		</div>
		<div class="commentArea">
			<div class='commentMessage'>
				<?php echo $commentMessage; ?>
			</div>
			<div class='commentActions'>
				<!--<div class='commentActionsLike'>Like</div>
				<div class='commentActionsDislike'>Dislike</div>-->
				<div class='commentActionsReply'>Reply</div>
				<!--<div class='commentActionsReport'><a href="/process/reportComment.php?userID=<?php echo $id; ?>&postID=<?php echo $postID; ?>&commentID=<?php echo $commentID; ?>">Report</a></div>-->
			</div>
			<div class='commentDate'>
				<?php echo $commentDate; ?>
			</div>
		</div>
	</div>
</div>
<?php
require('reply.php'); ?>
