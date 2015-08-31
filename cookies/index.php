<?php 
	$pageID = 9;
	require('../res/meta.php'); 
	
	if (!isset($seoDone)){	?>
		<title>Milk and Cookie policy | It's Christmas</title>
	<?php
} ?>
</head>

<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
    <?php 
        $pgTitle = "The Milk & Cookie Policy";
        $pgBreadcrumb = "<li>The Milk & Cookie Policy</li>";
        require('../res/pageHeader.php');
    ?>
	<div class="content static" id="cookiePolicy">
        <img src="/images/milk-cookies.png" alt="Milk and Cookies" align="middle"/>
        <h2>Milk Policy</h2>

        <p>Whilst on It's Christmas, you are permitted to drink milk. This milk may come: </p>
        <ul>
	        <li>skimmed</li>
            <li>semi-skimmed</li>
            <li>full fat</li>
            <li>no fat</li>
            <li>out of a cow</li>
            <li>out of a goat</li>
            <li>soya</li>
            <li>not soya</li>
            <li>in tea</li>
            <li>in coffee</li>
            <li>within a hot chocolate</li>
            <li>with a biscuit</li>
            <li>buttermilk</li>
            <li>... or any other type of milk</li>
        </ul>
        <p>Alternatively - you don't have to drink milk. Your choice.</p>
        
        <h2>Cookie Policy</h2>
        <p>It's Christmas love Cookies, a lot.</p>
        <p>But, cookies are not just yummy treats, they are also small pieces of data (don't eat these).</p>
        <p>We use these funky cookies (the data ones), to be able to give you the best experience possible - including the ability to log in. </p>
        <p>By using this website, you consent to the use of cookies to enhance your experience.</p>
        <p>If you have any questions regarding this, please <a href="/contact/">contact us</a>
        
	</div>

<script type="text/javascript">
	$(function(){
		if (getCookie("cookies")){
			setCookie("cookies","read", {expiry : new Date(2030, 0, 1)});
			$("#cookiePop").hide();
		}
	});
</script>
</div>
<?php require('../res/gtm.php'); ?>
</body>
</html>
