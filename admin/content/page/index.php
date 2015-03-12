<?php require('../../../res/meta.php'); ?>
<?php require('../../../res/admin/meta.php'); ?>
<?php 
	if (isset($_REQUEST['id'])){
		$pageID = $_REQUEST['id'];
		$contentQuery = mysqli_query($connect, "SELECT * FROM seo WHERE pageID = '$pageID'");
		$contentCount = mysqli_num_rows($contentQuery);

		if ($contentCount > 0){ 
			while($contentRow = mysqli_fetch_array($contentQuery)){
				$seoID = $contentRow['seoID'];
				$pageID = $contentRow['pageID'];
				$pageTitle = $contentRow['pageTitle'];
				$pageDescription = $contentRow['pageDescription'];
				$pageKeywords = $contentRow['pageKeywords'];
				$pageImage = $contentRow['pageImage'];
			}
		}
	} else {
		header("location:/admin/content/");
	}
?>
<title><?php echo $pageTitle; ?> | Content | Admin | It's Christmas</title>
</head>
<body class="admin">
<?php require('../../../res/admin/header.php'); ?>

	<main>
		<div class="breadcrumb">
			<ul>
				<li><a href="/admin/">Admin dashboard</a></li>
				<li><a href="/admin/content/">Content/SEO</a></li>
			</ul>
		</div>
		<div class="wrapper">
			<h1><?php echo $pageTitle; ?></h1>
			<form>
				<div class="row">
					<label>SEO ID</label>
					<input type="text" id="seoID" name="seoID" value="<?php echo $seoID; ?>" />
				</div>
				<div class="row">
					<label>Page ID</label>
					<input type="text" id="pageID" name="pageID" value="<?php echo $pageID; ?>" />
				</div>
				<div class="row">
					<label>Page Title</label>
					<input type="text" id="pageTitle" name="pageTitle" value="<?php echo $pageTitle; ?>" />
				</div>
				<div class="row">
					<label>Page Description</label>
					<textarea id="pageDescription" name="pageDescription">
						<?php echo $pageDescription; ?>
					</textarea>
				</div>
				<div class="row">
					<label>Page Keywords</label>
					<input type="text" id="pageKeywords" name="pageKeywords" value="<?php echo $pageKeywords; ?>" />
				</div>
				<div class="row">
					<label>Page Image</label>
					<input type="text" id="pageImage" name="pageImage" value="<?php echo $pageImage; ?>" />
				</div>
				<div class="row">
					<button>Update</button>
				</div>
			</form>
			
				
		</div>
	</main>


</body>
</html>