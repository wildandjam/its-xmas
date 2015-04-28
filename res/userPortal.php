<div id="userPortal">
<?php
if ($xUser == true){ ?>
	<a href="/member/my-christmas/"><?php if (isset($xUsername)){echo $xUsername;} ?></a>
	<ul>
		<li>
			<?php 
				if ($userAvatarBool){
					echo '<img src="' . $userAvatar . '" alt="Icon" width="30"/>'; 
				} else {
					echo '<img src="http://www.placehold.it/30x30" alt="Icon" />';
				}

			?>

			
			<ul>
				<li><a href="/member/my-christmas/">My Christmas</a></li>
				<li><a href="/member/notifications/">Notifications (<?php echo $notificationCount; ?>)</a></li>
				<li><a href="/member/nice-list/">Nice list</a></li>
				<li><a href="/member/naughty-list/">Naughty list</a></li>
				<li><a href="/logout/">Log out</a></li>
			</ul>
		</li>
	</ul>
<?php
} else {
	?>
	<a href="/register/">Register</a>
	<a href="/login/">Login</a>
	<?php
}
?>
</div>