<?php session_start(); 
    if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	} 
	?>
	<h1>Hi! <?php echo $_SESSION['admin']; ?>.</h1>
    <?php
    $user=$_SESSION['admin'];
	$reqlist_sql="SELECT * FROM REQUEST WHERE aname='{$user}' AND atime is NULL";
	$reqlist_query=mysqli_query($dbconnect, $reqlist_sql);
	$reqlist_rs=mysqli_fetch_assoc($reqlist_query);
	
	if (mysqli_num_rows($reqlist_query) > 0) {
		?>
		<h1>Here are your new friend request(s) from: </h1>
		<?php

	do{
		$user=$reqlist_rs['rname'];
	?>
	<div class="maincontent">
	
	<form method="post" action="index.php?page=frireqac" enctype="multipart/form-data"/>
	    <p><?php echo $user; ?> | <input type="submit" name="accept" value="Accept" /> <input type="submit" name="reject" value="Reject" /></p>



	<?php 
	
	$profileview_sql="SELECT * FROM USER WHERE uname='{$user}'";
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
	}
	?>
	<p>Post:</p>
	<?php

	$postview_sql="SELECT * FROM POST WHERE pname='{$user}' and authorization=0";
	$postview_query=mysqli_query($dbconnect, $postview_sql);
	$postview_rs=mysqli_fetch_assoc($postview_query);
	
	if (mysqli_num_rows($postview_query) > 0) {

	do{
	?>
	<div class="maincontent">
	
	<form>
	    <h1><?php echo $postview_rs['title']; ?></h1>
		<div class="post"><?php echo $postview_rs['content']; ?></div>
		<?php 
		if (empty($postview_rs['multimedia'])) {

		} else {
			?>
			<div class="pic"><img src="images/gallery/<?php echo $postview_rs['multimedia']; ?>" style="width:100%;height:100%;"/>
			</div> 
			<?php
			}
		?>
		<p>Like()    |    Location: <?php 
		if (empty($postview_rs['location'])) {

		} else {
			echo $postview_rs['location'];
			}
		?>      |     Related Activity: <?php 
		if (empty($postview_rs['activity'])) {

		} else {
			echo $postview_rs['activity'];
			}
		?></p>
		
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

	</form>
	</div>
	<?php
    } while ($reqlist_rs=mysqli_fetch_assoc($reqlist_query));
		
	} else {
		?>
		<p><?php echo "Sorry, you have no friend request yet."; ?></p>
		<p><a href="index.php?page=friendslist">My Friends</a></p>
		<?php
	}
?>
<p><a href="index.php?page=userhomepage">Return to my homepage</a></p>