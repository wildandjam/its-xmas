<?php
	session_start();
	session_unset();
	session_destroy();
unset($_COOKIE['username']);
            setcookie('username', null, -1, '/');
	$msg = "You have been logged out";

	require('../res/membercheck.php');
	require('../res/meta.php');
	

?>
</head>

<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
	<div class="content">
    	<div class="content">
        	<?php echo $msg; ?>
			<br /><br />
			<a href="/iC/login/">Log back in?</a>
        	
        </div>
    </div>
	<?php require('../res/sidebars.php'); ?>
</div>

</body>
</html>
