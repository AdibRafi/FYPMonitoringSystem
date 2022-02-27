<?php

//Change credentials here if differ
//User credentials
$user_login = _GET['username'];
$user_password = _GET['password'];


//Database credentials
$db_login_username = 'root';
$db_login_password = '';
$db = 'fypfinal';

//Connect to database
$db = new mysqli('localhost', $db_login_username, $db_login_password, $db) or die("Unabe to connect");

//Cross check with the database
$advisor_check_query = "SELECT * FROM Student WHERE USER_ID = '$user_login'";
$result_query = mysqli_query($db, $advisor_check_query);
$student = mysqli_fetch_assoc($result_query);

if ($student) {

    if ($student['USER_ID'] === $user_login && $student['PASSWORD'] == $password_login) {
        echo "Log in successful!";
    }
    
    else {
        echo "Log in failed!";
    }
    
}

else {
    echo "ERROR: Login broke";
}