<?php 
    $membercheck = true;
    require('../../../res/meta.php');

if (isset($_REQUEST['postType'])){
	$postType = $_REQUEST['postType'];
}
if (isset($postType) && $postType == "text"){
	$textContent = $_REQUEST['textContent'];	
}
if (isset($_REQUEST)){
	$user = $_REQUEST['user'];
	$url = $_REQUEST['url'];
	$image = $_REQUEST['image'];
	$status = $_REQUEST['status'];
	$title = $_REQUEST['title'];
	$desc = $_REQUEST['desc'];
}

if (isset($postType) && $postType == "video"){
	$html = file_get_contents($url);
	$doc = new DOMDocument();
	@$doc->loadHTML($html);
	$metatags = $doc->getElementsByTagName('meta');
	foreach ($metatags as $metatag) {
		$property = $metatag->getAttribute('property');
		$content = $metatag->getAttribute('content');
		if ($property == 'og:image'){
			$videoImg = $content;
		}
	}
	if (strpos($url, 'vimeo') !== false){
		//Vimeo
		$vidurl = explode("/",$url);
		if (strpos($url, '/m/') !== false){
			$newurl = $vidurl[4];
		} else {
			$newurl = $vidurl[3];
		}
       	$videoURL = "//player.vimeo.com/video/" . $newurl;
		$videoType = "iframe";
	} else if (strpos($url, 'youtu') !== false){
		//YouTube
		$videoURL = substr($url,strpos($url, "//"));
		$videoType = "jwplayer"; ?>
		<script src="http://jwpsrv.com/library/P1ehQj67EeS+YSIACyaB8g.js"></script>
		<script type="text/javascript">
            $(function(){
                jwplayer("video").setup({
                    file: "<?php echo $videoURL; ?>",
                    width: 640,
                    height: 360
                });
            });
        </script>
<?php } else {
		//No support for launch
		$videoType = "none";
			$img = "<span class='icon-play'></span>";
		}
}
?>
<title>Post options | It's Christmas</title>
</head>
<body>
<?php require('../../../res/headnav.php'); ?>
<div id="container">
    <div class="content">   
		<div class="postIt">
        	<?php if ($status){
				switch ($status){
					case "already":	
						echo "<p class='errorMsg'>Did you ask for spam for Christmas, because we didn't. You've already posted this twice, please try and find something more original.</p>";
						break;
					case "error":	
						echo "<p class='errorMsg'>Unfortunately our hot chocolate maker is busy making the elves a drink - is there any chance you can try again? There might be a gap!.</p>";
						break;
				}
				
				
		} ?>
        
        
        
			<form action="/process/post.php" method="post">
				<input type="hidden" name="user" id="user" value="<?php echo $user; ?>" />
                <?php if ($postType == "video"){ ?>
					<input type="hidden" name="url" id="url" value="<?php echo $videoURL; ?>" />
					<input type="hidden" name="image" id="image" value="<?php echo $videoType; ?>" />
                    <input type="hidden" name="imageRotate" id="imageRotate" value="<?php echo $videoImg; ?>" />
				<?php } else { ?>
					<input type="hidden" name="url" id="url" value="<?php echo $url; ?>" />
					<input type="hidden" name="image" id="image" value="<?php echo $image; ?>" />
				<?php } ?>
				
                <input type="hidden" id="textContent" name="textContent" value="<?php echo $textContent; ?>" />
                <input type="hidden" id="postType" name="postType" value="<?php echo $postType; ?>" />
				<?php if ($postType == "text"){ ?>
                	<div id="textContentContainer">
						<?php echo $textContent; ?>
                    </div>
                <?php } else if ($postType == "video"){
					if ($videoType == "jwplayer"){
						echo '<div id="video"></div>';
					} else if ($videoType == "iframe"){
						echo '<iframe src="' . $videoURL . '" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
					} else {
						echo $img;
					}
				} else { ?>
	                <img src="<?php echo $image; ?>" class="chosenImage"/>
                <?php }?>
				
				<input type="text" name="title" id="title" placeholder="Enter title here" value="<?php echo $title; ?>" required/>
                <textarea id="description" name="description" placeholder="Description"><?php echo $desc; ?></textarea>
				<div class="postRow">
				<span>Category: </span>
					<?php 
						$getCats = true;
						require('../../../res/category.php');
						$getCats = false;

					?>
				</div>
				<div class="postRow">
					<?php
						$listQuery = mysqli_query($connect, "SELECT * FROM collections WHERE userID = '$user'");
						$listRows = mysqli_num_rows($listQuery);
						
						if ($listRows != '0'){
							$listHTML = "<span>Add to collection:</span>";
							$listHTML .= "<select name=\"list\"><option value=\"0\">Choose list</option>";
							
							while($listR = mysqli_fetch_array($listQuery)){
								$listHTML .= "<option value=\"" . $listR['listID'] . "\">" . $listR['listName'] . "</option>";
							
							}						
							$listHTML .= "</select>";
							echo $listHTML;
						}
					?>
				</div>
				<div class="postRow">
					<span>
						Post privacy: 
					</span>
					<select name="privacy" id="privacy">
						<option value="public">Public</option>
						<option value="private">Private</option>
					</select>
				</div>
				<input id="postit" name="postit" type="submit" style="clear:both;" value="Post" />
				
				
				
			
			
			</form>
		</div>
	</div>
	<?php require('../../../res/sidebars.php'); ?>
</div>
</body>
</html>
