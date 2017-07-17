<?php
	session_start();

	if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	}

	if (!isset($_SESSION['newcom'])){
		$_SESSION['newcom']['cname'] = $_SESSION['admin'];
		$_SESSION['newcom']['pid'] = "";
		$_SESSION['newcom']['comment_time'] = "";
		$_SESSION['newcom']['content'] = "";

	} 
?>
	
	<form method="post" action="index.php?page=addcomconfirm" enctype="multipart/form-data"/>
		<p>
		<textarea name="content" cols=60 rows=2 ><?php echo $_SESSION['newcom']['content']; ?></textarea>
		
		<input type="submit" name="submit" value="Comment" /></p>

	</form>
