<?php require('../../../res/meta.php'); ?>
<?php require('../../../res/admin/meta.php'); ?>
<?php 
	$userID = $_REQUEST['id'];
	$userQuery = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$userID'");
	if (mysqli_num_rows($userQuery) == 1){
		while($userRow = mysqli_fetch_object($userQuery)){
			$proUserName = $userRow->userName;
			$proEmail = $userRow->userEmail;
		}
	}

?>
 <title><?php echo $xUsername; ?> | Admin | It's Christmas</title>
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
			<h1><?php echo $xUsername; ?></h1>
		
			<div class="row">
				<label>User ID</label>
				<input type='text' value='<?php echo $userID; ?>' />
			</div>
			<div class="row">
				<label>Username</label>
				<input type='text' value='<?php echo $proUserName; ?>' />
			</div>
			<div class="row">
				<label>Email</label>
				<input type='text' value='<?php echo $proEmail; ?>' />
			</div>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<label>
					Avatar
				</label>
				<?php
					if ($userAvatarBool){
						echo "<img src=" . $userAvatar . " alt='Avatar ' />";
					}


				?>
			</div>
			<div class="row">
				<label>First name</label>
				<input type='text' value='<?php echo $xFirstName; ?>' />
			</div>
			<div class="row">
				<label>Last name</label>
				<input type='text' value='<?php echo $xLastName; ?>' />
			</div>
			<div class="row">
				<label>Gender</label>
				<input type='text' value='<?php echo $xGender; ?>' />
			</div>
			<div class="row">
				<label>Date of birth</label>
				<input type='text' value='<?php echo $xDOB; ?>' />
			</div>
			<div class="row">
				<label>Location</label>
				<input type='text' value='<?php echo $xLocation; ?>' />
			</div>
			<div class="row">
				<label>Private?</label>
				<input type='checkbox' value='<?php echo $xPrivate; ?>' />
			</div>
			<div class="row">
				<label>Bio</label>
				<textarea><?php echo $xBio; ?></textarea>
			</div>
		</div>
	</main>
</body>
</html>