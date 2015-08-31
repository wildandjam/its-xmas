<header style="height:auto;">
	<a href="/admin/">It's Christmas - Admin area</a>
	<div id='loggedInAs'>
		Logged in as 
		<?php 
			if (isset($xID)){
				$userNameQuery = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$id'");
				$userNameRows = mysqli_num_rows($userNameQuery);
				if ($userNameRows == '1'){
					while($userNameRow = mysqli_fetch_array($userNameQuery)){
						echo $userNameRow['userName'];
					}
				}
			}
		?>
	</div>
</header>
<nav>
	<ul>
		<li><a href="/admin/users">Users</a></li>
		<li><a href="/admin/posts">Posts</a></li>
		<li><a href="/admin/content">Content/SEO</a></li>
		<li><a href="/admin/feedback">Feedback</a></li>
		<li><a href="http://disqus.com">Comments Login</a></li>
		<li><a href="/blog/wp-login.php">Blog Login</a></li>
	</ul>
</nav>