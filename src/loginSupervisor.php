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
$db = new mysqli('localhost', $user_login, $password_login, $db) or die("Unabe to connect");

//Cross check with the database
$advisor_check_query = "SELECT * FROM Advisor WHERE ADVISOR_ID = '$user_login'";
$result_query = mysqli_query($db, $advisor_check_query);
$advisor = mysqli_fetch_assoc($result_query);

if ($advisor) {

    if ($advisor['ADVISOR_ID'] === $user_login && $advisor['PASSWORD'] == $password_login) {
        echo "Log in successful!";
    }
    
    else {
        echo "Log in failed!";
    }
    
}

else {
    echo "ERROR: Login broke";
}

?>