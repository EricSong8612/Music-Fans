<?php
	session_start();

	if(!isset($_SESSION['frireq'])) {
		header("Location:index.php?page=userhomepage");
	}

	// enter the new friend request
	$frireqsent_sql = " INSERT INTO `REQUEST` (`rname`, `aname`) VALUES ('".mysqli_real_escape_string($dbconnect,$_SESSION['frireq']['rname'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['frireq']['aname'])."') ";
	$frireqsent_qry = mysqli_query($dbconnect,$frireqsent_sql);
	
?>
<p>Friend Request Sent!</p>
<p><a href="index.php?page=friendslist">My Friends</a> | <a href="index.php?page=userhomepage">Return to my homepage</a></p>