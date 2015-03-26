<?php

		session_start(); 
?>
<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset='UTF-8' />
<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
<meta name="ROBOTS" content="index, follow" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-Language" content="en">

<!-- Stylesheets -->
<link href="/res/style/style.css" type="text/css" rel="stylesheet" />
<link href="/res/style/hint.css" type="text/css" rel="stylesheet" />
<link href="/res/select2.css" type="text/css" rel="stylesheet" />
<link href="/res/jquery-ui.min.css" type="text/css" rel="stylesheet" />
<link href="/res/datepicker/daterangepicker.css" rel="stylesheet" />
<link rel="stylesheet" href="/res/icons/style.css" />

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css' />


<!-- Javascript -->
<!-- jQuery library -->
	<!--[if !IE]-->
	<script type="text/javascript" src="/res/jquery.js"></script>
	<!--[endif]-->
	<!--[if IE]-->
	<script type="text/javascript" src="/res/jquery-ie.js"></script>
	<!--[endif]-->

<!-- HTML5 backup -->
<!--[if lt IE 9]> --> 
<script type="text/javascript">       document.createElement('header');       document.createElement('nav');       document.createElement('section');       document.createElement('article');       document.createElement('aside');       document.createElement('footer');    </script> 
<style type="text/css">header, nav, section, article, aside, footer {display:block;}</style>
<!-- <![endif]-->

<script type="text/javascript" src="/res/ic.js"></script>
<script type="text/javascript" src="/res/rate.js"></script>
<script type="text/javascript" src="/res/select2.min.js"></script>
<script type="text/javascript" src="/res/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="/res/modernizr.js"></script>
<!-- jwplayer -->
<script src="http://jwpsrv.com/library/P1ehQj67EeS+YSIACyaB8g.js"></script>

<!-- Validation -->
<meta name="msvalidate.01" content="92990088398D977937630E9F6DC7377F" />

<!-- Favicons -->
<link rel="icon" href="/favicon.ico?v=5" type="image/x-icon" />
<link rel="icon" href="/favicon.ico?v=5" type="shortcut icon" />
<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png" />
<meta name="apple-mobile-web-app-title" content="It's Christmas | Sharing the Christmas spirit" />
<link rel="icon" type="image/png" href="/favicon-192x192.png" sizes="192x192" />
<link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160" />
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32" />
<meta name="msapplication-TileColor" content="#183051" />
<meta name="msapplication-TileImage" content="/mstile-144x144.png" />

<!-- Rich Snippets -->
<meta name="application-name" content="It's Christmas | Sharing the Christmas spirit" />
<meta property="og:site_name" content="It's Christmas" />
<meta itemprop="url" property="og:url" content="http://its-xmas.co.uk/<?php echo $_SERVER["REQUEST_URI"]; ?>" />
<meta property="og:determiner" content="auto" />
<meta property="og:locale" content="en_GB" />


<?php 
	if (isset($ignoreOG) && $ignoreOG != true){ ?>
		<meta property="og:type" content="website" />
		<meta itemprop="image" property="og:image" content="http://www.its-xmas.co.uk/images/logo/fbimage.jpg" />
	    <meta property="og:image:type" content="image/jpeg" />
	    <meta property="og:image:width" content="500" />
	    <meta property="og:image:height" content="500" />
	    <meta itemprop="description" property="og:description" name="description" content="Share the Christmas spirit with It's Christmas - the Christmas portal on the Internet. Upload pictures, share recipes and post videos" />
<?php } 
require_once('connect.php');
require_once('user.php'); 
if (isset($pageID)){
	
	$pageQuery = mysqli_query($connect, "SELECT * FROM seo WHERE pageID = '$pageID'");
	$pageCount = mysqli_num_rows($pageQuery);
	if ($pageCount == 1){
		while ($pageRow = mysqli_fetch_array($pageQuery)){
			$pageTitle = $pageRow['pageTitle'];
			$pageDescription = $pageRow['pageDescription'];
			?>
				<meta name="description" content="<?php echo $pageDescription; ?>">
				<title><?php echo $pageTitle; ?> | It's Christmas</title>
			<?php
			$seoDone = true;
		}
	}
}
require('countdown.php');



?>