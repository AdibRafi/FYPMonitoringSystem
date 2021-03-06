<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-widt~h, initial-scale=1">
    <title>Supervisor Register</title>
    <!-- CSS -->
    <link rel="stylesheet" href="supervisor/css/registerPage.css">
    <!-- Javascript -->
    <script type="text/javascript" src="supervisor/js/loginPage.js"></script>
</head>
<body>
<div class="register-box">
    <h1 id="registerTitle">Register as Supervisor</h1>
    <form id="mainForm" method="get" action="src/register.php">
        <div class="register-inputfield">
            <label>
                <?php
                if (isset($_GET['fullname'])) {
                    $fullname = $_GET['fullname'];
                    echo("<input placeholder='Full Name' type='text' name='fullname' value='$fullname' class='required'>");
                } else {
                    echo('<input placeholder="Full Name" type="text" name="fullname" value="" class="required">');
                }
                ?>
            </label>
        </div>
        <div class="register-inputfield">
            <label>
                <?php
                if (isset($_GET['username'])) {
                    $username = $_GET['username'];
                    echo("<input placeholder='Username' type='text' name='username' value='$username' class='required'>");
                } else {
                    echo('<input placeholder="Username" type="text" name="username" value="" class="required">');
                }
                ?>
            </label>
        </div>
        <div class="register-inputfield">
            <label>
                <?php
                if (isset($_GET['email'])) {
                    $email = $_GET['email'];
                    echo("<input placeholder='Email' type='email' name='email' value='$email' class='required'>");
                } else {
                    echo('<input placeholder="Email" type="email" name="email" value="" class="required">');
                }
                ?>
            </label>
        </div>
        <div class="register-inputfield">
            <label>
                <?php
                if (isset($_GET['age'])) {
                    $age = $_GET['age'];
                    echo("<input placeholder='Age' type='number' name='age' value='$age' class='required'>");
                } else {
                    echo('<input placeholder="Age" type="number" name="age" value="" class="required">');
                }
                ?>
            </label>
        </div>
        <div class="register-inputfield">
            <label>
                <input placeholder="Password" type="password" name="password" value="" class="required">
            </label>
        </div>
        <div class="register-inputfield">
            <label>
                <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token">
                <input placeholder="Confirm Password" type="password" name="confirmPassword" value="" class="required">
            </label>
        </div>

        <div class="register-inputfield" id="professionInput" style="display: block">
            <label>
                <input placeholder="Profession" type="text" name="profession" value="">
            </label>
        </div>

        <div class="register-inputfield">
            <label>
                Register as:
                <select name="userType" id="userType" onchange="professionCheck(this);">
                    <option value="supervisor">Supervisor</option>
                    <option value="student">Student</option>
                </select>
            </label>
        </div>
        <input type="submit" value="Register">
    </form>
    <label>Already have an account? <a href="loginPage.php">Sign In</a></label>
</div>

</body>
</html>