<?php
    //Get registration data
    $supervisor_name = _GET['name'];
    $supervisor_username = _GET['username'];
    $supervisor_password = _GET['password'];
    $supervisor_age = _GET['age'];
    $supervisor_email _GET['email'];

    //Database credentials
    $db_login_username = 'root';
    $db_login_password = '';
    $db = 'fypfinal';

    //Connect to database
    $db = new mysqli('localhost', $db_login_username, $db_login_password, $db) or die("Unabe to connect");

    //Run commands to insert into the database
    //Get ID of latest data entry
    $get_check_query = "SELECT ADVISOR_ID FROM Advisor"

    //Append 1 to ID

    //Insert data into database accordingly

?>