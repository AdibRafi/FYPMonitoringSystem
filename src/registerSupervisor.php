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

    //only allowing user to enter pattern [a-zA-Z0-9] regular expression
    if (!preg_match("/^[a-zA-z0-9]+$/",$supervisor_username)) {
        echo("<script>
        alert('Invalid username, please try again!');
        window.location.href='../supervisor/supervisor_register.html';
        </script>");
    }

    $duplicate = "select * from supervisor where supervisor_username = ? or supervisor_email = ?";
    $duplicate_query = $con->prepare($duplicate);
    try{
        $duplicate_query_result = $duplicate_query->execute([$supervisor_username,$supervisor_email]);

        if (str_contains($supervisor_username," ")){
            echo ("<script>
        alert('Spaces are not allowed in username, please try again!');
        window.location.href='../supervisor/supervisor_register.html';
        </script>");
        }else{
            //if password does not match confirm password, return error
            if ($supervisor_password != $supervisor_confirmpassword){
                echo ("<script>
                alert('Password does not match, please try again!');
                window.location.href='../supervisor/supervisor_register.html';
                </script>");
            }else {
                $sql = "INSERT INTO supervisor (supervisor_username,supervisor_password,supervisor_age,supervisor_email,supervisor_fullname)values(?,?,?,?,?)";
                $register_query = $con->prepare($sql);
                try {
                    $register_query_result = $register_query->execute([$supervisor_username, $supervisor_password, $supervisor_age, $supervisor_email, $supervisor_fullname]);
                    if ($register_query_result) {
                        echo("<script>
                alert('Registration Successful!');
                window.location.href='../supervisor/supervisor_login.html.html';
                </script>");
                    }
                } catch (Exception $e) {
                    echo("<script>
            alert('Something went wrong, please try again!');
            window.location.href='../supervisor/supervisor_register.html';
            </script>");
                }
            }
        }

    }catch(Exception $e){
        if ($supervisor_age > 100 ){
            echo ("<script>
                alert('Invalid age, please try again!');
                window.location.href='../supervisor/supervisor_register.html';
                </script>");
                die;
        }
        echo ("<script>
                alert('Email or Username taken, please try again!');
                window.location.href='../supervisor/supervisor_register.html';
                </script>");
    }



?>