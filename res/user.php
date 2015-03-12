<?php 
session_start();
if (isset($id)){

} else {
	if (isset($_SESSION)){
		if (isset($_SESSION['id'])){
			$id = $_SESSION['id'];
		}
		if (isset($_SESSION['name'])){
			$name = $_SESSION['name'];
		}
		if (isset($_COOKIE['username'])){
			$uu = $_COOKIE['username'];
		}
		if (isset($uu)){
			$uuCookie = mysqli_query($connect, "SELECT * FROM users WHERE userName = '$uu'");
			if (mysqli_num_rows($uuCookie)){
				while($uuRow = mysqli_fetch_array($uuCookie)){
					$id = $uuRow['userID'];
					$name = $uu;	
				}
			}
		}
	} else {
		$id = false;
	}
}
?>