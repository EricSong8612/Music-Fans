<?php
	session_start();

	if(!isset($_SESSION['newpost'])) {
		header("Location:index.php?page=userhomepage");
	}
	
	$newact_sql = " INSERT INTO `ACTIVITY` (`aname`, `description`, `lid`, `atype`, `atime`) VALUES ('".mysqli_real_escape_string($dbconnect,$_SESSION['newact']['aname'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['newact']['description'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['newact']['lid'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['newact']['atype'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['newact']['atime'])."') ";
	$newact_qry = mysqli_query($dbconnect,$newact_sql);
	unset($_SESSION['newact']);
?>
<p>Activity Created!</p>
<p><a href="index.php?page=activitywall">Go to Activitywall</a> | <a href="index.php?page=userhomepage">Return to my homepage</a></p>