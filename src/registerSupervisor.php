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

    function function_alert($message) {
        // Display the alert box
        echo "<script>alert('$message');</script>";
    }


    if ($supervisor_password != $supervisor_confirmpassword){
        echo ("<script>
                window.alert('Password does not match, please try again!');
                window.location.href='../supervisor/supervisor_register.html';
                </script>");
    }else{
        //Connect to database
        $db = new mysqli('localhost', $db_login_username, $db_login_password, $db) or die("Unable to connect");
        $sql = "INSERT INTO supervisor (supervisor_username,supervisor_password,supervisor_age,supervisor_email,supervisor_fullname)values(?,?,?,?,?)";
        $register_query = $db->prepare($sql);
        try{
            $register_query_result = $register_query->execute([$supervisor_username,$supervisor_password,$supervisor_age,$supervisor_email,$supervisor_fullname]);
            if($register_query_result) {
                echo ("<script>
                        window.alert('Registration completed!');
                        window.location.href='../supervisor/supervisor_login.html';
                        </script>");
            }
        }catch(Exception $e){
            echo ("<script>
                    window.alert('Information is invalid, please try again!');
                    window.location.href='../supervisor/supervisor_register.html';
                    </script>");
        }

    }

?>