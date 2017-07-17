<h1> Create Your Own New Activity</h1>
<?php
	session_start();

	if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	}

	if (!isset($_SESSION['newact'])){
		$_SESSION['newact']['aname'] = "";
		$_SESSION['newact']['description'] = "";
		$_SESSION['newact']['lid'] = "";
		$_SESSION['newact']['atype'] = "0";
		$_SESSION['newact']['atime'] = "";
		$_SESSION['newact']['alikenum'] = "0";
	} 
?>

<div class="maincontent">
	
	<form method="post" action="index.php?page=addactconfirm" enctype="multipart/form-data"/>
		<p>Activity Name: <input type="text" name="aname" value="<?php echo $_SESSION['newact']['aname']; ?>"/></p>
		<p>Description: </p>
		<p>
		<textarea name="description" cols=60 rows=5><?php echo $_SESSION['newact']['description']; ?></textarea>
		</p>
		<p>Location: <input type="text" name="lid" value="<?php echo $_SESSION['newact']['lid']; ?>"/></p>
		<p>Activity Type: <select name="atype">
			<?php $actlist_sql="SELECT * FROM ATYPE";
			      $actlist_query=mysqli_query($dbconnect, $actlist_sql);
			      $actlist_rs=mysqli_fetch_assoc($actlist_query);
			do { ?>
				<option value="<?php echo $actlist_rs['tid']; ?>"
				<?php 
					if ($actlist_rs['tid']==$_SESSION['newact']['atype']){
						  echo "selected=selected";
					    } 
				?>
				><?php echo $actlist_rs['tname']; ?></option>
			<?php } while ($actlist_rs=mysqli_fetch_assoc($actlist_query));
			?></select>
		</p>
		<p>Date: <input type="date" name="atime" value="<?php echo $_SESSION['newact']['atime']; ?>"/></p>
		<input type="submit" name="submit" value="Create" />

	</form>
</div>