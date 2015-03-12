<?php

	$url = split("index_real.php", $_SERVER["REQUEST_URI"]);
	
	if ($url[1]){
		$newurl = "/" . $url[1];
	} else {
		$newurl = "/";
	}
	header("location: " . $newurl);

?>