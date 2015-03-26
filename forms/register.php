<form id="register-user" method="post" action="/process/register.php">
    <input placeholder="Email Address" type="email" name="r-email" id="r-email" value="<?php if (isset($remail)){echo $remail; } ?>" autofocus class="hint--right" data-hint="Email address" />
    <input placeholder="Username" type="text" name="r-user" id="r-user" value="<?php if (isset($ruser)){ echo $ruser; } ?>"/>
    <input placeholder="Password" type="password" name="r-pass" id="r-pass" value="<?php if (isset($rpass)){ echo $rpass; } ?>" />
    <input placeholder="Repeat Password" type="password" name="re-pass" id="re-pass" />
	<?php
		require_once('../res/recaptchalib.php');
		$publickey = "6LfH0e8SAAAAACM7nru8zxcrhLNtvu8QTOUQrb-w"; 
		echo recaptcha_get_html($publickey);
	?>
    <div class="forminp smaller">
    	<input type="hidden" name="r-terms" id="r-terms" style="display:inline;" value="1" />
        By registering, you are agreeing to our <a href="/terms/" target="_blank">terms and conditions</a>.
    </div>
    <button type="submit">Register</button>
</form>