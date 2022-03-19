<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supervisor Register</title>
    <link rel="stylesheet" href="css/supervisor_register.css">
    <script type="text/javascript" src="js/supervisor_login.js"></script>
</head>
<body>
    <div class="register-box">
        <h1>Register as Supervisor</h1>
        <form id="mainForm" method="get" action="../src/registerSupervisor.php">
            <div class="register-inputfield">
                <label>
                    <input placeholder="Full Name" type="text" name="fullname" value="" class="required">
                </label>
            </div>
            <div class="register-inputfield">
                <label>
                    <input placeholder="Username" type="text" name="username" value="" class="required">
                </label>
            </div>
            <div class="register-inputfield">
                <label>
                    <input placeholder="Email" type="email" name="email" value="" class="required">
                </label>
            </div>
            <div class="register-inputfield">
                <label>
                    <input placeholder="Age" type="number" name="age" value="" class="required">
                </label>
            </div>
            <div class="register-inputfield">
                <label>
                    <input placeholder="Password" type="password" name="password" value="" class="required">
                </label>
            </div>
            <div class="register-inputfield">
                <label>
                    <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
                    <input placeholder="Confirm Password" type="password" name="confirmPassword" value="" class="required">
                </label>
            </div>
            <input type="submit" value="Register">
        </form>
        <label>Already have an account? <a href="supervisor_login.php">Sign In</a></label>
    </div>

</body>
</html>