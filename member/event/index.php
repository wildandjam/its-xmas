<?php 
    $membercheck = true;
	require('../../res/meta.php');
?>
<title>New event | It's Christmas</title> 
</head>
<body>
<?php require('../../res/headnav.php'); ?>
<div id="container">
    <div id="pageHeader">
        <h1>New Event</h1>
        <div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/member/my-christmas/">My Christmas</a></li>
            </ul>
        </div>
        
        <?php require('../../res/userPortal.php'); ?>
        
        <div id="pageHeaderLinks">
           
            
        </div>
    </div>
    <form method="post" action="options/" name="postitem" id="postitem">
        <input type="hidden" value="<?php echo $id; ?>" name="user" id="user" />
        
    </form>
</div>
</body>
</html>
