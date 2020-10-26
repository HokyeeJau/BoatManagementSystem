<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/main.css">
        <title>Main Page</title>
    </head>
<?php 

include "./conn_db.php";
$link = conn_db();

?>
    <body>
        <!-- Top Bar -->
        <div class="top_bar">
            <div><span>Boat Management System</span></div>
            <div class="admin_login">
                <a href="./login.php">Admin Login</a>
            </div>
        </div>
        <!-- Main Functions -->
        <div class="blocks">
            <div class="app_table">
                <form action="submitFromApp.php" method="get">
<?php 
    $A = "select count(boat_id) from clients where boat_type='A'";
    $B = "select count(boat_id) from clients where boat_type='B'";
    $C = "select count(boat_id) from clients where boat_type='C'";
    $D = "select count(boat_id) from clients where boat_type='D'";
    $res = $link->query($A);
    $a = $res->fetch_all();
    $res = $link->query($B);
    $b = $res->fetch_all();
    $res = $link->query($C);
    $c = $res->fetch_all();
    $res = $link->query($D);
    $d = $res->fetch_all();
?>
                    <label>Name</label><input type="text" name="name"><br />
                    <label>ID Card(4)</label><input type="text" name="id" size="18"><br />
                    <label>Mobile Number</label><input type="text" name="mobile" size="13"><br />
                    <label>Boat Type</label>
                    <select name="type">
                        <optgroup label="Normal">
                            <option value="A" <?php if($a[0][0]>=1000) echo "disabled='disabled'";?>>A</option>
                            <option value="B"<?php if($b[0][0]>=1000) echo "disable='disabled'";?>>B</option>
                        </optgroup>
                        <optgroup label="Childish">
                            <option value="C"<?php if($c[0][0]>=1000) echo "disabled='disabled'";?>>C</option>
                            <option value="D"<?php if($d[0][0]>=1000) echo "disabled='disabled'";?>>D</option>
                        </optgroup>
                    </select><br />
                    <div class="rent_num">
                    <?php 
                        echo "<span> Available Number: A: ".(1000-$a[0][0])
                        ." B: ".(1000-$b[0][0])
                        ." C: ".(1000-$c[0][0])
                        ." D: ".(1000-$d[0][0])."</span>";
                    ?>
                    </div>

                    <label>Boarding Number</label>
                        <select name="board_num">
                            <option value="3" checked="checked">1-3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">Over 7</option>
                        </select><br />
                    <button type="submit" name="confirm">Confirm</button>
                </form>
            </div>
            <?php 
            if ($_GET['alert'] == 1) {
                echo "<p>Wrong ID! Check if ID are numbers or its length is 4.</p>";
            } else if ($_GET['alert'] == 2) {
                echo "<p>Wrong ID! Check if Mobile are numbers or its length is 11.</p>";
            }
            ?>
            <div style="margin-left:100px;margin-top:10px"><a href="./client.php">Client Check</a></div>
        </div>
        <!-- Bottom Information -->
        <div class="bottom_info">
            <div class="source">
                <p>Computer Science and Technology</p>
                <p>School of Information Science and Technology</p>
                <p>Zhejiang Sci-Tech University</p>
            </div>
        </div>
    </body>
</html>
