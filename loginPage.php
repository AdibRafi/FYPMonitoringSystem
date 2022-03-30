<?php
    session_start();

    require("src/functions.php");
    require("src/database.php");

    $_SESSION['token'] = getToken(20);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- CSS -->
    <link rel="stylesheet" href="supervisor/css/loginPage.css">
    <!-- Javascript -->
    <script type="text/javascript" src="supervisor/js/loginPage.js" defer></script>
</head>

<body>

    <div class="login-box">
        <form action="src/login.php" method="get" id="mainForm">
            <h1 class="welcome-msg">Login</h1>
            <div class="login-row">
                <img src="src/icon/person_128px.png" alt="username icon">
                <?php 
                    if(isset($_GET['username'])){ 
                        $username = $_GET['username'];
                        echo ("<input type='text' name='username' placeholder='Username' value='$username' class='required'/>");
                    }else{
                        echo ("<input type='text' name='username' placeholder='Username' value='' class='required'/>");
                    } 
                ?>        
            </div>
            <div class="login-row">
                <img src="src/icon/lock_128px.png" alt="password icon">
                <input type="password" name="password" placeholder="Password" value=""
                class="required"/>
            </div>
            <div class="login-row">
                <img src="src/icon/login_128px.png" alt="login icon">
                <input type="submit" value="Login">
                <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
            </div>
            <p>Don't have any account? <a href="registerPage.php"> Sign Up</a></p>
        </form>
    </div>
    
</body>
</html>