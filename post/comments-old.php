<?php 
	if (isset($postID)){
		$commentQuery = mysqli_query($connect, "SELECT * FROM comments INNER JOIN users ON (comments.userID = users.userID) WHERE postID = '$postID' AND commentDeleted = '0' AND commentInReplyTo = '0'");
		$commentCount = mysqli_num_rows($commentQuery);
		if ($commentCount > 0){
			while($commentRow = mysqli_fetch_array($commentQuery)){
				$commentID = $commentRow['commentID'];
				$postID = $commentRow['postID'];
				$userID = $commentRow['userID'];
				$commentUserName = $commentRow['userName'];
				$commentMessage = $commentRow['commentMessage'];
				$commentDate = $commentRow['commentDate'];
				$commentReplied = $commentRow['commentInReplyTo'];
				?>
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
								<div class='commentActionsLike'>Like</div>
								<div class='commentActionsDislike'>Dislike</div>
								<div class='commentActionsReply'>Reply</div>
								<div class='commentActionsReport'><a href="/process/reportComment.php?userID=<?php echo $id; ?>&postID=<?php echo $postID; ?>&commentID=<?php echo $commentID; ?>">Report</a></div>
							</div>
							<div class='commentDate'>
								<?php echo $commentDate; ?>
							</div>
						</div>
					</div>
					<div class="comment addArea reply">
						<div class="userArea">
							<?php 
								$idUser = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$id'");
								if (mysqli_num_rows($idUser) == 1){
									while ($idRow = mysqli_fetch_array($idUser)){
										echo "<a href='/user/?uid=" . $idRow['userID'] . "''>" . $idRow['userName'] . "</a>";
									}
								}


							?>
						</div>
						<div class="commentArea">
							<form id="addReplyComment" name="addReplyComment" method="post" action="/process/addComment.php">
								<textarea id="replyCommentMessage" name="replyCommentMessage" placeholder="Comment">
								</textarea>
								<input type="hidden" id="replyCommentPostID" name="replyCommentPostID" value="<?php echo $postID; ?>" />
								<input type="hidden" id="replyCommentUserID" name="replyCommentUserID" value="<?php echo $id; ?>" />
								<input type="hidden" id="replyCommentID" name="replyCommentID" value="<?php echo $commentID; ?>" />
								<input type="hidden" id="commentType" name='commentType' value="reply" />
								<button>Submit</button>
							</form>
						</div>
					</div>
					<?php

					$replyQuery = mysqli_query($connect, "SELECT * FROM comments INNER JOIN users ON (comments.userID = users.userID) WHERE postID = '$postID' AND commentDeleted = '0' AND commentInReplyTo = '$commentID'");
					$replyCount = mysqli_num_rows($replyQuery);

					if ($replyCount > 0){
						while($replyRow = mysqli_fetch_array($replyQuery)){
							$replyCommentID = $replyRow['commentID'];
							$replyPostID = $replyRow['postID'];
							$replyUserID = $replyRow['userID'];
							$replyUserName = $replyRow['userName'];
							$replyCommentMessage = $replyRow['commentMessage'];
							$replyCommentDate = $replyRow['commentDate'];
							$replyCommentReplied = $replyRow['commentInReplyTo'];
							?>
							<div class='comment' data-commentid="<?php echo $replyCommentID; ?>">
								<div class="userArea">
									<?php
										$replyAvatarQuery = mysqli_query($connect, "SELECT * FROM userAvatars WHERE userID = '$replyUserID' AND userAvatarSelected ='1'");
										$replyAvatarCount = mysqli_num_rows($replyAvatarQuery);
										if ($replyAvatarCount == 1){
											while($replyAvatarRow = mysqli_fetch_object($replyAvatarQuery)){
												echo "<img src='/images/avatars/" . $replyAvatarRow->userAvatarSrc . "' alt=" . $replyUserName . "' width='50' /><br />";
											}
										}

									?>
									<a href='/user?uid=<?php echo $userID; ?>'><?php echo $replyUserName; ?></a>
								</div>
								<div class="commentArea">
									<div class='commentMessage'>
										<?php echo $replyCommentMessage; ?>
									</div>
									<div class='commentActions'>
										<div class='commentActionsLike'>Like</div>
										<div class='commentActionsDislike'>Dislike</div>
										<div class='commentActionsReply'>Reply</div>
										<div class='commentActionsReport'>Report</div>
									</div>
									<div class='commentDate'>
										<?php echo $replyCommentDate; ?>
									</div>
								</div>
							</div>
							<?php
						}
					}
				?>
				</div>
				<?php 
			}
		} else {
			echo "No one has commented on this post yet!";
		}

		if (isset($id)){ ?>
			<div class="comment addArea">
				<div class="userArea">
					<?php 
						$idUser = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$id'");
						if (mysqli_num_rows($idUser) == 1){
							while ($idRow = mysqli_fetch_array($idUser)){
								echo "<a href='/user/?uid=" . $idRow['userID'] . "''>" . $idRow['userName'] . "</a>";
							}
						}


					?>
				</div>
				<div class="commentArea">
					<form id="addSingleComment" name="addSingleComment" method="post" action="/process/addComment.php">
						<textarea id="singleCommentMessage" name="singleCommentMessage" placeholder="Comment">
						</textarea>
						<input type="hidden" id="singleCommentPostID" name="singleCommentPostID" value="<?php echo $postID; ?>" />
						<input type="hidden" id="singleCommentUserID" name="singleCommentUserID" value="<?php echo $id; ?>" />
						<input type="hidden" id="commentType" name='commentType' value="single" />
						<button>Submit</button>
					</form>
				</div>
			</div>
<?php
		} else {
			echo "You have to be logged in to add a comment";			
		}
	}
?>