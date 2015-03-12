 <?php
 	$image = imagecreatefromjpeg("http://www.its-xmas.co.uk" . $_REQUEST['image']);
	$degrees = $_REQUEST['rotate'];
	
	
	function create_image($img, $degrees) {
		//$im = @imagecreatefromjpeg($img) or die("Cannot Initialize new GD image stream");
		//$rotate = imagerotate($im, $degrees, 0);
		//echo $img;
		//imagejpeg($img);
		//imagedestroy($rotate);
		//imagedestroy($img);
		header('Content-Type: image/jpeg');
		@imagejpeg($img);
	}
	
	//header('Content-Type: image/jpeg');
	create_image($image, $degrees);

?>