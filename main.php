<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/main.css">
        <title>Main Page</title>
    </head>
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
                <form action="submit.php" method="get">
                    <label>Name</label><input type="text" name="name"><br />
                    <label>ID Card(4)</label><input type="text" name="id" size="18"><br />
                    <label>Mobile Number</label><input type="text" name="mobile" size="13"><br />
                    <label>Boat Type</label>
                    <select name="type">
                        <optgroup label="Normal">
                            <option value="A" selected="selected">A</option>
                            <option value="B">B</option>
                        </optgroup>
                        <optgroup label="Childish">
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </optgroup>
                    </select><br />
                    
                    <label>Boarding Number</label>
                    <select name="board_num">
                        <option value="3">1-3</option>
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
            // Alert the numbers which are illegal
            if ($_GET['alert'] == 1) {
                echo "<p>Wrong ID! Check if ID are numbers or its length is 4.</p>";
            } else if ($_GET['alert'] == 2) {
                echo "<p>Wrong ID! Check if Mobile are numbers or its length is 11.</p>";
            }
            ?>
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
