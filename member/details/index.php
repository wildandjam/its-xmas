<?php 
    $membercheck = true;
    require('../../res/meta.php');
?>
<title>My details | It's Christmas</title>
</head>
<body>
<?php require('../../res/headnav.php'); ?>

<div id="container" class="pageDetails">
	
	<?php
		if (isset($_REQUEST['edit']) && $_REQUEST['edit'] == "true"){
			$detailsFirst = mysqli_real_escape_string($connect, $_REQUEST['detailsFirst']);
			$detailsLast = mysqli_real_escape_string($connect, $_REQUEST['detailsLast']);
			$detailsGender = mysqli_real_escape_string($connect, $_REQUEST['detailsGender']);
			$detailsDOB = $_REQUEST['detailsDOB'];
			$detailsLocation  = mysqli_real_escape_string($connect, $_REQUEST['detailsLocation']);
			$detailsBio = mysqli_real_escape_string($connect, $_REQUEST['detailsBio']);
			$detailsAvatar = $_REQUEST['detailsAvatar'];
			$detailsAvatarFore = $_REQUEST['foreColor'];
			$detailsAvatarBack = $_REQUEST['backColor'];
			if (isset($_REQUEST['detailsPrivacy'])){
				$detailsPrivacy = 1;
			} else {
				$detailsPrivacy = 0;
			}
			$userCheckPre = mysqli_query($connect, "SELECT * FROM userdetails WHERE userID='$id'"); 
			if (mysqli_num_rows($userCheckPre) > 0){
				$preQuery = "UPDATE userdetails SET userFirstName = '$detailsFirst',userLastName = '$detailsLast',userGender = '$detailsGender', userDOB = '$detailsDOB', userBio = '$detailsBio', userAvatar = '$detailsAvatar',userAvatarFore = '$detailsAvatarFore',userAvatarBack = '$detailsAvatarBack',userLocation = '$detailsLocation' ,userPrivate = '$detailsPrivacy' WHERE userID = '$id'";
			} else {
				$preQuery = "INSERT INTO userdetails VALUES ('$id','$detailsFirst','$detailsLast','$detailsGender', '$detailsDOB', '$detailsBio', '$detailsAvatar', '$userAvatarFore','$detailsAvatarBack','$detailsLocation','$detailsPrivacy')";
			}
			$goQuery = mysqli_query($connect, $preQuery);
			if ($goQuery){
				$finishedMsg =  "<p class='successMsg'>Your details have been updated!</p>";
			} else {
				$finishedMsg =  "<p class='errorMsg'>Unforunately there was an error, please try again, and failing which please contact us.</p>";	
			}
				
			
			
			
			
		}
		
		
		if (isset($id)){
			
			$usermaincheck = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$id'");
			if (mysqli_num_rows($usermaincheck) == "1"){

				while ($userow = mysqli_fetch_array($usermaincheck)){
					$username = $userow['userName'];
					$useremail = $userow['userEmail'];	
				}
				
			}
			$usercheck = mysqli_query($connect, "SELECT * FROM userdetails WHERE userID='$id'"); 
			$count = mysqli_num_rows($usercheck);
			
			if ($count == 1){
				while($row = mysqli_fetch_array($usercheck)) {
					
					$firstname = $row['userFirstName'];
					$lastname = $row['userLastName'];
					$location = $row['userLocation'];
					$gender = $row['userGender'];
					$bio = $row['userBio'];
					$dob = $row['userDOB'];
					if ($dob == "1900-01-01 00:00:00"){
						$dob = false;	
					}
					$userPrivate = $row['userPrivate'];
				}
			}
		}
		
		
				
			
	?>
    <div id="pageHeader">
        <h1>My Details</h1>
        <?php require('../../res/userPortal.php'); ?>
        
        <div class="clearfix"></div>
        <div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/member/my-christmas/">My Christmas</a></li>
                <li>My details</li>
            </ul>
        </div>
    </div>
    <div class="content">
    <form id="changeDetails" name="changeDetails" method="post" action="/member/details/?edit=true">
    
        <?php 
			if (isset($finishedMsg)){
				echo $finishedMsg;	
			}
		?>
        
		<h2>About you</h2>        
        
        <div class="formRow">
            <span class="title hideEdit">Username:</span>
            <span class="info hideEdit">
                <?php if (isset($username)){echo $username;} ?> <span class="small">(cannot change)</span>
            </span>
        </div>
        <div class="formRow"> 
            <span class="title hideEdit">Email address:</span>
            <span class="info hideEdit"><?php if (isset($useremail)){echo $useremail;} ?> <span class="small">(cannot change)</span></span>
    	</div>
        <div class="formRow"> 
            <span class="title">First Name:</span>
            <span class="info">
                <span class="infoContent"><?php echo $firstname; ?></span>
                <input type="text" id="detailsFirst" name="detailsFirst" value="<?php echo $firstname; ?>" />
            </span>
        </div>
        <div class="formRow">   
            <span class="title">Last Name:</span>
            <span class="info">
                <span class="infoContent"><?php echo $lastname; ?></span>
                <input type="text" id="detailsLast" name="detailsLast" value="<?php echo $lastname; ?>" />
            </span>
        </div>
        
        
        
        <div class="formRow">    
            <span class="title">Gender:</span>
            <span class="info">
                <span class="infoContent"><?php echo $gender; ?></span>
                <input type="text" id="detailsGender" name="detailsGender" value="<?php echo $gender; ?>" />
            </span>
        </div>
        <div class="formRow">     
            <span class="title">Date of Birth:</span>
            <span class="info">
            	<?php 
					if ($dob){
						$redob = date("d/m/Y", strtotime($dob));
					} else {
						$redob = '';	
					}
					
				?>
				<span class="infoContent"><?php echo $redob; ?> </span>
                <input type="date" id="detailsDOB" name="detailsDOB" value="<?php echo $dob; ?>" placeholder="dd/mm/yyyy"/>
             </span>
        </div>
        <div class="formRow">   
            <span class="title">Password:</span>
            <span class="info">
                <a href="#">Change password?</a>
            </span>
        </div>  
            <h2>Your profile</h2>
        <div class="formRow">    
            <span class="title">Bio:</span>
            <span class="info">
                <span class="infoContent"><?php echo $bio; ?></span>
                <textarea id="detailsBio" name="detailsBio"><?php echo $bio; ?></textarea>
            </span>
		</div>
        <div class="formRow"> 
            <span class="title">Location:</span>
            <span class="info">
                <span class="infoContent"><?php echo $location; ?></span>
                <input type="text" id="detailsLocation" name="detailsLocation" value="<?php echo $location; ?>" />
            </span>
		</div>
        <div class="formRow">           
            <span class="title">Avatar Image:</span>
            <span class="info">
            	<?php 
            		
            		if ($userAvatarBool){
        				echo "<img src='" . $userAvatar . "' alt='" . $xUsername . "' />";
                        echo "<a href='/member/details/avatar/'>Choose an image</a>";
            		} else {
            			echo "<a href='/member/details/avatar/'>Upload an image</a>";
            		}

            	?>

            </span>    
        </div>
        <div class="formRow"> 
            <span class="title">Keep profile private?:</span>
            <span class="info">
                    <?php if ($userPrivate == "1"){ ?>
						<span class="infoContent">User profile is private</span>
                        <input type="checkbox" id="detailsPrivacy" name="detailsPrivacy" checked/>
					<?php } else { ?>
						<span class="infoContent">User profile is public</span>
                        <input type="checkbox" id="detailsPrivacy" name="detailsPrivacy" />
					<?php } ?>
            </span>
        </div>
        <div class="formRow"> 
            <span class="title">&nbsp;</span>
            <span class="info">
                <div class="link" id="editChangeDetails">Change details</div>
                <button>Change ></button>
            </span>
        </div>
		</form>
    </div>
</div>
</body>
</html>
