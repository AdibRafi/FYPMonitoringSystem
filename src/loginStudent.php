<?php

//Change credentials here if differ
$user_login = 'root';
$password_login = '';
$db = 'fypfinal';

//Connect to database
$db = new mysqli('localhost', $user_login, $password_login, $db) or die("Unabe to connect");

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