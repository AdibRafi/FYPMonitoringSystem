<?php
    session_start();

    require("database.php");
    require("functions.php");

    //Change credentials here if differ
    //User credentials
    $user_login = $_GET['username'];
    $user_password = $_GET['password'];
    $form_token = $_GET['token'];

    $login_data = "username=".$user_login;

    if (isset($_SESSION['token']) && isset($form_token) && $_SESSION['token'] === $form_token){

        //check if user logging in is a supervisor
        $supervisor = getAdvisorDatabyAdvisorID($con,$user_login);
        if ($supervisor) {
            if ($supervisor['PASSWORD'] === $user_password) {
                $_SESSION['advisor_id'] = $supervisor['ADVISOR_ID'];

                echo ("<script>
                    alert('Login successfully');
                    window.location.href='../supervisor/supervisor_dashboard.php';
                    </script>");
            }
            else {
                echo ("<script>
                    alert('Invalid login information, please try again!');
                    window.location.href='../supervisor/supervisor_login.php?$login_data';
                    </script>");
            }
        }

        //check if user logging is a student
        $student = getStudentDatabyStudentID($con,$user_login);
        if ($student) {
            if ($student['PASSWORD'] === $user_password) {
                $_SESSION['student_id'] = $student['student_id'];

                echo ("<script>
                    alert('Login successfully');
                    window.location.href='../student/dashboard.html';
                    </script>");

            }else{
                echo ("<script>
                    alert('Invalid login information, please try again!');
                    window.location.href='../supervisor/supervisor_login.php?$login_data';
                    </script>");
            }
        }
        //if reach this point means user does not exist in database
        echo ("<script>
            alert('Login information does not exist, please try again!');
            window.location.href='../supervisor/supervisor_login.php?$login_data';
            </script>");

        //if token is invalid, malicious site trying to access form, do nothing
    }else{
        echo ("<script>
            window.location.href='../supervisor/supervisor_login.php';
            </script>");
    }
?>