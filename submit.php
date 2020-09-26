<?php 
	// Get the parameters
	$name = $_GET['name'];
	$id = $_GET['id'];
	$mobile = $_GET['mobile'];
	$type = $_GET['type'];
	$num = $_GET['board_num'];

	if (is_nan($id) or strlen($id) != 4) {
		header("location: main.php?alert=1");
		die();
	} else if (is_nan($mobile) or strlen($mobile) != 11) {
		header("location: main.php?alert=2");
		die();
	}

	// Connect with database
	$link = new mysqli("your_host", 'user_name', 'user_pwd', 'db_name');
	$link->set_charset("utf8");
	if ($link->connect_error) {
		die("Failed Connection!".$link->connect_error);
	}

	// Generate boat id
	$if_boat_id_exist = TRUE;
	while ($if_boat_id_exist) {
		$boat_id = rand(0, 999);
		$sql = "select boat_id from clients where boat_id='{$boat_id}' and boat_type='{$type}' and rent_finish=0";
		$data = $link->query($sql)->fetch_all();
		if (!sizeof($data)) {
			$if_boat_id_exist = FALSE;
		}
	}
	
	// Insert the information into clients table
	$insert = "insert into clients (name, id, mobile, boat_type, rent_finish, board_num, boat_id) values ('$name', $id, $mobile, '$type', 0, $num, $boat_id)";
	if ($link->query($insert) === TRUE) {
	    echo "You have successfully submitted.! And your boat ID is ".$type.$boat_id;
	} else {
	    echo "Error: ".$sql."<br />".$link->error;
	}
 
	$link->close();

?>