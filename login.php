<h1>Login</h1>
<form name="login" method="post" action="index.php?page=admin">
<p>Username <input name="username" type="text" maxlength=20 /></p>
<p>Password <input name="password" type="password" maxlength=20 /></p>
<?php 
	if(isset($_POST['login']) && !isset($_SESSION['admin'])) {
		?>
		<p><span class="error">Incorrect username or password</span></p>
		<?php
	}
?>

<p><input type="submit" name="login" value="Login" /></p>
<p>New user? <input type="button" onclick="window.location.href='index.php?page=signup'" value="Sign Up" /></p>
</form>