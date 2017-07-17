<h1>New Post</h1>
<?php
	session_start();

	if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	}

	if (!isset($_SESSION['newpost'])){
		$_SESSION['newpost']['title'] = "";
		$_SESSION['newpost']['content'] = "";
		$_SESSION['newpost']['multimedia'] = "";
		$_SESSION['newpost']['location'] = "";
		$_SESSION['newpost']['activity'] = "";
		$_SESSION['newpost']['authorization'] = "0";
		$_SESSION['newpost']['plikenum'] = "0";
	} else {
		unlink("images/gallery/".$_SESSION['newpost']['multimedia']);
	}
?>

<div class="maincontent">
	
	<form method="post" action="index.php?page=addpostconfirm" enctype="multipart/form-data"/>
		<p>Title: <input type="text" name="title" value="<?php echo $_SESSION['newpost']['title']; ?>"/></p>
		<p>Content: </p>
		<p>
		<textarea name="content" cols=60 rows=5><?php echo $_SESSION['newpost']['content']; ?></textarea>
		</p>
		<p>Photos: <input type="file" name="fileToUpload" id="fileToUpload" /></p>
		<p>Location: <input type="text" name="location" value="<?php echo $_SESSION['newpost']['location']; ?>"/></p>
		

		<p>Authorization: <select name="authorization">
			<?php $constrantlist_sql="SELECT * FROM CONSTRANT";
			      $constrantlist_query=mysqli_query($dbconnect, $constrantlist_sql);
			      $constrantlist_rs=mysqli_fetch_assoc($constrantlist_query);
			do { ?>
				<option value="<?php echo $constrantlist_rs['conid']; ?>"
				<?php 
					if ($constrantlist_rs['conid']==$_SESSION['newpost']['authorization']){
						  echo "selected=selected";
					    } 
				?>
				><?php echo $constrantlist_rs['conname']; ?></option>
			<?php } while ($constrantlist_rs=mysqli_fetch_assoc($constrantlist_query));
			?></select>
		</p>
		<input type="submit" name="submit" value="Post" />
		<p><a href="index.php?page=postwall">Go to Postwall</a></p>

	</form>
</div>