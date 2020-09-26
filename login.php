<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/main.css">
        <title>Login</title>
        <script type="text/javascript" src="./js/main.js"></script>
    </head>
    <body>
        <!-- Top bar -->
        <div class="top_bar">
            <div><span>Boat Management System</span></div>
            <div class="admin_login">
                <a href="./main.php">Tourist Page</a>
            </div>
        </div>
        <!-- Main Functions -->
        <div class="blocks">
            <div class="login_form">
            <form action="mng.php" method="get">
                
                <label>Admin ID</label>
                <input type="text" name="admin"><br />
                <label>Password</label>
                <input type="password" name="pwd"><br />
                <input type="submit" name="login_in" />
            </form>
             </div>
        </div>
        <!-- Bottom Information -->
        <div class="bottom_info">
            <p>Computer Science and Technology</p>
            <p>School of Information Science and Technology</p>
            <p>Zhejiang Sci-Tech University</p>
        </div>
    </body>
</html>
