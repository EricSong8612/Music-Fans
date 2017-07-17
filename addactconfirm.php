<?php
	session_start();
	
	if(isset($_POST['submit'])) {
		$_SESSION['newact']['aname'] = $_POST['aname'];
		$_SESSION['newact']['description'] = $_POST['description'];
		$_SESSION['newact']['lid'] = $_POST['lid'];
		$_SESSION['newact']['atype'] = $_POST['atype'];
		$_SESSION['newact']['atime'] = $_POST['atime'];
		
	} 

	?>
    <div class="maincontent">

    <h1>Please confirm the information:</h1>
	<p>Activity Name: <?php echo $_SESSION['newact']['aname']; ?></p>
	<p>Description: <?php echo $_SESSION['newact']['description']; ?></p>
    <p>Location: <?php echo $_SESSION['newact']['lid']; ?></p>
	<p>Activity Type: 
	<?php 
	$tname_sql="SELECT tname FROM ATYPE WHERE tid=".$_SESSION['newact']['atype'];
	$tname_query=mysqli_query($dbconnect, $tname_sql);
	$tname_rs=mysqli_fetch_assoc($tname_query);
	echo $tname_rs['tname'];
	?>
	</p>
	<p>Date: <?php echo $_SESSION['newact']['atime']; ?></p>		

<p><a href="index.php?page=addactdown">Correct, continue</a> | <a href="index.php?page=addact">Oops, go back</a>
</p>
</div>
		
