<?php
	session_start();

	if(!isset($_SESSION['profile'])) {
		header("Location:index.php?page=userhomepage");
	}
	
	// enter the new profile
	$newprofile_sql = " INSERT INTO `USER` (`uname`, `name`, `gender`, `birthday`, `city`, `favorite_artists`, `music_preference`) VALUES ('".mysqli_real_escape_string($dbconnect,$_SESSION['admin'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['profile']['name'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['profile']['gender'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['profile']['birthday'])."','".mysqli_real_escape_string($dbconnect,$_SESSION['profile']['city'])."','".mysqli_real_escape_string($dbconnect,$_SESSION['profile']['favorite_artists'])."','".mysqli_real_escape_string($dbconnect,$_SESSION['profile']['music_preference'])."') ";
	$newprofile_qry = mysqli_query($dbconnect,$newprofile_sql);
	unset($_SESSION['profile']);
?>
<p>Profile Updated!</p>
<p><a href="index.php?page=userhomepage">Return to my homepage</a></p>