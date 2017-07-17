<?php session_start(); ?>
<h1>Hi! <?php echo $_SESSION['admin']; ?>.</h1>
<?php
	$user=$_SESSION['admin'];
	$udpro_sql="SELECT * FROM USER WHERE uname='{$user}'";
	$udpro_query=mysqli_query($dbconnect, $udpro_sql);
	$udpro_rs=mysqli_fetch_assoc($udpro_query);
?>

<div class="maincontent">
	
	<h1>Enter new details for your profile<h1>
	<form method="post" action="index.php?page=udprodown" enctype="multipart/form-data"/>
		<p>Name: <input type="text" name="name" value="<?php echo $udpro_rs['name']; ?>"/></p>
		<p>Gender: <input type="text" name="gender" value="<?php echo $udpro_rs['gender']; ?>"/></p>
		<p>Birthday: <input type="date" name="birthday" value="<?php echo $udpro_rs['birthday']; ?>"/></p>
		<p>City: <input type="text" name="city" value="<?php echo $udpro_rs['city']; ?>"/></p>
		<p>Favorite artists: <input type="text" name="favorite_artists" value="<?php echo $udpro_rs['favorite_artists']; ?>"/></p>
		<p>Music preference:  <input type="text" name="music_preference" value="<?php echo $udpro_rs['music_preference']; ?>"/></p>
		
		<input type="submit" name="submit" value="Update" />
		<p><a href="index.php?page=profilewall">Back to my profile page</a></p>

</form>
</div>
