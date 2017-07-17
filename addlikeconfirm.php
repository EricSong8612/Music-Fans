<?php
	session_start();
	if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	}
	
	if(isset($_POST['like'])) {
		$_SESSION['newlike']['uname'] = $_SESSION['admin'];
		$retime=date("Y-m-d H:i:s");

	    $newlike_sql = " INSERT INTO `LIKES` (`uname`, `like_time`, `pid`) VALUES ('".mysqli_real_escape_string($dbconnect,$_SESSION['newlike']['uname'])."', '$retime', '".mysqli_real_escape_string($dbconnect,$_SESSION['newlike']['pid'])."') ";
		$newlike_qry = mysqli_query($dbconnect,$newlike_sql);
		unset($_SESSION['newlike']['pid']);

	} 
?>
<h1>LIKE Added!</h1>
<p><a href="index.php?page=postwall">Back to Postwall</a></p>