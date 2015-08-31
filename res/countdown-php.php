<?php
date_default_timezone_set('Europe/London');
$today = $date = date('Y-m-d H:i');
$datetime1 = strtotime('2015-12-24 23:00');
$datetime2 = strtotime($today);
$interval = $datetime1-$datetime2;
if (isset($xID)){
	$prefCount = mysqli_query($connect, "SELECT * FROM preferences WHERE userID = '$xID'");
	if (mysqli_num_rows($prefCount) == 1){
		while($prefRow = mysqli_fetch_array($prefCount)){
			$type = $prefRow['countdownType'];	
		}
	} else {
		echo "nocount";
		if (isset($_REQUEST['type'])){
			$type = $_REQUEST['type'];
		} else {
			$type = "days";	
		}
	}
} else {
	if (isset($_REQUEST['type'])){
		$type = $_REQUEST['type'];
	} else {
		$type = "days";	
	}
}

if (!isset($type)){
	$type = "days";	
}
switch ($type){
	case "weeks":
		$weeks = floor($interval / 604800);
		if ($weeks == 1){
			$weeks = $weeks . " week";
		} else {
			$weeks = $weeks . " weeks";
		}
		$days = floor(($interval - ($weeks * 604800)) / 86400);
		if ($days == 1){
			$days = $days . " day";
		} else {
			$days = $days . " days";
		} 
		$hours = floor(($interval - ($weeks * 604800) - ($days * 86400)) / 3600);
		if ($hours == 1){
			$hours = $hours . " hour";
		} else {
			$hours = $hours . " hours";
		} 
		$minutes = floor(($interval - ($weeks * 604800) - ($days * 86400) - ($hours * 3600))/60);
		if ($minutes == 1){
			$minutes = $minutes . " minute";
		} else {
			$minutes = $minutes . " minutes";
		} 
		$countphp = "in " . $weeks . ", ". $days . ", ". $hours . " and " . $minutes;
		$ogurl = "http://www.its-xmas.co.uk/countdown/?type=weeks";
		break;
	case "days":
		$days = floor($interval / 86400);
		if ($days == 1){
			$days = $days . " day";
		} else {
			$days = $days . " days";
		} 
		$hours = floor(($interval - ($days * 86400)) / 3600);
		if ($hours == 1){
			$hours = $hours . " hour";
		} else {
			$hours = $hours . " hours";
		} 
		$minutes = floor(($interval - ($days * 86400) - ($hours * 3600))/60);
		if ($minutes == 1){
			$minutes = $minutes . " minute";
		} else {
			$minutes = $minutes . " minutes";
		} 
		$countphp = "in " . $days . ", ". $hours . " and " . $minutes;
		$ogurl = "http://www.its-xmas.co.uk/countdown/";
		break;
	case "hours":
		$hours = floor($interval / 3600);
		if ($hours == 1){
			$hours = number_format($hours) . " hour";
		} else {
			$hours = number_format($hours) . " hours";
		} 
		$minutes = floor(($interval - ($hours * 3600))/60);
		if ($minutes == 1){
			$minutes = number_format($minutes) . " minute";
		} else {
			$minutes = number_format($minutes) . " minutes";
		} 
		$countphp = "in " . $hours . " and " . $minutes;
		$ogurl = "http://www.its-xmas.co.uk/countdown/?type=hours";
		break;
	case "minutes":
		$minutes = floor($interval/60);
		if ($minutes == 1){
			$minutes = number_format($minutes) . " minute";
		} else {
			$minutes = number_format($minutes) . " minutes";
		} 
		$countphp = "in " . $minutes;
		$ogurl = "http://www.its-xmas.co.uk/countdown/?type=minutes";
		break;
	case "seconds":
		$seconds = floor($interval);
		if ($seconds == 1){
			$seconds = number_format($seconds) . " second";
		} else {
			$seconds = number_format($seconds) . " seconds";
		} 
		$countphp = "in " . $seconds;
		$ogurl = "http://www.its-xmas.co.uk/countdown/?type=seconds";
		break;
	default:
		break;

}	
?>