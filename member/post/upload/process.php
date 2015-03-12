<?php 
require('../../../res/user.php');
require('../../../res/connect.php');

print_r($_REQUEST);
/*$target = "../../../images/user/"; 
$target = $target . basename($_FILES['filename']['name']); 
$filename = basename($_FILES['filename']['name']);
$date = date('Y-m-d');
//print_r($_FILES,true);
print "Received {$_FILES['filename']['name']} - its size is {$_FILES['filename']['size']}";


if ($_FILES['filename']['error'] === UPLOAD_ERR_OK) {
  echo "... upload was successful ...";
} else {
   die("Upload failed with error code " . $_FILES['filename']['error']);
}*/



 //Writes the photo to the server 
/*if(move_uploaded_file($_FILES['filename']['tmp_name'], $target)){ 
	//Writes the information to the database 
	mysqli_query($connect, "INSERT INTO uploads VALUES ('', '$id', '1', '$filename', '$date')") or die(mysql_error());  
 
	 //Tells you if its all ok 
    echo "The file ". basename( $_FILES['filename']['name']). " has been uploaded, and your information has been added to the directory";
	header('location: /member/post/post-it/?user=1&url=0&image=' . $target . ''); 
	
	
} else {  
	 //Gives and error if its not 
	 echo "Sorry, there was a problem uploading your file."; 
} */
?>