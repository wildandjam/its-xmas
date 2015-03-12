<?php require('../res/meta.php'); ?>
<?php require('../res/admin/meta.php'); ?>
 <title>Admin | It's Christmas</title>
 </head>
<body class="admin">
<?php require('../res/admin/header.php'); ?>

	<main>
		<div class="wrapper">

			<div id="dashboard">
				<div id="userDashboard">
					<h2><a href="/admin/users">Users</a></h2>
					<h3>No. of Users</h3>
					<h4>
						<?php 
							$userQuery = mysqli_query($connect, "SELECT * FROM users");
							$userCount = mysqli_num_rows($userQuery);

							echo $userCount;
						?>
					</h4>
					<h3>No. of Unauthorised</h3>
					<h4>
						<?php 
							$authQuery = mysqli_query($connect, "SELECT * FROM users WHERE userAuth ='0'");
							$authCount = mysqli_num_rows($authQuery);

							echo $authCount;
						?>
					</h4>
					<h3>No. of Moderated</h3>
					<h4>
						<?php 
							$moderateUserQuery = mysqli_query($connect, "SELECT * FROM users WHERE userModerated ='1'");
							$moderateUserCount = mysqli_num_rows($moderateUserQuery);

							echo $moderateUserCount;
						?>
					</h4>
				</div>
				<div id="postDashboard">
					<h2><a href="/admin/posts">Posts</a></h2>
					<h3>No. of Posts</h3>
					<h4>
						<?php 
							$postQuery = mysqli_query($connect, "SELECT * FROM posts");
							$postCount = mysqli_num_rows($postQuery);

							echo $postCount;
						?>
					</h4>
					<h3>No. of Posts Moderated</h3>
					<h4>
						<?php 
							$moderatePostQuery = mysqli_query($connect, "SELECT * FROM posts WHERE postModerated ='1'");
							$moderatePostCount = mysqli_num_rows($moderatePostQuery);

							echo $moderatePostCount;
						?>
					</h4>
				</div>
				<div id="commentDashboard">
					<h2><a href="/admin/comments">Comments</a></h2>
					<h3>No. of Comments</h3>
					<h4>
						<?php 
							$commentsQuery = mysqli_query($connect, "SELECT * FROM comments");
							$commentsCount = mysqli_num_rows($commentsQuery);

							echo $commentsCount;
						?>
					</h4>
				</div>

			</div>
		</div>
	</main>


</body>
</html>