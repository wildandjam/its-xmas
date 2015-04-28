<?php 
	require('../res/meta.php'); 
	require('../res/connect.php');
	$listID = $_REQUEST['listid'];
	if (!$listID) {
		$listID = $_REQUEST['listID'];
	}
	
	if ($listID){
		$listQuery = mysqli_query($connect, "SELECT * FROM userlist LEFT JOIN users ON (userlist.userID = users.userID) LEFT JOIN userlisttype ON (userlist.userlistType = userlisttype.userlisttypeID) WHERE userListID = '$listID'") or mysqli_error($connect);
		if (mysqli_num_rows($listQuery) == 1){
			while ($listRow = mysqli_fetch_array($listQuery)){
				$listName = $listRow['userListName'];
				$userID = $listRow['userID'];
				$authorName = $listRow['userName'];
				$private = $listRow['userListPrivate'];
				$listType = $listRow['userListType'];
				$listTypeName = $listRow['userListTypeName'];
				$listMode = $listRow['userMode'];
			}
		} else {
			header("location: /error/?page=/list/");
		}
	} else {
		header("location: /error/?page=/list/");
	}
	
	
	
?>
<title><?php echo $listName; ?> list by <?php echo $authorName; ?> | It's Christmas</title>
<meta itemprop="name" property="og:title" content="<?php echo $listName; ?> | It's Christmas" />
<meta itemprop="description" property="og:description" content="<?php echo $listName; ?> list by <?php echo $authorName; ?>" />
<meta itemprop="image" property="og:image" content="http://www.its-xmas.co.uk/images/logo/fbimage.jpg" />
<meta property="og:image:type" content="image/jpeg">
<meta property="og:site_name" content="It's Christmas" />
<meta itemprop="url" property="og:url" content="http://www.its-xmas.co.uk/list/?listid=<?php echo $listID; ?>" />
<meta property="og:determiner" content="auto" />
</head>
<body>
<!--<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function () {

	FB.init({
		appId: '655466264547809',
		status: true,
		xfbml: true
	});
	$("#fblikeholder").click(function(){
		FB.ui(
		  {
			method: 'share',
			href: document.URL
		  },
		  function(response) {
			return true;
		  }
		);
	});
};
	
	(function () {
		if (document.getElementById('facebook-jssdk')) { return; }
		var firstScriptElement = document.getElementsByTagName('script')[0],
			facebookJS = document.createElement('script');
		facebookJS.id = 'facebook-jssdk';
		facebookJS.src = '//connect.facebook.net/en_US/all.js';
		firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
	}());
</script>-->
<?php require('../res/headnav.php'); ?>
<div id="container" class="list">
	<div id="pageHeader">
		<h1><?php echo $listName; ?></h1>
		<?php require('../res/userPortal.php'); ?>
		<div class="clearfix"></div>
		<div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/lists/">Lists</a></li>
            </ul>
        </div>
		<div id="pageHeaderLinks">
			<a href="#">Search</a>
		</div>
	</div>

    	
		<?php 
            if (mysqli_num_rows($listQuery) == 1){ ?>
                
                <div id="listNamePrivacy" style=backg>
                    <h2 class="subheading">A list by <a href="/user/?uid=<?php echo $userID; ?>"><?php echo $authorName; ?></a></h2>
                 </div>
            <?php if ($private == 0 || ($private == 1 && $id == $userID)){ 
				//able to view list, switch depending on type
				switch($listType){
					case "1":
						require('type/card.php');
						
						break;
					case "2":
						require('type/mass.php');
						break;
					case "3":
						//mine
						break;
				}
					
			?>

            <?php } else { ?>
                    <p class="errorMsg">Someone is trying to keep a secret!</div>
            <?php } 
            } else {
                echo "<h1>List</h1>";
                echo "<p class='errorMsg'>Maybe you've had too much eggnog. This list doesn't exist!</p>";	
            } ?>
            
    <?php
    require_once('../res/listOverlay.php'); 
	require_once('../res/reportOverlay.php');
?>
</div>
<script type="text/javascript">
	$(function(){
		$(".changePrivacy").click(function(){
			if ($(this).hasClass("makePublic")){
				window.location.href = ('/process/changelistprivacy.php?userid=<?php echo $id;?>&listID=<?php echo $listID;?>&andlist=<?php echo md5($id) .  md5($listID); ?>&make=public'); 	
			} else {
				window.location.href = ('/process/changelistprivacy.php?userid=<?php echo $id;?>&listID=<?php echo $listID;?>&andlist=<?php echo md5($id) . md5($listID); ?>&make=private'); 
			}
		});
	});


</script>
</body>
</html>
