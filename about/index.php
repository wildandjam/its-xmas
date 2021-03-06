<?php $pageID = 4;
	require('../res/meta.php'); 
	if (!isset($seoDone)){	?>
		<title>About It's Christmas | It's Christmas</title>
	<?php
} ?>
</head>

<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
    <?php 
        $pgTitle = "About";
        $pgBreadcrumb = "<li>About</li>";
        require('../res/pageHeader.php');
    ?>
	<div class="content static content1000" id="aboutPage">
		<div id="aboutHeading">
        	<h2>Roll up, roll up and welcome to It's Christmas, the most marvellously magical marshmallow world on all the web to ensure all your Christmases are merry and bright!</h2>
        </div>
        <div id="aboutContent">
            <p>We here at It's Christmas truly believe that Christmas is the most wonderful time of the year, and so we want to spread the cheer throughout the year, helping you to plan your perfect Christmas, organise your events and get into that warm, hot-chocolate-by-the-fire Christmassy spirit! </p>
            <p>Here you'll find ideas for great gifts, tasty recipes, party planning help, reviews of the best Christmas tv and movies and areas to plan your own gift lists (and check them twice) and build your Christmas scrapbook. Everything to help you create your very own winter wonderland. We hope you can stay - after all, it's cold outside!</p>
    	</div>
        <div class="exploreWrapper">
	        <a href="/" class="button">Explore It's Christmas</a>
        </div>
	</div>


</div>
<?php require('../res/gtm.php'); ?>
</body>
</html>
