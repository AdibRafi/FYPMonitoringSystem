<?php

    //Database credentials
    $db_login_username = 'root';
    $db_login_password = '';
    $db = 'fypfinal';
    $db_hostname = 'localhost';

    //Connect to database
    $con = new mysqli($db_hostname, $db_login_username, $db_login_password, $db) or die("Unable to connect");