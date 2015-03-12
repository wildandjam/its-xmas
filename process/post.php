<?php
	require('../res/connect.php'); 
	require ('../res/user.php');
	require ('../res/membercheck.php');
	$user = $_REQUEST['user'];
	$url = $_REQUEST['url'];
	$image = $_REQUEST['image'];
	$category = $_REQUEST['category'];
	$title = mysqli_real_escape_string($connect, $_REQUEST['title']);
	$type = $_REQUEST['postType'];
	
	if ($type == "video"){
		$videoImg = $_REQUEST['imageRotate'];
	}
	$width = "0";
	$height = "0";
	$privacy = $_REQUEST['privacy'];
	$tags = $_REQUEST['tags'];
	$desc = mysqli_real_escape_string($connect, $_REQUEST['description']);
	$textContent = mysqli_real_escape_string($connect, $_REQUEST['textContent']);
	
	if ($type != "text"){
		if ($user && $url && $image){
			if ($privacy == "public"){
				$postPrivacy = 0;
			} else {
				$postPrivacy = 1;
			}
		} else {
			header('location: /member/post/'); 
		}
	}
	if ($category && $category != "Select category"){
		
	} else {
		$category = 33;
	}
	
	//duplication tests
	if ($image != ""){
		if ($type == "video"){
			$linkposted = mysqli_query($connect, "SELECT * FROM posts WHERE userID = '$user' AND postURL = '$url'");
			if (mysqli_num_rows($linkposted) > 1){
				header("location: /member/post/post-it/?url=$url&image=$image&desc=$desc&title=$title&type=$tye&status=already");	
			}
		} else {
			$linkposted = mysqli_query($connect, "SELECT * FROM posts WHERE userID = '$user' AND postImage = '$image'");
			if (mysqli_num_rows($linkposted) > 1){
				header("location: /member/post/post-it/?url=$url&image=$image&desc=$desc&title=$title&type=$tye&status=already");	
			}
		}
	} else if ($textContent != ""){
		$linkposted = mysqli_query($connect, "SELECT * FROM posts WHERE userID = '$user' AND postImage = '$textContent'");
		if (mysqli_num_rows($linkposted) > 1){
			header("location: /member/post/post-it/?url=$url&image=$textContent&desc=$desc&title=$title&type=$tye&status=already");	
		}
	}
	
	$date = date("Y-m-d H:i:s");
	if ($type == "text"){
		$querypostmysql = "INSERT INTO posts VALUES ('',0,'$user','$category','$type','$title','$desc','$url','$textContent','$width','$height','$date','0','0','0','$postPrivacy','0')";
	} else if ($type == "video"){
		$querypostmysql = "INSERT INTO posts VALUES ('',0,'$user','$category','$type','$title','$desc','$url','$image','$videoImg','$height','$date','0','0','0','$postPrivacy','0')";
	} else {
		$querypostmysql =  "INSERT INTO posts VALUES ('',0,'$user','$category','$type','$title','$desc','$url','$image','$width','$height','$date','0','0','0','$postPrivacy','0')";
	}

	$querypost = mysqli_query($connect,$querypostmysql);
	if ($querypost) {
		$getPostQuery = "SELECT * FROM posts WHERE userID = '$user' AND postTitle = '$title' AND postDate = '$date'";
		$getPost = mysqli_query($connect,$getPostQuery);
		$getPostRows = mysqli_num_rows($getPost);
		if ($getPostRows == 1){
			while($postRow = mysqli_fetch_array($getPost)) {
				$postID = $postRow['postID'];
				$redirectURL = 'http://www.its-xmas.co.uk/post/?id=' . $postID . '&status=successful';
				header('location: ' . $redirectURL);	
				echo '<script>window.location = "'.$redirectURL.'";</script>';				
				echo $redirectURL;
			}
			$redirectURL = 'http://www.its-xmas.co.uk/post/?id=' . $postID . '&status=successful';
			header('location: ' . $redirectURL);	
			echo '<script>window.location = "'.$redirectURL.'";</script>';				
			echo $redirectURL;
		} else {
			header("location: http://www.its-xmas.co.uk/user/?uid=" . $user);	
		}
	} else {
		if ($type == "text"){
			header("location: /member/post/post-it/?url=$url&image=$textContent&desc=$desc&title=$title&type=$tye&status=error");	
		} else {
			header("location: /member/post/post-it/?url=$url&image=$image&desc=$desc&title=$title&type=$tye&status=error");	
		}
	}
header("location: http://www.its-xmas.co.uk/");
?>



