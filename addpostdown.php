<?php
	session_start();

	if(!isset($_SESSION['newpost'])) {
		header("Location:index.php?page=userhomepage");
	}
	$retime=date("Y-m-d H:i:s");
	// enter the new user
	$newpost_sql = " INSERT INTO `POST` (`pname`, `post_time`, `title`, `content`, `multimedia`, `location`, `activity`, `authorization`) VALUES ('".mysqli_real_escape_string($dbconnect,$_SESSION['admin'])."', '$retime', '".mysqli_real_escape_string($dbconnect,$_SESSION['newpost']['title'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['newpost']['content'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['newpost']['multimedia'] )."', '".mysqli_real_escape_string($dbconnect,$_SESSION['newpost']['location'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['newpost']['activity'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['newpost']['authorization'])."') ";
	$newpost_qry = mysqli_query($dbconnect,$newpost_sql);
	unset($_SESSION['newpost']);
?>
<p>Profile Updated!</p>
<p><a href="index.php?page=postwall">Go to Postwall</a> | <a href="index.php?page=userhomepage">Return to my homepage</a></p>