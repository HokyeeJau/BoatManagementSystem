<?php 
	$boat_type = $_GET['boat_type'];
	$boat_id = $_GET['boat_id'];
	$admin = $_GET['admin'];
    $pwd = $_GET['pwd'];
	// Connect with database
	include "./conn_db.php";
	$link = conn_db();

	// Insert the end time
	$insert = "update clients set end=NOW(), rent_finish=1 where boat_id='$boat_id' and boat_type='$boat_type'";
	
	if ($link->query($insert)) {
	    header("location:mng.php?admin={$admin}&pwd={$pwd}");
	} else {
		echo "<script type='text/javascript'>alert(".$link->error.")<script>";
		header("location:mng.php?admin={$admin}&pwd={$pwd}");
		
	}
	$link->close();
?>


