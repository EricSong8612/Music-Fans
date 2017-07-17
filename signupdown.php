<?php
	session_start();

	if(!isset($_SESSION['signup'])) {
		header("Location:index.php?page=admin");
	}
	$retime=date("Y-m-d H:i:s");
	// enter the new user
	$newuser_sql = " INSERT INTO `REGISTRATION` (`uname`, `password`, `email`, `registrationtime`) VALUES ('".mysqli_real_escape_string($dbconnect,$_SESSION['signup']['uname'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['signup']['password'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['signup']['email'])."', '$retime') ";
	$newuser_qry = mysqli_query($dbconnect,$newuser_sql);
	unset($_SESSION['signup']);
?>
<p>Welcome to join Musicfans!</p>
<p><a href="index.php?page=admin">Return to admin panel</a></p>