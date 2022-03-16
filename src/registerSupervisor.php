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
    $db = new mysqli('localhost', $db_login_username, $db_login_password, $db) or die("Unable to connect");
?>