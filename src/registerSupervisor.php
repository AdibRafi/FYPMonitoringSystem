<?php

    include("functions.php");
    include("database.php");

    //Get registration data
    $supervisor_fullname = $_GET['fullname'];
    $supervisor_username = $_GET['username'];
    $supervisor_password = $_GET['password'];
    $supervisor_confirmpassword = $_GET['confirmPassword'];
    $supervisor_age = $_GET['age'];
    $supervisor_email = $_GET['email'];


    $duplicate = mysqli_query($con,"select * from supervisor where supervisor_username = '$supervisor_username' or supervisor_email = '$supervisor_email'");

    //if password does not match confirm password, return error
    if ($supervisor_password != $supervisor_confirmpassword){
        echo ("<script>
        alert('Password does not match, please try again!');
        window.location.href='../supervisor/supervisor_register.html';
        </script>");
    }else{
        //if email or username found in database, return error
        if (mysqli_num_rows($duplicate) > 0){
            echo ("<script>
            alert('Email or Username taken, please try again!');
            window.location.href='../supervisor/supervisor_register.html';
            </script>");
        }
        else{
            $sql = "INSERT INTO supervisor (supervisor_username,supervisor_password,supervisor_age,supervisor_email,supervisor_fullname)values(?,?,?,?,?)";
            $register_query = $con->prepare($sql);
            try{
                $register_query_result = $register_query->execute([$supervisor_username,$supervisor_password,$supervisor_age,$supervisor_email,$supervisor_fullname]);
                if($register_query_result) {
                    echo ("<script>
                    alert('Registration Successful!');
                    window.location.href='../supervisor/supervisor_login.html.html';
                    </script>");
                }
            }catch(Exception $e){
                echo ("<script>
                alert('Something went wrong, please try again!');
                window.location.href='../supervisor/supervisor_register.html';
                </script>");
            }

        }

    }
?>