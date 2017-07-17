<?php
	session_start();
	
	// check to see if user is logging out
	if(isset($_GET['action'])) {
		if($_GET['action']=="logout") {
			unset($_SESSION['admin']);
		}
	}
	
	// if login form has been submitted, check if username and password match
	if(isset($_POST['login'])) {
		$login_sql="SELECT * FROM `REGISTRATION` WHERE uname='".$_POST['username']."' AND password='".$_POST['password']."'";
		if($login_query=mysqli_query($dbconnect, $login_sql)) {
			$login_rs=mysqli_fetch_assoc($login_query);
			$_SESSION['admin']=$login_rs['uname'];
		}
	}
	
	
	if(isset($_SESSION['admin'])) {
		include("userhomepage.php");
	} else {
		include("login.php");
	}
	
?>