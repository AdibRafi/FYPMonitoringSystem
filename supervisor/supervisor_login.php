<?php
    session_start();

    require ("../src/functions.php");
    require ("../src/database.php");

    $_SESSION['token'] = getToken(20);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supervisor Login</title>
    <link rel="stylesheet" href="css/supervisor_login.css">
    <script type="text/javascript" src="js/supervisor_login.js"></script>
</head>

<body>

<form  action="../src/loginSupervisor.php" method="get" id="mainForm">

        <h1 class="welcome-msg">Login as Supervisor</h1>
        <div class="login-box">

            <table>
                <tr>
                    <th> </th>
                    <th> </th>
                </tr>
                <tr>
                    <td>
                        <img src="../src/icon/person_128px.png" alt="username icon">
                    </td>
                    <td>
                        <label>
                            <?php 
                            
                                if(isset($_GET['username'])){ 
                                    $username = $_GET['username'];
                                    echo ("<input type='text' name='username' placeholder='Username' value='$username' class='required'/>");
                                }else{
                                    echo ("<input type='text' name='username' placeholder='Username' value='' class='required'/>");
                                } 
                                
                            ?>        
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="../src/icon/lock_128px.png" alt="password icon">
                    </td>
                    <td>
                        <label>
                            <input type="password" name="password" placeholder="Password" value=""
                            class="required"/>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="../src/icon/login_128px.png" alt="login icon">
                    </td>
                    <td>
                        <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
                        <input type="submit" value="Login">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p>Don't have any account? <a href="supervisor_register.php"> Sign Up</a></p>
                    </td>
                </tr>
            </table>
        </div>
</form>
</body>
</html>