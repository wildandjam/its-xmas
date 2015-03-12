<?php
	$snow = $_REQUEST['snow'];
	
	if ($snow == 'melt'){
	//add cookie
		setcookie('snow', 'melt', time() + 60*60*24*14, '/');
		header("Location: /iC/index.php");
	} else {
	//clear cookie
		setcookie('snow', '', time() - 60*60*24*14, '/');
		header("Location: /iC/index.php");

	}

?>