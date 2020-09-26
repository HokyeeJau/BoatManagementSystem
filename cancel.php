<?php 
	// Get parameters
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

	// Delete the information
	$delete = "delete from clients where boat_id='{$boat_id}' and boat_type='{$boat_type}'";

	// echo $delete;
	if ($link->query($delete)) {
		// echo "delete successfully!";
	    header("location:mng.php?admin={$admin}&pwd={$pwd}");
	} else {
		header("location:mng.php?admin={$admin}&pwd={$pwd}");
		echo "<script type='text/javascript'>alert($link->error)<script>";
	}
	$link->close();
?>


