<?php
    //Get registration data
    $supervisor_fullname = $_GET['fullname'];
    $supervisor_username = $_GET['username'];
    $supervisor_password = $_GET['password'];
    $supervisor_confirmpassword = $_GET['confirmPassword'];
    $supervisor_age = $_GET['age'];
    $supervisor_email = $_GET['email'];

    //Database credentials
    $db_login_username = 'root';
    $db_login_password = '';
    $db = 'fypfinal';

    if ($supervisor_password != $supervisor_confirmpassword){
        echo "Password does not match!";
    }else{
        //Connect to database
        $db = new mysqli('localhost', $db_login_username, $db_login_password, $db) or die("Unable to connect");
        $sql = "INSERT INTO supervisor (supervisor_username,supervisor_password,supervisor_age,supervisor_email,supervisor_fullname)values(?,?,?,?,?)";
        $register_query = $db->prepare($sql);
        $register_query_result = $register_query->execute([$supervisor_username,$supervisor_password,$supervisor_age,$supervisor_email,$supervisor_fullname]);

        if($register_query_result){
            echo "DONE";
        }else{
            echo "GAY";
        }

    }

?>