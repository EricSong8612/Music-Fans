<?php
	session_start();
	
	if(isset($_POST['submit'])) {
		$_SESSION['signup']['uname'] = $_POST['uname'];
		$_SESSION['signup']['password'] = $_POST['password'];
		$_SESSION['signup']['email'] = $_POST['email'];
	} else {
		header("Location:index.php?page=admin");
	}

?>
<h1>Please confirm your information:</h1>
<p>The username you choose is: <?php echo $_SESSION['signup']['uname']; ?></p>
<p>The password you choose is: <?php echo $_SESSION['signup']['password']; ?></p>
<p>The email address you enter is: <?php echo $_SESSION['signup']['email']; ?></p>

<p><a href="index.php?page=signupdown">Correct, continue</a> | <a href="index.php?page=signup">Oops, go back</a></p>