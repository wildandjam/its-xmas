<?php 
ini_set('display_errors',1);
error_reporting(E_ALL);
ob_start();
require_once('../res/meta.php'); 
require_once('../res/membercheck.php'); ?>
<title>Avatars | It's Christmas</title>
</head>
<body>
<?php 
if (isset($xUsername)){
	$target_dir = "../images/avatars/" . $xUsername . "-";
} else {
	$target_dir = "../images/avatars/";
}
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$src = $_FILES["fileToUpload"]["tmp_name"];
// Check if image file is a actual image or fake image
if($_FILES["fileToUpload"]["name"]) {
    $check = getimagesize($src);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $failMessage = 'filetypeimage';
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    $uploadOk = 0;
    $failMessage = 'fileexists';
}
 // Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $uploadOk = 0;
    $failMessage = 'filesize';
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
    $failMessage = 'filetype';
} else if (isset($check)){
    if($imageFileType=="jpg" || $imageFileType=="jpeg" )
    {
    $src = imagecreatefromjpeg($src);
    }
    else if($imageFileType=="png")
    {
    $src = imagecreatefrompng($src);
    }
    else 
    {
    $src = imagecreatefromgif($src);
    }
}
//Resize 
list($width,$height)=getimagesize($_FILES["fileToUpload"]["tmp_name"]);
$max = 250;
$newheight=($height/$width)*$max;
$newwidth = $max;
if ($newheight > $max){
    $newheight = $max;
    $newwidth=($width/$height)*$max;
}

$tmp=imagecreatetruecolor($newwidth,$newheight);
if (isset($src)){

    imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);
    $resizedImage = imagejpeg($tmp,$target_file,100);
}
echo print_r($resizedImage);
if ($uploadOk == 0) {
    echo "no upload ok";
    $uploadSuccess = 0;
} else {
    echo "u ok";
    move_uploaded_file($resizedImage, $target_file);
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        if (isset($xUsername)){
            $avatarSrc = $xUsername . "-" . basename( $_FILES["fileToUpload"]["name"]);
        } else {
            $avatarSrc = basename( $_FILES["fileToUpload"]["name"]);
        }
        $date = date("Y-m-d H:i:s");
        $updateQuery = mysqli_query($connect, "UPDATE userAvatars SET userAvatarSelected = 0 WHERE userID = '$xID'");
        $insertQuery = mysqli_query($connect, "INSERT INTO userAvatars VALUES ('','$xID','$avatarSrc','$date','1')");
        if ($insertQuery && $updateQuery){
            $uploadSuccess = 1;
            echo "yes";
        } else {
            echo "no";
            $uploadSuccess = 0;
        }

} 
if (isset($uploadSuccess) && $uploadSuccess == '1'){
    $headerSrc = "/member/details/avatar/?status=success";
} else {
    if (isset($failMessage) && $failMessage != ''){
        $headerSrc = "/member/details/avatar/?status=fail&failmessage=" . $failMessage . "";
    } else {
        $headerSrc = "/member/details/avatar/?status=fail";  
    }
}
header("location: " . $headerSrc);
?>
</body>
</html>