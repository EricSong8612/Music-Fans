<?php
	session_start();
	
	if(isset($_POST['submit'])) {
		$_SESSION['newpost']['title'] = $_POST['title'];
		$_SESSION['newpost']['content'] = $_POST['content'];
		$_SESSION['newpost']['multimedia'] = $_POST['multimedia'];
		$_SESSION['newpost']['location'] = $_POST['location'];
		$_SESSION['newpost']['activity'] = $_POST['activity'];
		$_SESSION['newpost']['authorization'] = $_POST['authorization'];
		
	} else {
		header("Location:index.php?page=userhomepage");
	}

	?>
    <div class="maincontent">

    <h1>Please confirm the information:</h1>
	<p>Title: <?php echo $_SESSION['newpost']['title']; ?></p>
	<p>Content: <?php echo $_SESSION['newpost']['content']; ?></p>
	<p>Photos/Videos: </p>
	<p><?php
	if ($_FILES['fileToUpload']['name']) {
		$_SESSION['newpost']['multimedia']=$_FILES['fileToUpload']['name'];
		$target_dir = "images/gallery/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
   	 		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    		if($check !== false) {
	 			$uploadOk = 1;
    		} else {
       			$uploadOk = 0;
    		}
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
    	echo "Sorry, your file is too large.";
    	$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
    	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    	$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
  	  echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      	    ?>
			
				<div class="pic"><img src="images/gallery/<?php echo $_SESSION['newpost']['multimedia']; ?>" style="width:100%;height:100%;"/></div>
			
			
      	<?php
    		} else {
       		 echo "Sorry, there was an error uploading your file.";
   	 			}
			}
	}
	else {
		echo "No content";
	}
?>
<p>Location: <?php echo $_SESSION['newpost']['location']; ?></p>
<p>Authorization: 
	<?php 
	$auname_sql="SELECT conname FROM CONSTRANT WHERE conid=".$_SESSION['newpost']['authorization'];
	$auname_query=mysqli_query($dbconnect, $auname_sql);
	$auname_rs=mysqli_fetch_assoc($auname_query);
	echo $auname_rs['conname'];

	?>
</p>	



		
	<?php
	
	if (empty($_SESSION['newpost']['location'])) {
	} else {
		$loc=$_SESSION['newpost']['location'];
	?>
	<div style="text-decoration:none; padding-left:20px; overflow:hidden; height:250px; width:300px; max-width:100%;"><div id="google-maps-display" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?zoom=13&q=<?php echo $loc; ?>&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div></div>
	<?php
	} 
?>
<p><a href="index.php?page=addpostdown">Correct, continue</a> | <a href="index.php?page=addpost">Oops, go back</a>
</p>
</div>
