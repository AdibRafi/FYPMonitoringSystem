<?php
    //Get registration data
    $student_name = _GET['name'];
    $student_username = _GET['username'];
    $student_password = _GET['password'];
    $student_age = _GET['age'];
    $student_email _GET['email'];

    //Database credentials
    $db_login_username = 'root';
    $db_login_password = '';
    $db = 'fypfinal';

    //Connect to database
    $db = new mysqli('localhost', $db_login_username, $db_login_password, $db) or die("Unabe to connect");
?>