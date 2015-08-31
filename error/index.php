<?php require('../res/meta.php'); ?>
     <title>404 Error | It's Christmas</title>
</head>
<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
    <?php 
        $pgTitle = "The South Pole";
        $pgBreadcrumb = "<li>The South Pole</li>";
        require('../res/pageHeader.php');
    ?>
    <div id="errorContainer">
       <h1>Unfortunately the page you are looking for does not exist</h1>
       <?php
	   	echo '<img src="/images/logo.png" alt="It\'s Christmas" style="margin: 0 auto;max-width:100%;width:250px;display:block;" />';
	   ?>
       
	</div>

<?php require('../res/gtm.php'); ?>
	
</div>
</body>
</html>