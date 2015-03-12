	<div id="left" class="nonHandheld">
		<nav>
			<ul id="majorlinks">
				
				<li class="blank">&nbsp;</li>
                <?php if ($id){ ?>
                <li style="font-size:10px;height:auto;" class="blank">Logged in as <?php echo $name; ?>. <a href="logout.php" style="font-size:10px;">Not you?</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="my-christmas.php">My Christmas</a></li>
                <li><a href="change-details.php">Change your details</a></li>
                <li><a href="preferences.php">Preferences</a></li>
                <li class="blank">&nbsp;</li>
                <li class="cta"><a href="post.php">Post</a></li>
                
                <li class="blank">&nbsp;</li>
                <li><a href="logout.pgp">Log out</a></li>
                <?php } else { ?>
                <li><a href="index.php">Home</a></li>
				<li><a id="regbutton" href="register.php">Register</a></li>
				<li><a id="loginbutton" href="login.php">Login</a></li>
                <?php } ?>
				<li class="blank">&nbsp;</li>
			</ul>
			<ul id="minorlinks">
				<?php if ($snow == 'melt'){ ?>
				<li><a href="process/snow.php?snow=letitsnow">Let it snow</a></li>
				<?php } else { ?>
				<li><a href="process/snow.php?snow=melt">Melt the snow</a></li>
				<?php } ?>
				<li><a href="cookie-policy">Cookie policy</a></li>
				<li><a href="contact-us">Contact us</a></li>
			</ul>
            <div id="hiddennavcont">
            	<div id="hiddennav">
            		Hide navigation
                </div>
            </div>
		</nav>
	</div>