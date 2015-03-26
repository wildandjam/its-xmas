<?php 
	$pageID = 3;
	require('../res/meta.php'); 
	
	if (!isset($seoDone)){	?>
		<title>Forgotten your Password? | It's Christmas</title>
	<?php
	}
?>
</head>

<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
	<div id="pageHeader">
        <h1>Forgotten your password</h1>
        <?php require('../res/userPortal.php'); ?>
        <div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li>Forgotten your password</li>
            </ul>
        </div>
    </div>
    <div class="content login">
		<?php 
        if (isset($_GET['status'])){
            $status = $_GET['status'];
        } else {
            $status = false;
        }
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
