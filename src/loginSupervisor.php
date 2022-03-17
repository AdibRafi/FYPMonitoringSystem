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
$advisor_check_query = $db ->prepare("SELECT * FROM supervisor WHERE supervisor_username = ?");
$advisor_check_query->bind_param("s",$user_login);
$advisor_check_query->execute();
$result_query = $advisor_check_query->get_result();
$advisor = $result_query->fetch_assoc();

if ($advisor) {

    if ($advisor['supervisor_username'] === $user_login && $advisor['supervisor_password'] == $user_password) {
        echo ("<script>
                window.alert('Log in successful!');
                window.location.href='../supervisor/supervisor_dashboard.html';
                </script>");
    }
    else {
        echo ("<script>
                window.alert('Log in failed!');
                window.location.href='../supervisor/supervisor_login.html';
                </script>");
    }

}

else {
    echo "ERROR: Login broke";
}

?>