<?php 
	$postType = $_REQUEST['postType'];

    $membercheck = true;
    require('../../../res/meta.php');
?>
</head>
<body>

<?php require('../../../res/headnav.php'); ?>
<div id="container">
	<h1>Select an image</h1>
    <?php
   $url = $_REQUEST['url'];
	if (strpos($url, 'vimeo') !== false){
	    $vhost = "vimeo";
		$vidurl = explode("/",$url);
		$newurl = $vidurl[3];
		$videoType = "iframe";
	} else {
		if (strpos($url, 'youtu') !== false){
			$vhost = "youtube"; 
			$newurl = substr($url,strpos($url, "//"));
			$videoType = "jwplayer";
			?>
            
            <script src="http://jwpsrv.com/library/P1ehQj67EeS+YSIACyaB8g.js"></script>
			<script type="text/javascript">
            $(function(){
                jwplayer("video").setup({
                    file: "<?php echo $newurl; ?>",
                    width: 640,
                    height: 360
                });
            });
            </script>
        <?php
		} else {
			$newurl = $url;
			$vhost = "other"; 
			?>
			<script src="http://jwpsrv.com/library/P1ehQj67EeS+YSIACyaB8g.js"></script>
			<script type="text/javascript">
            $(function(){
                jwplayer("video").setup({
                    file: "<?php echo $newurl; ?>",
                    width: 640,
                    height: 360
                });
            });
            </script>
            <?php
		}
		$newurl = $url;
		
	}
	 

?>

<!---->


       <?php 
	   
	   
	   	echo "Video host: " . $vhost;
	   echo $newurl;
	   if ($vhost == "vimeo"){
       	$videoURL = "//player.vimeo.com/video/" . $newurl;
		echo "<br />" . $videoURL;
		?>
		   <iframe src="<?php echo $videoURL; ?>" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
           
<?php   }
	   
	   
	   		print_r($_REQUEST);

		?>
        
        <div id="video">
        </div>
		

	<?php require('../../../res/sidebars.php'); ?>
</div>
</body>
</html>
