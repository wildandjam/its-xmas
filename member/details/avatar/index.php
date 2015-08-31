<?php 
    $membercheck = true;
    require('../../res/meta.php');
?>
<title>Avatars | It's Christmas</title>
</head>
<body>
<?php require('../../../res/headnav.php'); ?>
<div id="container" class="avatarUpload">
	<div id="pageHeader">
        <h1>My Avatars</h1>
        <?php require('../../../res/userPortal.php'); ?>
        
        <div class="clearfix"></div>
        <div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/member/my-christmas/">My Christmas</a></li>
                <li><a href="/member/details">My Details</a></li>
                <li>My avatars</li>
            </ul>
        </div>
    </div>
    <div class="content">
        <?php
            if (isset($_REQUEST['swapStatus'])){
                $swapStatus = $_REQUEST['swapStatus'];
                if (isset($swapStatus)){
                    switch($swapStatus){
                        case "success":
                            $requestMsg = "<p class='successMsg'>Your avatar has been changed.</p>";
                            break;
                        case "error":
                            $requestMsg = "<p class='errorMsg'>Someone let the polar bears loose - sorry, can you try again?</p>";
                            break;
                        case "noavatar":
                            $requestMsg = "<p class='errorMsg'>Someone let the polar bears loose - sorry, can you try again?</p>";
                            break;
                        case "userauth":
                               $requestMsg = "<p class='errorMsg'>Someone let the polar bears loose - sorry, can you try again?</p>";
                            break;
                    }
                }
            }
            if (isset($_REQUEST['status'])){
                if ($_REQUEST['status'] == "fail"){
                    if (isset($_REQUEST['failmessage'])){
                        switch($_REQUEST['failmessage']){
                            case "filesize":
                                $requestMsg = "<p class='errorMsg'>Please try and upload a smaller image.</p>";
                                break;
                            case "fileexists":
                                $requestMsg = "<p class='errorMsg'>This file already exists.</p>";
                                break;
                            case "filetype":
                                $requestMsg = "<p class='errorMsg'>Unfortunately, this file type is not supported.</p>";
                                break;
                            case "filetypeimage":
                                $requestMsg = "<p class='errorMsg'>Please try and upload an image for your avatar</p>";
                                break;
                        }
                    }
                } else if ($_REQUEST['status'] == "success"){
                    $requestMsg = "<p class='successMsg'>Your avatar has been uploaded.</p>";
                }
            }
            if (isset($requestMsg)){
                echo $requestMsg;
            }



            $avatarQuery = mysqli_query($connect, "SELECT * FROM userAvatars WHERE userID = '$xID' ORDER BY userAvatarDate DESC");
            if (mysqli_num_rows($avatarQuery) > 0){ ?>
                <div class="row">
                
            <?php
                while ($userAvatarRow = mysqli_fetch_object($avatarQuery)){
                    echo "<div class='avatarBox'><div class='avatarImage'><img src='/images/avatars/" . $userAvatarRow->userAvatarSrc . "' alt='Avatar' /></div>";
                    if ($userAvatarRow->userAvatarSelected == 1){
                        echo "<div class='avatarStatus selected'>Selected avatar</div>";
                    } else {
                        echo "<div class='avatarStatus'><a href='/process/swapAvatar.php?avatarID=" . $userAvatarRow->userAvatarID . "&uid=" . $userAvatarRow->userID . "'>Pick this avatar</a></div>";
                    }
                    echo "</div>";
                }
            ?>
            </div>
            <hr style="margin:10px 0;float:left;width:100%;clear:both"/>
            <?php
            } 
        ?>
		<form action="/process/avatarUpload.php" method="post" enctype="multipart/form-data">
		    Select image to upload:
		    <input type="file" name="fileToUpload" id="fileToUpload">
		    <button name="submitAvatar" id="submitAvatar">
                Upload image
            </button>
		</form>
	</div>
</div>
</body>
</html>