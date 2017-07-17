<?php session_start();
	
	if(!isset($_SESSION['admin'])) {
		header("Location:index.php?page=admin");
	} else {
	?>
	<h1>Hi! <?php echo $_SESSION['admin']; ?>.</h1>
	<p><?php include ("addact.php"); ?></p>
	<?php
	}
    ?>
    <?php
	$actwall_sql="SELECT * FROM ACTIVITY";
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
		<h1>Sorry, there is no new activity right now.</h1>
		<?php
	}
?>