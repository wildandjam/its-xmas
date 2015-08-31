<?php 
    $membercheck = true;
    require('../../../res/meta.php');
?>
<title>Upload an image | It's Christmas</title> 
</head>
<body>
<?php require('../../../res/headnav.php'); ?>
<div id="container">
    <div class="content">
        <h1>What image you like to upload?</h1>
        <div id="workshopMode" class="hint--bottom" data-hint="This page is still in development, so please don't throw your hot chocolate at us if it breaks">Workshop mode</div>
        <?php
//phpinfo();
?>
        <br />
        <form method="post" action="/member/post/post-it/" name="postitem" id="postitem" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $id; ?>" name="user" id="user" />
			<input type="file" name="filename" id="filename" accept="image/jpeg, image/png, image/gif" />
            <!--<input id="submitone" name="submitone" type="submit" style="clear:both;" value="Next >" />-->
            <input hidden="hidden" id="image" name="image" value="" />
            <input hidden="hidden" id="url" name="url" value="0"/>
            <input hidden="hidden" id="postType" name="postType" value="image"/>
            <button style="display:none;">Upload</button>
            <span id="loadingGifText" style="display:none;font-style:italic;">Your image is currently being uploaded!</span>
            <img src="/images/loading.gif" alt="Loading Image" style="display:none;" class="loadingGif"/>
        </form>
        <div id="nofilereader" style="display:none;">Unfortunately your browser does not support this functionality. Please use another website to upload your image.</div>
        <div id="iosnotice" style="display:none;">Your Apple device offers limited funtionality. This may mean that you cannot use the upload button - if so please use an alternate method to upload your file, try <a href="http://www.imgur.com">imgur</a></div>
	</div>
    <script src="/js-upload/vendor/canvas-to-blob.min.js"></script>
	<script src="/js-upload/resize.js"></script>
    <script src="/js-upload/app.js"></script>
	<?php require('../../../res/sidebars.php'); ?>
    <script type="text/javascript">
	$(function(){
			if ('FileReader' in window) {
			} else {
				$("form#postitem").hide();
				$("#nofilereader").show();
			}
			
			function iOSversion() {
			  if (/iP(hone|od|ad)/.test(navigator.platform)) {
				// supports iOS 2.0 and later: <http://bit.ly/TJjs1V>
				var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
				return [parseInt(v[1], 10), parseInt(v[2], 10), parseInt(v[3] || 0, 10)];
			  }
			}
			
			ver = iOSversion();
			if (ver){
				if (ver[0] < 8) {
				  $("#iosnotice").show();
				}
			}
	});
	</script>
</div>
</body>
</html>
