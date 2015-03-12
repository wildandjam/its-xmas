<?php require('../../../res/meta.php'); ?>
<?php require('../../../res/admin/meta.php'); ?>
<?php
	if (isset($_REQUEST['id'])){
		$postID = $_REQUEST['id'];
		$postQuery = mysqli_query($connect, "SELECT * FROM posts WHERE postID = '$postID'");
		if (mysqli_num_rows($postQuery) == 1){
			while ($postRow = mysqli_fetch_array($postQuery)){
				$userID = $postRow['userID'];
				$categoryID = $postRow['categoryID'];
				$postType = $postRow['postType'];
				$postTitle = $postRow['postTitle'];
				$postDesc = $postRow['postDesc'];
				$postURL = $postRow['postURL'];
				$postImage = $postRow['postImage'];
				$postDate = $postRow['postDate'];
				$postPrivacy = $postRow['postPrivacy'];
				$postModerated = $postRow['postModerated'];
			}
		} else {
			header("location: /admin/posts/");	
		}

	} else {
		header("location: /admin/posts/");
	}
?>
 <title>Posts | Admin | It's Christmas</title>
 </head>
<body class="admin">
<?php require('../../../res/admin/header.php'); ?>

	<main>
		<div class="breadcrumb">
			<ul>
				<li><a href="/admin/">Admin dashboard</a></li>
				<li><a href="/admin/posts/">Posts</a></li>
			</ul>
		</div>
		<div class="wrapper">
			<h1><?php echo $postTitle; ?></h1>
			<form>
				<div class="row">
					<label>Post ID</label>
					<input type="text" id="postID" name="postID" value="<?php echo $postID; ?>" />
				</div>
				<div class="row">
					<label>User ID</label>
					<input type="text" id="userID" name="userID" value="<?php echo $userID; ?>" />
				</div>
				<div class="row">
					<label>Category ID</label>
					<input type="text" id="categoryID" name="categoryID" value="<?php echo $categoryID; ?>" />
				</div>
				<div class="row">
					<label>Post Type</label>
					<input type="text" id="postType" name="postType" value="<?php echo $postType; ?>" />
				</div>
				<div class="row">
					<label>Post Title</label>
					<input type="text" id="postTitle" name="postTitle" value="<?php echo $postTitle; ?>" />
				</div>
				<div class="row">
					<label>Post Description</label>
					<textarea type="text" id="postDesc" name="postDesc">
						<?php echo $postDesc; ?>
					</textarea>
				</div>
				<div class="row">
					<label>Post Link</label>
					<input type="text" id="postTitle" name="postTitle" value="<?php echo $postTitle; ?>" />
				</div>
			</form>	
		</div>
	</main>


</body>
</html>