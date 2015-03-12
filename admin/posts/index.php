<?php require('../../res/meta.php'); ?>
<?php require('../../res/admin/meta.php'); ?>
 <title>Posts | Admin | It's Christmas</title>
 </head>
<body class="admin">
<?php require('../../res/admin/header.php'); ?>

	<main>
		<div class="breadcrumb">
			<ul>
				<li><a href="/admin/">Admin dashboard</a></li>
			</ul>
		</div>
		<div class="wrapper">

			<h1>Posts</h1>
			<?php 
				$postQuery = mysqli_query($connect, "SELECT * FROM posts INNER JOIN users on (posts.userID = users.userID) INNER JOIN categories on (posts.categoryID = categories.categoryID) ORDER BY postDate DESC");
				$postCount = mysqli_num_rows($postQuery);

				if ($postCount > 0){ ?>
					<table>
						<thead>
							<tr>
								<th>Post ID</th>
								<th style='width:40%;'>Post Title</th>
								<th>Category</th>
								<th>User</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while($postRow = mysqli_fetch_array($postQuery)){
								?>
								<tr>
									<td><?php echo $postRow['postID']; ?></td>
									<td><a href="/admin/posts/post/?id=<?php echo $postRow['postID']; ?>"><?php echo $postRow['postTitle']; ?><a/></td>
									<td><?php echo $postRow['categoryName']; ?></td>
									<td><?php echo $postRow['userName']; ?></td>
									<td><?php echo $postRow['postDate']; ?></td>
								</tr>
								<?php
							}
						?>
						</tbody>
					</table>
					<?php
				}
			?>
				
		</div>
	</main>


</body>
</html>