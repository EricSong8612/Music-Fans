<?php session_start(); 
if(isset($_POST['accept'])) {
		?><h1>You are friends now!</h1>
		<?php
		$retime=date("Y-m-d H:i:s");
		$acreq_sql = " UPDATE `REQUEST` SET `atime` = '{$retime}' WHERE `rname` = '{$_SESSION['frireq']['rname']}' AND
		`aname` = '{$_SESSION['frireq']['aname']}'";
		$acreq_qry = mysqli_query($dbconnect,$acreq_sql);
		unset($_SESSION['frireq']);
	} else {
		?><h1>You have rejected the friends request!</h1>
		<?php
		$rereq_sql = " DELETE FROM `REQUEST` WHERE `rname` = '{$_SESSION['frireq']['rname']}' AND
		`aname` = '{$_SESSION['frireq']['aname']}'";
		$rereq_qry = mysqli_query($dbconnect,$rereq_sql);
		unset($_SESSION['frireq']);
	}
?>
<p><a href="index.php?page=userhomepage">Return to my homepage</a></p>