<?php session_start();

	if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	}
	// redirect back to index page if they are not friends
	include(dbconnect);
	$user=$_SESSION['admin'];
	$profilewall_sql="SELECT * FROM USER WHERE uname='{$user}'";
	$profilewall_query=mysqli_query($dbconnect, $profilewall_sql);
	$profilewall_rs=mysqli_fetch_assoc($profilewall_query);
	
	if (mysqli_num_rows($profilewall_query) > 0) {
	?>
	<div class="maincontent">
	
	<form>
	    <h1>Username: <?php echo $profilewall_rs['uname']; ?></h1>
		<p>Name: <?php echo $profilewall_rs['name']; ?></p>
		<p>Gender: <?php echo $profilewall_rs['gender']; ?></p>
		<p>Birthday: <?php echo $profilewall_rs['birthday']; ?></p>
		<p>City: <?php echo $profilewall_rs['city']; ?></p>
		<p>Favorite artists: <?php echo $profilewall_rs['favorite_artists']; ?></p>
		<p>Music preference: <?php echo $profilewall_rs['music_preference']; ?></p>
		
		<p><a href="index.php?page=userhomepage">Back to my homepage</a> | <a href="index.php?page=updateprofile">Update profile</a></p>

	</form>
	</div>
		
	<?php
	} else {
		?>
		<h1>Hi, <?php echo $_SESSION['admin']; ?>. </h1>
		<p>Your profile is quite empty. Edit it now to let your friends know more about you!</p>
		<p><a href="index.php?page=userhomepage">Back to my homepage</a> | <a href="index.php?page=editprofile">Edit profile</a></p>
		<?php
	}
?>


