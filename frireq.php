<h1>Find New Friends</h1>
<?php
	session_start();

	if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	}

	if (!isset($_SESSION['frireq'])){
		$_SESSION['frireq']['rname'] = $_SESSION['admin'];
		$_SESSION['frireq']['aname'] = "";
		$_SESSION['frireq']['atime'] = "";
		
	} 
?>

<div class="maincontent">
	
	<form method="post" action="index.php?page=frireqconfirm" enctype="multipart/form-data"/>
		<p>Username: <input type="text" name="aname" value="<?php echo $_SESSION['newpost']['aname']; ?>"/></p>
		<input type="submit" name="submit" value="Search" />
		<p><a href="index.php?page=friendslist">My Friends</a></p>
	</form>
</div>
<p><a href="index.php?page=userhomepage">Return to my homepage</a></p>