<?php
require('../res/user.php');
$date = date("Y-m-d H:i:s");
$filename = '../images/user/' . md5($date) . md5($id) .'.jpg';
$status = (boolean) move_uploaded_file($_FILES['photo']['tmp_name'], $filename);

$response = (object) [
	'status' => $status
];

if ($status) {
	$response->url = $filename;
}

echo json_encode($response);

?>