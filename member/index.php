<?php 
	session_start();
	if (isset($_SESSION['username'])){
		$s = $_SESSION['username'];
	}
	if (isset($_REQUEST['from'])){
		$from = $_REQUEST['from'];
	}
	require('../res/connect.php');
	if (isset($s)){
		if ($connect){
			$check = mysqli_query($connect, "SELECT * FROM users WHERE userName='$s'");
			$count = mysqli_num_rows($check);
				if ($count != 1) {
					$msg = "Unfortunately, there is an issue with our system.";
				} else {
					while($row = mysqli_fetch_assoc($check)) {
						$id = $row['userID'];
						$name = $row['userName'];
						$email = $row['userEmail'];
					}
				}
		
		} else {
			$msg =  "Unfortunately there has been an error in our database";
		}
		
	} else {

		if (isset($connect)){
			if (isset($_SESSION['useremail'])){
				$s = $_SESSION['useremail'];
			}
			if (isset($s)){
				$check = mysqli_query($connect, "SELECT * FROM users WHERE userEmail='$s'");
				$count = mysqli_num_rows($check);
				if ($count != 1) {
					$msg = "Unfortunately, there is an issue with our system.";
				} else {
					while($row = mysqli_fetch_assoc($check)) {
						$id = $row['userID'];
						$name = $row['userName'];
						$email = $row['userEmail'];
					}
				}
			}
		
		} else {
			$msg =  "Unfortunately there has been an error in our database";
		}

	}
	if (isset($xID)){
			header("Location: /member/my-christmas/");
	}
?>
<?php 
    $membercheck = true;
	require('../res/meta.php');
?>
<title>You are logged in | It's Christmas</title>
</head>

<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
	<div class="content">
    	You are logged in...
		<?php 
			echo $msg;

		?>
    </div>


</div>



<?php require('../res/sidebars.php'); ?>
</body>
</html>
