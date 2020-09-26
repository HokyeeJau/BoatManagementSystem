<?php 
	$boat_type = $_GET['boat_type'];
	$boat_id = $_GET['boat_id'];
	$admin = $_GET['admin'];
    $pwd = $_GET['pwd'];
	// Connect with database
	$link = new mysqli("your_host", 'user_name', 'user_pwd', 'db_name');
	$link->set_charset("utf8");
	if ($link->connect_error) {
		die("Failed Connection!".$link->connect_error);
	}

	// Insert the start time
	$insert = "update clients set start=NOW() where boat_id='$boat_id' and boat_type='$boat_type'";
	
	if ($link->query($insert)) {
	    header("location:mng.php?admin={$admin}&pwd={$pwd}");
	} else {
		echo "<script type='text/javascript'>alert(".$link->error.")<script>";
		header("location:mng.php?admin={$admin}&pwd={$pwd}");
		
	}
	$link->close();
?>


