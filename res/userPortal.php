<div id="userPortal">
<?php
if (isset($xID) && $xUser == true){ ?>
	
	<?php
		if (isset($notificationCount) && $notificationCount > 0){
		?>
			<a href="/member/notifications/" class="unread pull-right"><?php echo $notificationCount; ?></a>
		<?php
		}
	?>
	<ul  class='pull-right'>
		<li>
			<?php 
				if ($userAvatarBool){
					echo '<img src="' . $userAvatar . '" alt="Icon" width="30"/>'; 
				}
			?>			
			<ul>
				<?php
					$userPortalAdminCheck = mysqli_query($connect, "SELECT * FROM admin WHERE userID = '$xID'");
					$userPortalAdminRows = mysqli_num_rows($userPortalAdminCheck);
					if ($userPortalAdminRows == 1){
						echo "<li><a href='/admin/'>Admin CMS</a></li>";
					}
				?>
				<li><a href="/member/my-christmas/">My Christmas</a></li>
				<li><a href="/member/notifications/">Notifications (<?php echo $notificationCount; ?>)</a></li>
				<li><a href="/member/nice-list/">Nice list</a></li>
				<li><a href="/member/naughty-list/">Naughty list</a></li>
				<li><a href="/logout/">Log out</a></li>
			</ul>
		</li>
	</ul>
	<a href="/member/my-christmas/" class='pull-right'><?php if (isset($xUsername)){echo $xUsername;} ?></a>
<?php
} else {
	?>
	<a href="/register/" class='pull-right'>Register</a>
	<a href="/login/" class='pull-right'>Login</a>
	<?php
}
?>
</div>