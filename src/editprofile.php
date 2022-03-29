<?php

require "functions.php";
require "database.php";

session_start();
$userdata = checkLogin($con);

if(isset($_GET['changePasword'])){
    $changePassword = $_GET['changePasword'];
}

if(isset($_GET['changeEmail'])){
    $changeEmail = $_GET['changeEmail'];
}



if (!empty($changePassword)){
    if($changePassword === $userdata['PASSWORD']){
        echo("
        <script>
        alert('Password is the same, please try again with a different password');
        window.location.href='../supervisor/editProfile.php';
        </script>
        ");
    }else{
        //Do query to update database
    }
}

if (!empty($changeEmail)){
    if($changeEmail === $userdata['EMAL']){
        echo("
        <script>
        alert('Email is the same, please try again with a different Email');
        window.location.href='../supervisor/editProfile.php';
        </script>
        ");
    }else{
        //Do query to update database
    }
}