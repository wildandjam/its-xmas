<form method="post" action="/login/" name="login" id="login">
	<input type="text" placeholder="Username/Email Address" id="lname" name="lname" autofocus tabindex="1"/>
	<input type="password" placeholder="Password" id="lpass" name="lpass" tabindex="2" /><br />
	<input type="hidden" id="from" name="from" value="<?php echo $fromurl; ?>"/>
	<button type="submit" value="Login" tabindex="3">Login</button>
</form>
<div class="loginLinks">
	<div id="passwordLink">
		<a href="/forgotten-password/">Forgotten your password?</a>
    </div>
	<div id="registerLink">
        <a href="/register/">Register</a>
    </div>
</div>