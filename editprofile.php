<?php session_start(); ?>
<h1>Hi! <?php echo $_SESSION['admin']; ?>.</h1>
<?php
	if (!isset($_SESSION['profile'])){
		$_SESSION['profile']['name'] = "";
		$_SESSION['profile']['gender'] = "";
		$_SESSION['profile']['birthday'] = "";
		$_SESSION['profile']['city'] = "";
		$_SESSION['profile']['favorite_artists'] = "";
		$_SESSION['profile']['music_preference'] = "";
	}
?>

<div class="maincontent">
	
	<h1>Enter details for your profile<h1>
	<form method="post" action="index.php?page=editprofileconfirm" enctype="multipart/form-data"/>
		<p>Name: <input type="text" name="name" value="<?php echo $_SESSION['profile']['name']; ?>"/></p>
		<p>Gender: <input type="text" name="gender" value="<?php echo $_SESSION['profile']['gender']; ?>"/></p>
		<p>Birthday: <input type="date" name="birthday" value="<?php echo $_SESSION['profile']['birthday']; ?>"/></p>
		<p>City: <input type="text" name="city" value="<?php echo $_SESSION['profile']['city']; ?>"/></p>
		<p>Favorite artists: <input type="text" name="favorite_artists" value="<?php echo $_SESSION['profile']['favorite_artists']; ?>"/></p>
		<p>Music preference:  <input type="text" name="music_preference" value="<?php echo $_SESSION['profile']['music_preference']; ?>"/></p>
		
		<input type="submit" name="submit" value="Submit" />
		<p><a href="index.php?page=profilewall">Back to my profile page</a></p>

</form>
</div>
