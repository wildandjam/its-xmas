<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
<link href='holding.css' rel='stylesheet' type='text/css'>
<link rel="icon" href="favicon.ico?v=5" type="image/x-icon" />
<link rel="apple-touch-icon" href="apple-touch-icon.png" />
<?php
	date_default_timezone_set('Europe/London');
	$today = $date = date('Y-m-d H:i');
	$datetime1 = strtotime('2014-12-25 00:00');
	$datetime2 = strtotime($today);
	$interval = $datetime1-$datetime2;
	$days = floor($interval / 86400);
	$hour = floor(($interval - ($days * 86400)) / 3600);
	$minutes = floor(($interval - ($days * 86400) - ($hour * 3600))/60);
	if ($hour == 0){
		$hour = 23;	
	} else {
		$hour = $hour - 1;
	}
	$count = "in " . $days . " days, ". $hour . " hours and " . $minutes . " minutes";
?>
<meta name="description" content="It's Christmas | The most wonderful time of the year | Coming Soon" />
<meta property="og:title" content="It's Christmas | Coming Soon" />
<meta property="og:description" content="It's Christmas <?php echo $count; ?> | Coming Soon" />
<meta property="og:image" content="http://www.its-xmas.co.uk/oglogo.jpg" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="800" />
<meta property="og:image:height" content="420" />
<meta property="og:site_name" content="It's Christmas" />
<meta property="og:url" content="http://www.its-xmas.co.uk" />
<meta property="og:determiner" content="auto" />
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@NowItsChristmas">
<meta name="twitter:creator" content="@NowItsChristmas">
<meta name="twitter:title" content="It's Christmas | Coming Soon">
<meta name="twitter:description" content="It's Christmas <?php echo $count; ?> | Coming Soon">
<meta name="twitter:image" content="http://www.its-xmas.co.uk/oglogo.jpg">










	<head>
		<title>It's Christmas</title>
	</head>
<script type="text/javascript">
CountDownTimer('12/25/2014 0:0 AM', 'countdown');

function CountDownTimer(dt, id)
{
	var end = new Date(dt);

	var _second = 1000;
	var _minute = _second * 60;
	var _hour = _minute * 60;
	var _day = _hour * 24;
	var timer;

	function showRemaining() {
		var now = new Date();
		var distance = end - now;
		if (distance < 0) {

			clearInterval(timer);
			document.getElementById(id).innerHTML = 'TODAY!';

			return;
		}
		var days = Math.floor(distance / _day);
		var hours = Math.floor((distance % _day) / _hour);
		var minutes = Math.floor((distance % _hour) / _minute);
		minutes = minutes + 1;
		var seconds = Math.floor((distance % _minute) / _second);
		
		if (hours == 0){
			hours = 23;	
		} else {
			hours = hours - 1;
		}


		document.getElementById(id).innerHTML = '<span>in </span>';
		if (days == 1) {document.getElementById(id).innerHTML += days + '<span> day, </span>';
		} else {document.getElementById(id).innerHTML += days + '<span> days, </span>';}
		if (hours == 1) {document.getElementById(id).innerHTML += hours + '<span> hour, </span>';
		} else {document.getElementById(id).innerHTML += hours + '<span> hours, </span>';}
		if (minutes == 1) {document.getElementById(id).innerHTML += minutes + '<span> minute, and </span>';
		} else {document.getElementById(id).innerHTML += minutes + '<span> minutes, and </span>';}
		if (seconds == 1){document.getElementById(id).innerHTML += seconds + '<span> second </span>';
		} else {document.getElementById(id).innerHTML += seconds + '<span> seconds </span>';}
	}

	timer = setInterval(showRemaining, 1000);
}
</script>
<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=319407244866417";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="holding">
	<h1>It's Christmas</h1>
	<div id="countdown">
		<?php 
			echo $count;
		?>
	</div>
	<div id="share">
		<div class="shareOpt"><div class="fb-share-button" data-href="http://www.its-xmas.co.uk" data-type="button_count"></div></div>
		<div class="shareOpt"><a href="//www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.its-xmas.co.uk&media=http%3A%2F%2Fwww.its-xmas.co.uk%2Foglogo.jpg&description=It%26%23x27%3Bs%20Christmas%20%7C%20Coming%20Soon" data-pin-do="buttonPin" data-pin-config="beside" data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a></div>
		<div class="shareOpt"><a href="https://twitter.com/share" class="twitter-share-button" data-text="It's Christmas <?php echo $count; ?>" data-via="NowItsChristmas" data-hashtags="Christmas">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
		
	</div>
	<h2>Coming Soon...</h2>
<a href="https://plus.google.com/105060063026008138077?rel=author" class="google">Google+</a>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-32134778-2', 'its-xmas.co.uk');
  ga('send', 'pageview');

</script>
</body>
</html>