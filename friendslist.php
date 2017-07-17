<?php session_start(); 
    if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	} 
	?>
	<h1>Hi! <?php echo $_SESSION['admin']; ?>.</h1>

    <?php
    $user=$_SESSION['admin'];
	$frilist_sql="SELECT * FROM friendship WHERE users='{$user}'";
	$frilist_query=mysqli_query($dbconnect, $frilist_sql);
	$frilist_rs=mysqli_fetch_assoc($frilist_query);
	
	if (mysqli_num_rows($frilist_query) > 0) {
	?>
	<h1>Friends: </h1>
	<?php
	do{
	?>
	<div class="maincontent">
	
	<form>
		<p><?php echo $frilist_rs['friends']; ?> | since<?php echo $frilist_rs['time']; ?></p>

	</form>
	</div>
	<?php
    } while ($frilist_rs=mysqli_fetch_assoc($frilist_query));
    ?>
	<p><a href="index.php?page=frireq">Find New Friends</a></p>
	<?php
	} else {
		?>
		<p><?php echo "Sorry, you have no friend here yet."; ?></p>
		<p><a href="index.php?page=frireq">Find New Friends</a></p>
		<?php
	}
?>
<p><a href="index.php?page=userhomepage">Return to my homepage</a></p>