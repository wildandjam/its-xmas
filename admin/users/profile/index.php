<?php require('../../../res/meta.php'); ?>
<?php require('../../../res/admin/meta.php'); ?>
<?php 
	if (isset($_REQUEST['id'])){
		$profileID = $_REQUEST['id'];
		$profileMySQL = "SELECT * FROM users INNER JOIN userdetails ON (users.userID = userdetails.userID) WHERE users.userID = '$profileID'";
		$profileQuery = mysqli_query($connect, $profileMySQL);
		if (mysqli_num_rows($profileQuery) == 1){
			while($profileRow = mysqli_fetch_array($profileQuery)){
				$profileName = $profileRow['userName'];
			}
			$profile = true;
		} else {
			$profile = false;
			$profileFalseQuery = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$profileID'");
			if (mysqli_num_rows($profileFalseQuery) == 1){
				while($profileFalseRow = mysqli_fetch_array($profileFalseQuery)){
					$profileName = $profileFalseRow['userName'];
				}
				$profile = true;
			}

		}
	} else {
		header("location:/admin/users/");
	}

?>
 <title><?php echo $profileName; ?> | Admin | It's Christmas</title>
 </head>
<body class="admin">
<?php require('../../../res/admin/header.php'); ?>

	<main>
		<div class="breadcrumb">
			<ul>
				<li><a href="/admin/">Admin dashboard</a></li>
				<li><a href="/admin/users/">Users</a></li>
			</ul>
		</div>
		<div class="wrapper">
			<h1><?php echo $profileName; ?></h1>
		</div>
	</main>


</body>
</html>