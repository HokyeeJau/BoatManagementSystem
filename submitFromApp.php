<?php 
	// Get the parameters
	$name = $_GET['name'];
	$id = $_GET['id'];
	$mobile = $_GET['mobile'];
	$type = $_GET['type'];
	$num = $_GET['board_num'];

	$false_json = array("success"=>"0");
	header('Content-type:text/json');

	if (is_nan($id) or strlen($id) != 4) {
		echo json_encode($false_json);
		die();
	} else if (is_nan($mobile) or strlen($mobile) != 11) {
		echo json_encode($false_json);
		die();
	} else {
		// Connect with database
		include "./conn_db.php";
		$link = conn_db();

		// Generate boat id
		$if_boat_id_exist = TRUE;
		$summ = [];
		for($i = 0; $i < 1000; $i++){
			array_push($summ, $i); 
		}
		while ($if_boat_id_exist) {
			$boat_id = rand(0, 999);
			$sql = "select boat_id from clients where boat_id='{$boat_id}' and boat_type='{$type}' and rent_finish=0";
			$data = $link->query($sql)->fetch_all();
			if (!sizeof($data)) {
				$if_boat_id_exist = FALSE;
			} 
			$summ = array_diff($summ, [$boad_id]);
			if (!sizeof($summ)) {
				$boat_id = -1;
				$if_boat_id_exist = FALSE;
				echo json_encode($false_json);
				die();
			}
		}
		
		$insert = "insert into clients (name, id, mobile, boat_type, rent_finish, board_num, boat_id) values ('$name', $id, $mobile, '$type', 0, $num, $boat_id)";
		if ($link->query($insert) === TRUE and $boat_id !== -1) {
			$return_json = array(
				"success"=>"1",
				"type"=>$type,
				"boat_id"=>$boat_id,
				"name"=>$name,
				"id"=>$id
			);
			echo json_encode($return_json);
		} else {
			echo json_encode($false_json);
			die();
		}
		$link->close();
	}
?>