<?php require('../../../res/meta.php'); ?>
<?php require('../../../res/membercheck.php'); ?>
<title>Avatar upload | It's Christmas</title>
</head>
<body>
<?php require('../../../res/headnav.php'); ?>
<div id="container" class="avatarUpload">
	<form action="/process/avatarUpload.php" method="post" enctype="multipart/form-data">
	    Select image to upload:
	    <input type="file" name="fileToUpload" id="fileToUpload">
	    <input type="submit" value="Upload Image" name="submit">
	</form>
</div>
</body>
</html>