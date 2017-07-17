<?php
	session_start();
	if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	}
	
	if(isset($_POST['like'])) {
		$_SESSION['newlike']['uname'] = $_SESSION['admin'];
echo $_SESSION['newlike']['pid'];
		
	    
		unset($_SESSION['newlike']['pid']);
echo "test";
echo $retime=date("Y-m-d H:i:s");

echo $_SESSION['newlike']['pid'];
echo "test";

	} 
?>
<h1>LIKE Added!</h1>
<p><a href="index.php?page=postwall">Back to Postwall</a></p>