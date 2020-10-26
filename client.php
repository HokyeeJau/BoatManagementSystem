<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Client</title>
	<link rel="stylesheet" href="./css/main.css">
    <script type="text/javascript" src="./js/main.js"></script>
</head>
<body>
<?php 
	date_default_timezone_set('PRC');
	include "./conn_db.php";
	$link = conn_db();
	$id = $_GET['id'];
	$mobile = $_GET['mobile'];
?>
	<!-- Top Bar -->
    <div class="top_bar">
        <div><span>Boat Management System</span></div>
        <div class="admin_login">
            <div id="time"></div>
        </div>
    </div>
    <!-- Bottom Information -->
    <div class="bottom_info">
        <p>Computer Science and Technology</p>
        <p>School of Information Science and Technology</p>
        <p>Zhejiang Sci-Tech University</p>
    </div>
    <!-- Client search page -->
    <div id="client_page">
    	<div id="client_login">
    		<form action="client.php" method="get">
    			<label>ID</label><input type="text" name="id" /><br />
	    		<label>Mobile</label><input type="text" name="mobile" /><br />
	    		<input type="submit" name="client_login" value="Check" />
    		</form>
    	</div>
    	<div id="client_history">
    		<div style="height:300px;overflow-y:auto">
    			<?php 
    			$sql = "select start, end, boat_type, boat_id from clients where id='$id' and mobile='$mobile' order by end";
			    $res = $link->query($sql);
			    $data = $res->fetch_all();
			    for($i = 0; $i<sizeof($data); $i++) {
			    	if (!$data[$i][1]){
			    		$end = $data[$i][1];
			    	} else {
			    		$end = date('Y-m-d H:i:s',strtotime(now));
			    	}
			    	echo "<div class='history_block'>
    				".strval($data[$i][2]).strval($data[$i][3])."  <span>".$data[$i][0]."</span> ->
    				<span>".$end." </span></div>";
			    }

    			?>
    			
    		</div>
    	</div>
    </div>
</body>
</html>