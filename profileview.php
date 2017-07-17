<?php 
	
	session_start(); 
    if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	} 
	$temp=$_GET['user'];
	?>
	<h1><?php echo $temp; ?></h1>
	
	<?php 
	
	$profileview_sql="SELECT * FROM USER WHERE uname='{$temp}'";
	$profileview_query=mysqli_query($dbconnect, $profileview_sql);
	$profileview_rs=mysqli_fetch_assoc($profileview_query);
	
	if (mysqli_num_rows($profileview_query) > 0) {
	?>
	<div class="maincontent">
	
	<form>

		<p>Name: <?php echo $profileview_rs['name']; ?></p>
		<p>Gender: <?php echo $profileview_rs['gender']; ?></p>
		<p>Birthday: <?php echo $profileview_rs['birthday']; ?></p>
		<p>City: <?php echo $profileview_rs['city']; ?></p>
		<p>Favorite artists: <?php echo $profileview_rs['favorite_artists']; ?></p>
		<p>Music preference: <?php echo $profileview_rs['music_preference']; ?></p>
		
	</form>
	</div>
		
	<?php
	} else { echo $temp;}
	?>

	<?php

	$postview_sql="SELECT * FROM POST WHERE pname='{$temp}' and authorization=0";
	$postview_query=mysqli_query($dbconnect, $postview_sql);
	$postview_rs=mysqli_fetch_assoc($postview_query);
	
	if (mysqli_num_rows($postview_query) > 0) {

	do{
	?>
	<div class="maincontent">
	
	<form>
	    <h1><?php echo $postview_rs['title']; ?></h1>
		<div class="post"><?php echo $postview_rs['content']; ?></div>
		<div class="pic"><img src="images/gallery/<?php echo $postview_rs['multimedia']; ?>" style="width:100%;height:100%;"/></div>

	</form>
	</div>
	<?php
    } while ($postview_rs=mysqli_fetch_assoc($postview_query));
		
	} else {
		?>
		<p>Sorry, this user has no post here yet.</p>
		<?php
	}
?>