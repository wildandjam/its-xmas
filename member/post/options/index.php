<?php 
	$postType = $_REQUEST['postType'];

	if ($postType == "text"){
		header("Location: /member/post/post-it/");
	} else if ($postType == "video"){
		header("Location: /member/post/video/");
	}

require('../../../res/meta.php'); ?>
<?php require('../../../res/membercheck.php'); ?>
<script type="text/javascript" src="/res/js/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript">
$(function(){
	var imgLoad = imagesLoaded( ".postimage" );
	imgLoad.on( 'always', function( instance ) {
	  fixImages();
	});
		
	
	$('.postdiv').on('click',function(){
		$('.postdiv').attr("id","");
		$(this).attr("id","selectedimg");
		$img = $(this).find("img").attr("src");
		$("form #image").attr("value",$img);
		
		$("button#submitone").trigger("click");
	});
	
	function fixImages(){
		var $img = $('.postimage'),
			length = $img.length;
		for (var i = 0; i < length; i++) {
			var width = $img.eq(i).width();
			var height = $img.eq(i).height();
			if (width < 100 && height < 100){
				$('.postdiv').eq(i).hide().css({"padding":"0"});	
			} 
		}
		
		
		var visible = $(".postimage:visible").length;
		if (visible == '0'){
			$("#postimages").prepend("<div class='no-images'>Unfortunately, there are no images that we can share on this page.</div>");	
		}
	}

//	var $container = $('#postimages');
//		$container.imagesLoaded(function(){
//		  $container.masonry({
//			itemSelector : '.postdiv',
//			columnWidth : 5,
//			isAnimated: true
//		  });
//		});

});

</script>
<title>Select an image to post</title>
</head>
<body>
<?php require('../../../res/headnav.php'); ?>
<div id="container">
	<h1>Select an image</h1>
       <?php 
	   		$sone = $_REQUEST['submitone'];
			$postuser  = $_REQUEST["user"];
			$url = $_REQUEST['url'];
			if ($url == ""){
				header("location:/member/post/");	
			}
			$fronturl =  substr($url,0,4);
			if ($fronturl == 'http'){
			} elseif ($fronturl == 'www.'){
				$url = 'http://'.$url;
			} elseif ($fronturl == '//ww'){
				
			} else {
				$url = 'http://www.'.$url;	
			}
			
			if ($url){
		?>
        <div id="postimages">
        
            <form method="post" action="/member/post/post-it/" name="postitems" id="postitems" style="float:left;display:block;">
                <input type="hidden" value="<?php echo $postuser; ?>" name="user" id="user" />
                <input type="hidden" placeholder="URL" name="url" id="url" value="<?php echo $url; ?>"/>
                <input type="hidden" value="image" name="type" id="postType" />
                
                    <?php 
					$linktype = substr($url, -4);
			
					if ($linktype == ".jpg" || $linktype == "jpeg" || $linktype == ".png" || $linktype == ".gif"){ ?>
						<div id="chosenImg"><img src="<?php echo $url; ?>" alt="Post image" onerror="alert('Image not found or protected');"/></div>
						<input type="hidden" id="image" name="image" value="<?php echo $url ?>">
						<h1>Is this the right image?</h1>
					<?php
					} else {							
						$getinfo = true;	
					}
						
					if ($getinfo == "true"){
						?>
							<input type="hidden" id="image" name="image" value="">
						<?php
						$html = file_get_contents($url);
						
						$doc = new DOMDocument();
						@$doc->loadHTML($html);
						
						$metatags = $doc->getElementsByTagName('meta');
						foreach ($metatags as $metatag) {
							$property = $metatag->getAttribute('property');
							$content = $metatag->getAttribute('content');
							if ($property == 'og:image'){
								echo '<div class="postdiv"><img src="' . $content . '"  class="postimage" /></div>';
							}
							
						}	
						
						$tags = $doc->getElementsByTagName('img');
						require('../../../res/absoluteurl.php');
						foreach ($tags as $tag) {
							$src = $tag->getAttribute('src');
							$src = make_absolute_path($url,$src);
							
						?>
							   <div class="postdiv"><img src="<?php echo $src; ?>?v=2" class="postimage" /></div>
						<?php }
					} else {
					/*
						require_once('opengraph.php');

						$graph = OpenGraph::fetch($url);
						var_dump($graph->keys());
						var_dump($graph->schema);
						
						foreach ($graph as $key => $value) {
							echo "$key => $value";
						}
						
						
						
						
						$tags = get_meta_tags($url);
						//echo $tags['og:image'];
						echo "<iframe width='560' height='315'  src=" . $url . " allowfullscreen></iframe>";
						*/
					}	?>
				<div id="postOptionAction">
					<button id="submitone" name="submitone" style="display:none;">Next ></button>
					<a href="/member/post/"><div class="goBack">Back</div></a>
				</div>
            </form>
		</div>
		
		
		<?php
			} else {
		
		
		
		
		 } ?>

	<?php require('../../../res/sidebars.php'); ?>
</div>
</body>
</html>
