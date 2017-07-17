<?php
	session_start();
	if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	}
	
	if(isset($_POST['submit'])) {
		$_SESSION['newcom']['cname'] = $_SESSION['admin'];
		$_SESSION['newcom']['content'] = $_POST['content'];
		$retime=date("Y-m-d H:i:s");

	    $newcom_sql = " INSERT INTO `COMMENT` (`cname`, `pid`, `comment_time`, `content`) VALUES ('".mysqli_real_escape_string($dbconnect,$_SESSION['newcom']['cname'])."', '".mysqli_real_escape_string($dbconnect,$_SESSION['newcom']['pid'])."', '$retime', '".mysqli_real_escape_string($dbconnect,$_SESSION['newcom']['content'])."') ";
		$newcom_qry = mysqli_query($dbconnect,$newcom_sql);
		unset($_SESSION['newcom']);
		
	} 
?>
<h1>Comment Successed!</h1>
<p><a href="index.php?page=postwall">Back to Postwall</a></p>