<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=1024px">
	<title>Docking Management System</title>
	<link rel="stylesheet" href="./css/main.css">
    <script type="text/javascript" src="./js/main.js"></script>
</head>

<?php 
    date_default_timezone_set('PRC');
    include "./conn_db.php";
    $link = conn_db();

    $admin = $_GET['admin'];
    $pwd = $_GET['pwd'];

    $sql = "select * from admins where name='$admin' and pwd='$pwd'";
    $res = $link->query($sql);
    $data = $res->fetch_all();
    if (sizeof($data) < 1) {
        header("location:./login.php");
    }

    function time_diff($time_diff){
        $day = floor($time_diff/86400);
        $hour = floor($time_diff%86400/3600);
        $minute = floor($time_diff%86400%3600/60);
        $second = floor($time_diff%86400%60);
        return $hour.":".$minute.":".$second;
    }
?>

<body>
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
    <!-- Query -->
    <div id="query">
        <form action="mng.php" method="get">
            <input type='hidden' name='admin' value='<?php echo $admin;?>' />
            <input type='hidden' name='pwd' value='<?php echo $pwd;?>' />
            <label>ID</label>
            <input type="text" name="id" value="<?php if($_GET['id']){echo $_GET['id'];}?>">

            <label>Boat Type</label>
            <select name="boat_type">
                <?php
                    $type_values = ['all', 'A', 'B', 'C', 'D'];
                    $type_options = ['All', 'A', 'B', 'C', 'D'];
                    if($_GET['boat_type']){
                        for($i = 0; $i < 5; $i++){
                            if($_GET['boat_type'] == $type_values[$i]) {
                                echo '<option value="'.$type_values[$i].'" selected="selected">'.$type_options[$i].'</option>';
                            } else {
                                echo '<option value="'.$type_values[$i].'">'.$type_options[$i].'</option>';
                            }
                        }
                    } else {
                        echo '<option value="all" selected="selected">All</option><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="C">C</option>';
                    }
                ?>
            </select>
            
            <label>Time</label>
            <select name="time">
                <?php 
                    $time_values = ['0', '1', '2'];
                    $time_options = ['All', 'Morning', 'Afternoon'];
                    if($_GET['time']){
                        for($i = 0; $i < 3; $i++){
                            if($_GET['time'] == $time_values[$i]) {
                                echo '<option value="'.$time_values[$i].'" selected="selected">'.$time_options[$i].'</option>';
                            } else {
                                echo '<option value="'.$time_values[$i].'">'.$time_options[$i].'</option>';
                            }
                        }
                    } else {
                    echo '<option value="0" selected="selected">All</option>
                <option value="1">Morning</option>
                <option value="2">Afternoon</option>';
                }
                ?>
            </select>
            <input type="submit" name="query" value="query" style="font-size:1em;padding:0.5em; height:2.2em;float: right;">
        </form>
    </div>
    <!-- Data Management -->
    <div id="mng">
    	<table id="db">
    		<colgroup>
				<col style="width :150px;">
				<col style="width :150px;">
				<col style="width :100px;">
				<col style="width :120px;">
				<col style="width :240px;">
				<col style="width :240px;">
				<col style="width :100px;">
                <col style="width :180px;">
                <col style="width :50px;">
			</colgroup>
    		<thead>
    			<tr>
    				<th>Mobile</th>
    				<th>Name</th>
    				<th>ID</th>
    				<th>Boat ID</th>
    				<th>Start</th>
    				<th>End</th>
    				<th>Cancel</th>
                    <th>Duration</th>
                    <th>Check</th>
    			</tr>
    		</thead>
    		<tbody>
                <?php 
        $constraints = [];

        if($_GET['boat_type'] and $_GET['boat_type'] != 'all') {
            array_push($constraints, "boat_type='{$_GET['boat_type']}'");
        }

        if($_GET['id']) {
            array_push($constraints, "id=".$_GET['id']);
        }

        if($_GET['time'] and $_GET['time'] != '0'){
            $cur_date = date('Y-m-d');
            if ($_GET['time'] == 1){
                $duration = "end between '".$cur_date." 00:00:00' and '".$cur_date." 12:00:00'";
            } else {
                $duration = "end between '".$cur_date." 12:00:00' and '".$cur_date." 23:59:59'";
            }
            array_push($constraints, $duration);
        }

        $clients = "select * from clients";
        for ($i = 0; $i < sizeof($constraints); $i++){
            if ($i == 0){
                $clients = $clients." where ".$constraints[$i];
            } else {
                $clients = $clients." and ".$constraints[$i];
            }
        }
        // echo $clients;

        $data = $link->query($clients)->fetch_all();

        for ($i = 0; $i < sizeof($data); $i++) {
            $client = $data[$i];
            echo "<tr>";
            echo "<td>".$client[2]."</td>";
            echo "<td>".$client[0]."</td>";
            echo "<td>".$client[1]."</td>";

            $boat_id = $client[8].$client[3];
            echo "<td>".$boat_id."</td>";

            if ($client[5]) {
                echo "<td>".date('Y-m-d H:i:s',strtotime($client[5]))."</td>";
            } else {
                echo "<td>
                <form action='start.php' method='get'>
                <input type='hidden' name='boat_type' value='$client[8]' />
                <input type='hidden' name='boat_id' value='$client[3]' />
                <input type='hidden' name='admin' value='$admin' />
                <input type='hidden' name='pwd' value='$pwd' />
                <input type='submit' name='start' value='Start' />
                </form>
                </td>";
                // echo "<td></td>";
            }

            if ($client[6]) {
                echo "<td>".date('Y-m-d H:i:s',strtotime($client[6]))."</td>";
            } else {
                echo "<td>
                <form action='end.php' method='get'>
                <input type='hidden' name='boat_type' value='$client[8]' />
                <input type='hidden' name='boat_id' value='$client[3]' />
                <input type='hidden' name='admin' value='$admin' />
                <input type='hidden' name='pwd' value='$pwd' />
                <input type='submit' name='end' value='End' />
                </form>
                </td>";
            }

            echo "<td><form action='cancel.php' method='get'>
                <input type='hidden' name='boat_type' value='$client[8]' />
                <input type='hidden' name='boat_id' value='$client[3]' />
                <input type='hidden' name='admin' value='$admin' />
                <input type='hidden' name='pwd' value='$pwd' />
                <input type='submit' name='cancel' value='Cancel' />
                </form></td>";
            $time_diff = 0;
            if ($client[5] and $client[6]) {
                $time_diff = strtotime($client[6]) - strtotime($client[5]);
            }
            echo "<td>".time_diff($time_diff)."</td>";
            $check = rand(0, 100);
            $idd = $i;
            if ($check >= 20 || $client[6]) {
                echo "<td id='check".$i."'><input value='Checked' readonly='readonly'/></td>";
            } else {
                echo "<td id='check".$i."'><input type='submit' name='check_exist' value='Inform' onclick=".'"check('.$idd.')"'."/></td>";
            }
            echo "</tr>";
        }
?>
    		</tbody>
    	</table>
        <?php 
            $diff_list = [];
            $max_diff = 0;
            $avg_diff = 0;
            foreach ($data as $client) {
                if ($client[5] and $client[6]) {
                    $time_diff = strtotime($client[6]) - strtotime($client[5]);
                    $avg_diff += $time_diff;
                    array_push($diff_list, $time_diff);
                    if ($time_diff > $max_diff) {
                        $max_diff = $time_diff;
                    }
                }
            }
            $avg_diff = $avg_diff/count($diff_list);
        ?>
        <button type="button" name="refresh" onclick="refresh()" style="margin-top:0.5em;width: 100px; font-size:1em;padding:0.5em;display: inline-block;float: right;">Refresh</button>
        <div class="basic_info">Renting Number: <?php echo sizeof($data);?></div>
        <div class="basic_info">Average Renting Time: <?php echo time_diff($avg_diff); ?></div>
        <div class="basic_info">Longest Renting Time: <?php echo time_diff($max_diff); ?></div>
    </div>
</body>
</html>