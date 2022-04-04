<?php
    session_start();

    require("database.php");
    require("functions.php");

    $form_token = $_GET['token'];



    if (isset($_SESSION['token']) && isset($form_token) && $_SESSION['token'] === $form_token){

        //Change credentials here if differ
        //User credentials
        $user_login = $_GET['username'];
        $user_password = $_GET['password'];
        $login_data = "username=".$user_login;

        //check if user logging in is a supervisor
        $supervisor = getSupervisorDatabySupervisorID($con,$user_login);
        if ($supervisor) {
            if ($supervisor['ISVERIFIED'] === 1){
                if ($supervisor['PASSWORD'] === $user_password) {
                    $_SESSION['SUPERVISOR_ID'] = $supervisor['SUPERVISOR_ID'];
    
                    echo ("<script>
                        alert('Login successfully');
                        window.location.href='../supervisor/dashboard.php';
                        </script>");
                }
                else {
                    echo ("<script>
                        alert('Invalid login information, please try again!');
                        window.location.href='../loginPage.php?$login_data';
                        </script>");
                }
            }else{
                echo ("<script>
                    alert('Account is not verified by the admin, please try again later!');
                    window.location.href='../loginPage.php?$login_data';
                    </script>");
            }
            
        }

        //check if user logging is a student
        $student = getStudentDatabyStudentID($con,$user_login);
        if ($student) {
            if ($supervisor['ISVERIFIED'] === 1){
                if ($student['PASSWORD'] === $user_password) {
                    $_SESSION['STUDENT_ID'] = $student['STUDENT_ID'];

                    echo ("<script>
                        alert('Login successfully');
                        window.location.href='../student/student_dashboard.php';
                        </script>");

                }else{
                    echo ("<script>
                        alert('Invalid login information, please try again!');
                        window.location.href='../loginPage.php?$login_data';
                        </script>");
                }
            }else{
                echo ("<script>
                    alert('Account is not verified by the admin, please try again later!');
                    window.location.href='../loginPage.php?$login_data';
                    </script>");
            }
        }
        //if reach this point means user does not exist in database
        echo ("<script>
            alert('Login information does not exist, please try again!');
            window.location.href='../loginPage.php?$login_data';
            </script>");

        //if token is invalid, malicious site trying to access form, do nothing
    }else{
        echo ("<script>
            window.location.href='../loginPage.php';
            </script>");
    }
?>