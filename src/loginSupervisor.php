<?php

//Change credentials here if differ
//User credentials
$user_login = $_GET['username'];
$user_password = $_GET['password'];


//Database credentials
$db_login_username = "root";
$db_login_password = "";
$db = "fypfinal";

//Connect to database
$db = new mysqli("localhost", $db_login_username, $db_login_password, $db) or die("Unable to connect");

//Cross check with the database
$advisor_check_query = $db ->prepare("SELECT * FROM Advisor WHERE ADVISOR_ID = ?");
$advisor_check_query->bind_param("s",$user_login);
$advisor_check_query->execute();
$result_query = $advisor_check_query->get_result();
$advisor = $result_query->fetch_assoc();

if ($advisor) {

    if ($advisor['ADVISOR_ID'] === $user_login && $advisor['PASSWORD'] == $user_password) {
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