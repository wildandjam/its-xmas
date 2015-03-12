<?php
	if ($definitionNeeded){
		echo "<div class='definitionBox'>";
		echo "<div class='definitionIcon'></div>";
		switch($definitionNeeded){
			case "my-christmas":
				require('terms/my-christmas.php');
				break;
			case "collection":
				require('terms/collection.php');
				break;
			case "nice-list":
				require('terms/nice-list.php');
				break;
			case "naughty-list":
				require('terms/naughty-list.php');
				break;
		}
		echo "</div>";
	}

	$definitionNeeded = "";
?>