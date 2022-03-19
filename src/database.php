<?php

//Database credentials
$db_login_username = 'root';
$db_login_password = '';
$db = 'fypfinal';

//Connect to database
$con = new mysqli('localhost', $db_login_username, $db_login_password, $db) or die("Unable to connect");