<p><a href="index.php?page=search">Continu search</a> | <a href="index.php?page=userhomepage">Back to my home page</a></p>
<h1>Search results: </h1>
<?php
	session_start();

	if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	}

	if(isset($_POST['submit'])) {
		$_SESSION['search']['keyword'] = $_POST['keyword'];
	} 
    $key = $_SESSION['search']['keyword'];
    
	?>
	<h2>Related Users: </h2>
	<?php
	$reuser_sql="SELECT uname FROM REGISTRATION WHERE uname like '%{$key}%'";
	$reuser_query=mysqli_query($dbconnect, $reuser_sql);
	$reuser_rs=mysqli_fetch_assoc($reuser_query);
	
	if (mysqli_num_rows($reuser_query) > 0) {
		$reuser=$reuser_rs['uname'];

	do{
	?>
	<div class="maincontent">
	<form>
		<p><?php echo $reuser; ?></p>
	</form>
	</div>
	<?php
	} while ($reuser_rs=mysqli_fetch_assoc($reuser_query));
	} else {
		?>
		<h1>Sorry, there is no related user right now.</h1>
		<?php
	}
	?>

    <h2>Related Posts: </h2>
    <?php
    $user=$_SESSION['admin'];
	$postwall_sql="SELECT pid, pname, post_time, title, content, multimedia, location FROM POST WHERE pname='{$user}' and (title like '%$key%' or content like '%$key%')
		union 
		SELECT pid, pname, post_time, title, content, multimedia, location FROM POST inner join friendship on pname = friends WHERE (authorization=0 and (title like '%$key%' or content like '%$key%')) or (users = '{$user}' and (title like '%$key%' or content like '%$key%'))
		order by post_time DESC";
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
				$_SESSION['newlike']['pid'] = $pid;
				$_SESSION['newlike']['like_time'] = "";
			} $_SESSION['newlike']['pid'] = $pid;
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
		<h1>Sorry, there is no related post right now.</h1>
		<?php
	}
?>
	<h2>Related Activities: </h2>
	<?php
	$actwall_sql="SELECT * FROM ACTIVITY inner join ATYPE on atype=tid where aname like '%{$key}%' or description like '%{$key}%' or tname like '%{$key}%'";
	$actwall_query=mysqli_query($dbconnect, $actwall_sql);
	$actwall_rs=mysqli_fetch_assoc($actwall_query);
	
	if (mysqli_num_rows($actwall_query) > 0) {

	do{
	?>
	<div class="maincontent">
	
	<form>
	    <h1><?php echo $actwall_rs['aname']; ?> | 
	    	<?php 
	    	$atype_sql="SELECT tname FROM ATYPE WHERE tid =".$actwall_rs['atype'];
	        $atype_query=mysqli_query($dbconnect, $atype_sql);
	        $atype_rs=mysqli_fetch_assoc($atype_query);
	        echo $atype_rs['tname']; 
	        ?>
	    </h1>
		<div class="post"><?php echo $actwall_rs['description']; ?></div>
		<p>Date: <?php echo $actwall_rs['atime']; ?>   |   Location: <?php echo $actwall_rs['lid']; ?></p>

	</form>
	</div>
	<?php
	
		if (empty($actwall_rs['lid'])) {
		} else {
			$loc = $actwall_rs['lid'];
        ?><div style="text-decoration:none; padding-left:20px; overflow:hidden; height:250px; width:300px; max-width:100%;"><div id="google-maps-display" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?zoom=13&q=<?php echo $loc; ?>&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div></div>
	<?php
		}
    } while ($actwall_rs=mysqli_fetch_assoc($actwall_query));
		
	} else {
		?>
		<h1>Sorry, there is related activity right now.</h1>
		<?php
	}
	unset($_SESSION['search']);
	?>