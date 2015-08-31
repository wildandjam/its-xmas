<?php 
	$ignoreOG = true;
	require('../res/meta.php'); 
?>	
<title>The Countdown to Christmas | It's Christmas</title>
<meta itemprop="name" property="og:title" content="The Countdown to Christmas | It's Christmas" />
<meta itemprop="description" property="og:description" name="description" content="It's Christmas <?php echo $countphp; ?>" />
<meta itemprop="image" property="og:image" content="http://www.its-xmas.co.uk/images/logo/fbimage.jpg" />
<meta property="og:image:type" content="image/jpeg">
<meta property="og:site_name" content="It's Christmas" />
<meta property="og:type" content="website" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />
</head>

<body>
 <div id="fb-root"></div>
    <script type="text/javascript">
	window.fbAsyncInit = function () {

		FB.init({
			appId: '655466264547809',
			status: true,
			xfbml: true
		});
        $("#fblikeholder").click(function(){
			FB.ui(
			  {
				method: 'share',
				href: document.URL
			  },
			  function(response) {
				return true;
			  }
			);
		});
	};
		
        (function () {
            if (document.getElementById('facebook-jssdk')) { return; }
            var firstScriptElement = document.getElementsByTagName('script')[0],
                facebookJS = document.createElement('script');
            facebookJS.id = 'facebook-jssdk';
            facebookJS.src = '//connect.facebook.net/en_US/all.js';
            firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
        }());
	$(function(){
		$("#durationSelect button").click(function(){
			var number = $("#durationSelect select")[0].selectedIndex,
				value = $("#durationSelect select option").eq(number).attr("value");
			window.location.href = "/process/countdown.php?name=<?php echo $id; ?>&type=" + value;
		});
	});
    </script>

<?php require('../res/headnav.php'); ?>
<div id="container" class="countdownPage">
    <?php 
        $pgTitle = "Countdown to Christmas";
        $pgBreadcrumb = "<li>The Countdown to Christmas</li>";
        require('../res/pageHeader.php');
    ?>
    <h2 class="countdownHeader">It's Christmas <span id="countdownPage"><?php if (isset($countphp)) { echo $countphp; } ?></span></h2>
    <div id="shareThisPage">
    	<h3>Share:</h3>
        <span id="fblikeholder" class="facebookLike hint--bottom" data-hint="Share on Facebook"><img src="/images/social/facebook.png" alt="Share countdown on Facebook"/></span>
        <a href="https://plus.google.com/share?url=www.its-xmas.co.uk/countdown/" onClick="javascript:window.open(this.href,
        '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="hint--bottom" data-hint="Share on Google+"><img
        src="/images/social/google.png" alt="Share on Google+"/></a>
        <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" class="hint--bottom" data-hint="Pin on Pinterest">
            <img src="/images/social/pinterest.png" alt="Pinterest pin-it button">
        </a>
        <?php if ($type){ ?>
			<a href="https://twitter.com/share?via=NowItsChristmas&amp;text=It's Christmas <?php echo $countphp; ?> http://www.its-xmas.co.uk/countdown/?type=<?php echo $type; ?>" target="_blank" class="hint--bottom" data-hint="Tweet page"><img src="/images/social/twitter.png" alt="Tweet the countdown" /></a>
		<?php } else { ?>
			<a href="https://twitter.com/share?via=NowItsChristmas&amp;text=It's Christmas <?php echo $countphp; ?> http://www.its-xmas.co.uk/countdown/" target="_blank" class="hint--bottom" data-hint="Tweet page"><img src="/images/social/twitter.png" alt="Tweet the countdown" /></a>
		<?php } ?>
        
    </div>
    <?php if ($type){ ?>
		<div id="durationSelect" class="<?php echo $type; ?>">
	<?php } else { ?>
		<div id="durationSelect" class="days">
	<?php } ?>
    
    	<label for="type">
        	Change duration type:
        </label>
    	<select id="type" name="type">
        	<option selected value="<?php echo $type; ?>">Choose...</option>
        	<option value="seconds">Seconds</option>
        	<option value="minutes">Minutes</option>
        	<option value="hours">Hours</option>
        	<option value="days">Days</option>
            <option value="weeks">Weeks</option>
        </select>
        <button>Change</button>
    </div>
	
    </div>
<?php require('../res/gtm.php'); ?>
</body>
</html>
