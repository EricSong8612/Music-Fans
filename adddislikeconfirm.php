<?php
	session_start();
	if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	}
	
	if(isset($_POST['dlike'])) {
		$_SESSION['newdlike']['uname'] = $_SESSION['admin'];
		
		$retime=date("Y-m-d H:i:s");

	    $newdlike_sql = " INSERT INTO `DLIKES` (`uname`, `dlike_time`, `pid`) VALUES ('".mysqli_real_escape_string($dbconnect,$_SESSION['newdlike']['uname'])."', '$retime', '".mysqli_real_escape_string($dbconnect,$_SESSION['newdlike']['pid'])."') ";
		$newdlike_qry = mysqli_query($dbconnect,$newdlike_sql);
		unset($_SESSION['newdlike']);
		
	} 
?>
<h1>DISLIKE Added!</h1>
<p><a href="index.php?page=postwall">Back to Postwall</a></p>