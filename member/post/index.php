<?php 
	require('../../res/meta.php');
	require('../../res/membercheck.php'); ?>
    <script src="http://jwpsrv.com/library/P1ehQj67EeS+YSIACyaB8g.js"></script>
<script type="text/javascript">
$(function(){
	var $img = $('.postimage');
	var length = $img.length;
	for (var i = 0; i < length; i++) {
			var width = $img.eq(i).width();
			var height = $img.eq(i).height();
			if (width < 100 | height < 100){
				$('.postdiv').eq(i).hide();	
			}
	}
	$('.postdiv').on('click',function(){
		$('.postdiv').attr("id","");
		$(this).attr("id","selectedimg");
	});
});
$(document).on("click", ".postItemChoice", function(){
	var dataType = $(this).attr("data-type");
	$(".postItemChoice").removeClass("active");
	$(this).addClass("active");
	$("#postType").val(dataType);
	if (dataType == "video"){
		$("#hiddenTextarea, #hiddenTextarea textarea").hide();
		$("#hiddenInput, #hiddenInput input").show();
		$("#hiddenInput .upload").hide();
		$("#postitem").attr("action", "/member/post/post-it/");
		//$("#postitem").attr("action", "video/");
	} else if (dataType == "text"){
		$("#hiddenTextarea, #hiddenTextarea textarea").show();
		$("#hiddenInput, #hiddenInput input, #hiddenInput .upload").hide();
		$("#postitem").attr("action", "/member/post/post-it/");
	} else {
		$("#hiddenTextarea, #hiddenTextarea textarea").hide();
		$("#hiddenInput, #hiddenInput input, #hiddenInput .upload").show();
		$("#postitem").attr("action", "options/");
	}
});

</script>
<title>What would you like to share? | It's Christmas</title> 
</head>
<body>
<?php require('../../res/headnav.php'); ?>
<div id="container">
    <div id="pageHeader">
        <h1>New Post</h1>
        <div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/member/my-christmas/">My Christmas</a></li>
            </ul>
        </div>
        
        <?php require('../../res/userPortal.php'); ?>
        
        <div id="pageHeaderLinks">
           
            
        </div>
    </div>
        <h1>What <?php if (isset($typename)){echo $typename;} ?> would you like to share?</h1>
        <br />
        <form method="post" action="options/" name="postitem" id="postitem">
            <div id="postItemChoices">
                <div class="postItemChoice hint--bottom" data-type="image" data-hint="Image/Photo">
                    <span class="icon-image"></span>
                </div>
                
                <div class="postItemChoice hint--bottom" data-type="video" data-hint="Video">
                    <span class="icon-play"></span>
                </div>
                
                <!--<div class="postItemChoice" data-type="event">
                    <span class="icon-calendar"></span>
                </div>-->
                
                <div class="postItemChoice hint--bottom" data-type="text"  data-hint="Text">
                    <span class="icon-write12"></span>
                </div>
        	</div>
        	<input type="hidden" name="postType" id="postType" />
            <input type="hidden" value="<?php echo $id; ?>" name="user" id="user" />
            <div id="hiddenTextarea">
            	<textarea id="textContent" name="textContent" placeholder="Enter post here..."></textarea>
                <input id="submitone" name="submitone" type="submit" style="clear:both;" value="Next >" />
            </div>
            <div id="hiddenInput">
                <input type="text" name="url" id="url" placeholder="Enter URL here" class="nextToUp" />
                <button id="submitone" name="submitone" style="clear:both;">Next ></button>
                
                <span class="upload">
                    <br />
                    OR 
                    <br /><br />
               	</span>
                <a href="/member/post/upload/" class="upload">
                    Upload >
                </a>
        	</div>
        </form>
</div>

<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	CKEDITOR.replace( 'textContent' );
</script>
</body>
</html>
