<?php 
	$pageID = 3;
	require('../res/meta.php'); 
	
	if (!$seoDone){	?>
		<title>Forgotten your Password? | It's Christmas</title>
	<?php
	}
?>
</head>

<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
	<div class="content login">
    	<h1>Forgotten your password?</h1>
		<?php 
        $status = $_GET['status'];
        if ($status) {
            if ($status == 'success'){
                    echo "<p class=\"successMsg\">The elves have sent you an email - please follow the instructions in it.</p>"; 
            } else {
                if ($status == 'fail'){
                    echo "<p class=\"errorMsg\">Sorry, the elves don't have those details on file.</p>";
                } else if ($status == 'email'){
                    echo "<p class=\"errorMsg\">The elves have eaten too many mince pies and something has gone wrong. Please try again.</p>";
                }
                require('../forms/password.php');
            }	
        } else {
            echo "<p>Enter your username or email address below and we'll reset your password for you:</p>";
            require('../forms/password.php');
        
        }
        ?>			
		</div>
	<?php require('../res/sidebars.php'); ?>
    </div>
<?php require('../res/admin.php'); ?>
</body>
</html>
