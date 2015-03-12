<?php 
	$pageID = 5;
	require('../res/meta.php'); 
	if (!$seoDone){	?>
		<title>Contact Us | It's Christmas</title>
	<?php
} ?>
<script>
  var RecaptchaOptions = { theme : 'clean' };
</script>
</head>
<body>
<?php require('../res/headnav.php'); ?>
<div id="container" class="pageContact">
	<div class="content">
    	<?php 
			$formsent = false;
			if ($_REQUEST){
				$name = $_REQUEST['contactName'];
				$email = $_REQUEST['contactEmail'];		
				$contactType = $_REQUEST['contactType'];
				$showMessage = $_REQUEST['contactMessage'];
				$message = mysqli_real_escape_string($connect, $_REQUEST['contactMessage']);
				require_once('../res/recaptchalib.php');
				$privatekey = "6LfH0e8SAAAAAJKcjMLFwzpve9SX7rOyaS3D3r2Y";
				$resp = recaptcha_check_answer ($privatekey,
											$_SERVER["REMOTE_ADDR"],
											$_POST["recaptcha_challenge_field"],
											$_POST["recaptcha_response_field"]);
			}
			
			if (isset($name) && isset($email) && isset($message)){
				if (!$resp->is_valid) {
					$msg = "<p class='errorMsg'>Sorry the Recaptcha wasn't entered correctly. Please try again.</p>";
				} else {
					 $date = date("Y-m-d H:i:s");
					 $contactQueryPart = "INSERT INTO contact VALUES ('', '$name','$email','$contactType','$message','$date','1', '')";
					 $contactQuery = mysqli_query($connect, $contactQueryPart);
					 if ($contactQuery){
							require('../phpmailer/class.phpmailer.php'); 

							$mail = new PHPMailer(); 
							
							$mail->IsSMTP();
							$mail->Host = "smtp.netcetera.co.uk";
							$mail->SMTPAuth = true;
							$mail->Username = "admin@its-xmas.co.uk";
							$mail->Password = "genius029";
							
							$mail->From = "admin@its-xmas.co.uk";
							$mail->FromName = "It's Christmas";
							$mail->AddAddress("admin@its-xmas.co.uk");
							$mail->AddBcc("andrew@its-xmas.co.uk");
							$mail->IsHTML(true);
							$mail->Subject = "Contact Form | It's Christmas";
							$mail->Body = "
							Name: $name <br />
							Email: $email<br />
							Type: $contactType<br />
							Message: $message";
							$mail->Send();
							
							
							if ($mail) {
								$msg =  "<p class='successMsg'>Your message is winging its way to Santa HQ as we speak. Santa or one of his, highly trained, elves will get back to you as soon as possible.</p>";
								$formsent = true;
								
							} else {
								 $msg =  "<p class='errorMsg'>I'm sorry, something has gone wrong with your message - but don't give up, try again! Santa really wants to hear from you.</p>";
							}
					 } else {
						 $msg =  "<p class='errorMsg'>I'm sorry, something has gone wrong with your message - but don't give up, try again! Santa really wants to hear from you.</p>";
					 }
				}
			} else {
				$msg = "<p>Please fill in all fields</p>";
			}
		?>
	   	<h1>Contact us</h1>
        <h2>Send a message to Santa HQ</h2>
        <?php echo $msg; ?>
        <?php if ($formsent != true){ ?>
            <form method="post" action="/contact/" id="contactUs" name="contactUs">
                <input type="text" id="contactName" name="contactName" value="<?php echo $name; ?>" placeholder="Your name" required/>
                <?php if (isset($email)){
					echo "<input type=\"email\" id=\"contactEmail\" name=\"contactEmail\" value=\"" . $email . "\" placeholder=\"Your email\" required />";
				} else {
					
					$emailQuery = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$id'");
					$emailCount = mysqli_num_rows($emailQuery);
					while($emailRow = mysqli_fetch_array($emailQuery)){
						$userEmail = $emailRow['userEmail'];	
					}
					
					
					echo "<input type=\"email\" id=\"contactEmail\" name=\"contactEmail\" value=\"" . $userEmail . "\" placeholder=\"Your email\" required />";
				}
				?>
                <select id="contactType" name="contactType" required>
                	<option id="none" selected>Select type</option>
                    <option id="advertising">Advertising</option>
                    <option id="complaints">Complaints</option>
                    <option id="cookies">Cookie problem</option>
                    <option id="help">Help!</option>
                    <option id="privacy">Privacy problem</option>
                    <option id="report">Report an error</option>
                    <option id="other">Other</option>
                    
                </select>
                <textarea placeholder="Your message" id="contactMessage"  name="contactMessage" required><?php if (isset($showMessage)){ echo $showMessage; } ?></textarea>
                <?php
                    require_once('../res/recaptchalib.php');
                    $publickey = "6LfH0e8SAAAAACM7nru8zxcrhLNtvu8QTOUQrb-w"; 
                    echo recaptcha_get_html($publickey);
                ?>
                <button>Send</button>
            
            </form>
    	<?php } ?>
    </div>
	<?php require('../res/sidebars.php'); ?>
</div>
<?php require('../res/admin.php'); ?>
</body>
</html>