<h1>Find things you are interested in!</h1>
<?php
	session_start();

	if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	}
	if (!isset($_SESSION['search'])){
		$_SESSION['search']['keyword'] = "";
	}
?>
<div class="maincontent">
	
	<form method="post" action="index.php?page=searchdown" enctype="multipart/form-data"/>
		<input type="text" name="keyword" value="<?php echo $_SESSION['search']['keyword']; ?>"/>
		<input type="submit" name="submit" value="Search" />
		<p><a href="index.php?page=userhomepage">Back to my home page</a></p>

	</form>
</div>