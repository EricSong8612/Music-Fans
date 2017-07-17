<h1>Please confirm your information:</h1>
<?php session_start(); 
if(isset($_POST['submit'])) {
		$_SESSION['profile']['name'] = $_POST['name'];
		$_SESSION['profile']['gender'] = $_POST['gender'];
		$_SESSION['profile']['birthday'] = $_POST['birthday'];
		$_SESSION['profile']['city'] = $_POST['city'];
		$_SESSION['profile']['favorite_artists'] = $_POST['favorite_artists'];
		$_SESSION['profile']['music_preference'] = $_POST['music_preference'];
	} else {
		header("Location:index.php?page=userhomepage");
	}
?>
<p>Name: <?php echo $_SESSION['profile']['name']; ?></p>
<p>Gender: <?php echo $_SESSION['profile']['gender']; ?></p>
<p>Birthday: <?php echo $_SESSION['profile']['birthday']; ?></p>
<p>City: <?php echo $_SESSION['profile']['city']; ?></p>
<p>Favorite artists: <?php echo $_SESSION['profile']['favorite_artists']; ?></p>
<p>Music preference:  <?php echo $_SESSION['profile']['music_preference']; ?></p>

<p><a href="index.php?page=profiledown">Correct, continue</a> | <a href="index.php?page=editprofile">Oops, go back</a></p>