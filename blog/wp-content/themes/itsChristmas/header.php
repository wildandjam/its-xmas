<!DOCTYPE html>
<?php 
require('../res/connect.php'); 
require('../res/user.php'); 
?>
<meta name="check" content="<?php echo $itschristmasid; ?>" />
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset='UTF-8'>
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<meta name="ROBOTS" content="NO INDEX, NO FOLLOW" />
<link href="/res/style/style.css" type="text/css" rel="stylesheet" />
<link href="/res/style/hint.css" type="text/css" rel="stylesheet"></link>
<link href="/res/style/blogs.css" type="text/css" rel="stylesheet" />
<link href="/res/datepicker/daterangepicker.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="/res/jquery.js"></script>
<script type="text/javascript" src="/res/ic.js"></script>
<script src="/res/jquery.masonry.min.js"></script>
<script type="text/javascript" src="/res/select2.min.js"></script>
<script type="text/javascript" src="/res/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="/res/modernizr.js"></script>


<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>


<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> id="blogBody">
<?php require('../res/headnav.php'); ?>
<!--<header>
    <div class="headcont">
        <div class="left">
        	<a href="/blog/" class="iCTitle">It's Christmas Blog</a>
            <div class="navbutton blognav" id="nav" title="Open Navigation"><img src="/images/nav.jpg" /></div>
		</div>            
      	<div class="right">
        	
            <a href="/">Back to main site</a>
        </div>	
    </div>
</header>-->

<div id="page" class="hfeed site">
	<div id="content" class="site-content">
		<div id="container" class=" main-content-area">
            <div id="pageHeader">
                <span class="fauxH1">Blog</span>
                <?php require('../res/userPortal.php'); ?>
                
                <div class="clearfix"></div>
                <div id="breadcrumbs">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>Blog</li>
                    </ul>
                </div>
            </div>
		<!--<div class="navmenu"><ul>
		        <?php sparkling_header_menu(); ?>
			<li class="handheld"><a href="/">It's Christmas</a></li>
		</ul></div>-->
			<div id="blogContent">