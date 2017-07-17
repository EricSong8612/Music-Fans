<?php session_start(); 
    if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	} 

	if(isset($_POST['submit'])) {
		$_SESSION['frireq']['aname'] = $_POST['aname'];
		
	} else {
		header("Location:index.php?page=userhomepage");
	}
	?>
	<h1>Search results: </h1>
	
    <?php
    $friend=$_SESSION['frireq']['aname'];
	$frireq_sql="SELECT uname FROM REGISTRATION WHERE uname='{$friend}'";
	$frireq_query=mysqli_query($dbconnect, $frireq_sql);
	$frireq_rs=mysqli_fetch_assoc($frireq_query);
	
	if (mysqli_num_rows($frireq_query) > 0) {
		$fri=$frireq_rs['uname'];

	do{
	?>
	<div class="maincontent">
	
	<form>
		<h1><?php echo $fri; ?></h1> 

	<?php 
	
	$profileview_sql="SELECT * FROM USER WHERE uname='{$fri}'";
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

	<?php
	$user=$_SESSION['admin'];
	$postwall_sql="SELECT * FROM POST WHERE pname='{$fri}' and authorization=0";
	$postwall_query=mysqli_query($dbconnect, $postwall_sql);
	$postwall_rs=mysqli_fetch_assoc($postwall_query);
	
	if (mysqli_num_rows($postwall_query) > 0) {

	do{
		$pid=$postwall_rs['pid'];
	?>

	<div class="maincontent">
	<form>
	    <h1><?php echo $postwall_rs['pname']; ?>: <?php echo $postwall_rs['title']; ?></h1>
		<div class="post"><?php echo $postwall_rs['content']; ?></div>
		<?php 
		if (empty($postwall_rs['multimedia'])) {

		} else {
			?>
			<div class="pic"><img src="images/gallery/<?php echo $postwall_rs['multimedia']; ?>" style="width:100%;height:100%;"/>
			</div> 
			<?php
			}
		?>
		<p>   
		Posted at: <?php echo $postwall_rs['post_time']; ?>   |    Location: <?php 
		if (empty($postwall_rs['location'])) {

		} else {
			echo $postwall_rs['location'];
			}    
		?></form>

		<?php

			if (!isset($_SESSION['newlike'])){
				$_SESSION['newlike']['uname'] = $_SESSION['admin'];
				$_SESSION['newlike']['pid'] = "";
				$_SESSION['newlike']['like_time'] = "";
			} else {$_SESSION['newlike']['pid'] = $pid;}
		?>
		<form method="post" action="index.php?page=addlikeconfirm" enctype="multipart/form-data" />
		<input  type="submit" name="like" value="Like" /> 
		(<?php 
		$likenum_sql="SELECT * FROM LIKES WHERE pid= '{$pid}'";
	    if ($likenum_query=mysqli_query($dbconnect, $likenum_sql)) {
	      	$rowcount=mysqli_num_rows($likenum_query);
	        echo $rowcount;
			} 
		?>)</form>
		<?php

			if (!isset($_SESSION['newdlike'])){
				$_SESSION['newdlike']['uname'] = $_SESSION['admin'];
				$_SESSION['newdlike']['pid'] = $pid;
				$_SESSION['newdlike']['dlike_time'] = "";
			} $_SESSION['newdlike']['pid'] = $pid;
		?>
		<form method="post" action="index.php?page=adddislikeconfirm" enctype="multipart/form-data" />
		<input  type="submit" name="dlike" value="Dislike" /> 
		(<?php 
		$dlikenum_sql="SELECT * FROM DLIKES WHERE pid= '{$pid}'";
	    if ($dlikenum_query=mysqli_query($dbconnect, $dlikenum_sql)) {
	      	$rowcount=mysqli_num_rows($dlikenum_query);
	        echo $rowcount;
			} 
		?>)</form>
		
	</div>

	<div class="comment">
		<p>
		<?php

			if (!isset($_SESSION['newcom'])){
				$_SESSION['newcom']['cname'] = $_SESSION['admin'];
				$_SESSION['newcom']['pid'] = $pid;
				$_SESSION['newcom']['comment_time'] = "";
				$_SESSION['newcom']['content'] = "";
			} $_SESSION['newcom']['pid'] = $pid;
		?>
		<form method="post" action="index.php?page=addcomconfirm" enctype="multipart/form-data"/>
		<p>
		<textarea name="content" cols=60 rows=2 ><?php echo $_SESSION['newcom']['content']; ?></textarea>
		<input type="submit" name="submit" value="Comment" />
		</p>
		</form>
		</p>

		<div class="comment1">
		<?php 
		$comwall_sql="SELECT * FROM COMMENT WHERE pid='{$pid}'";
		$comwall_query=mysqli_query($dbconnect, $comwall_sql);
		$comwall_rs=mysqli_fetch_assoc($comwall_query);
		
		if (mysqli_num_rows($comwall_query) > 0) {
			do {
		?>
		<form>
		    <p><?php echo $comwall_rs['cname']; ?> 
		    	(<?php echo $comwall_rs['comment_time']; ?> ): <?php echo $comwall_rs['content']; ?></p>
		    <div class="bound">-------------------------------------------------------------------------------------------------------------</div>
		</form>
		<?php
		} while ($comwall_rs=mysqli_fetch_assoc($comwall_query));
		} else {
			echo "0 comment";
		}
		?>
		</div>
	</div>

	
	<?php
	
	if (empty($postwall_rs['location'])) {
	} else {
		$loc=$postwall_rs['location'];
	?>
	<div style="text-decoration:none; padding-left:20px; overflow:hidden; height:250px; width:300px; max-width:100%;"><div id="google-maps-display" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?zoom=13&q=<?php echo $loc; ?>&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div></div>
	<?php
	} 
?>
	<?php
    } while ($postwall_rs=mysqli_fetch_assoc($postwall_query));
		
	} else {
		?>
		<p>Sorry, this user has no post here yet.</p>
		<?php
	}
	?>

	<a href="index.php?page=frireqsent">Send Friends Request</a>
	    
	</form>
	</div>
	<?php
    } while ($frireq_rs=mysqli_fetch_assoc($frireq_query));
    ?>
    <p><a href="index.php?page=frireq">Find New Friends</a></p>
    <?php
		
	} else {
		?>
		<p><?php echo "Sorry, no such user."; ?></p>
		<p><a href="index.php?page=frireq">Find New Friends</a></p>
		<?php
	}
?>
<p><a href="index.php?page=userhomepage">Return to my homepage</a></p>