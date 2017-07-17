<h1>Sign Up</h1>
<?php
	session_start();

	if (!isset($_SESSION['signup'])){
		$_SESSION['signup']['uname'] = "";
		$_SESSION['signup']['password'] = "";
		$_SESSION['signup']['email'] = "";
	}
?>

<div class="maincontent">
	
	<h1>Enter details for new user<h1>
	<form method="post" action="index.php?page=confirmsignup" enctype="multipart/form-data"/>
		<p>Username: <input type="text" name="uname" value="<?php echo $_SESSION['signup']['uname']; ?>"/></p>
		<p>Password: <input type="text" name="password" value="<?php echo $_SESSION['signup']['password']; ?>"/></p>
		<p>Email: <input type="text" name="email" value="<?php echo $_SESSION['signup']['email']; ?>"/></p>
		<input type="submit" name="submit" value="Submit" />
		<p><a href="index.php?page=admin">Back to admin panel</a></p>

</form>
</div>
