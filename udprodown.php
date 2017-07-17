<?php
	session_start();

	if(isset($_POST['submit'])) {
		$uname = $_SESSION['admin'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$birthday = $_POST['birthday'];
		$city = $_POST['city'];
		$favorite_artists = $_POST['favorite_artists'];
		$music_preference = $_POST['music_preference'];

		$udprofile_sql = 
		"UPDATE `USER` 
		SET 
		`name` = '{$name}', `gender` = '{$gender}', `birthday` = '{$birthday}', `city` = '{$city}', `favorite_artists` = '{$favorite_artists}', `music_preference` = '{$music_preference}'
		WHERE `uname` = '{$uname}'";
		$udprofile_qry = mysqli_query($dbconnect,$udprofile_sql);
		
	}
?>
<p>Profile Updated!</p>
<p><a href="index.php?page=userhomepage">Return to my homepage</a></p>