<?php 
	$boat_type = $_GET['boat_type'];
	$boat_id = $_GET['boat_id'];
	$admin = $_GET['admin'];
    $pwd = $_GET['pwd'];

	// Connect with database
	include "./conn_db.php";
	$link = conn_db();

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


