<?php

    session_start();

    require("database.php");
    require("functions.php");

    //Change credentials here if differ
    //User credentials
    $user_login = $_GET['username'];
    $user_password = $_GET['password'];
    $form_token = $_GET['token'];

    // I check, it gives me the error over here -adib
    //if all valid means form token is valid, proceed to login
    if (isset($_SESSION['token']) && isset($form_token) && $_SESSION['token'] === $form_token){
        //only allowing user to enter pattern [a-zA-Z0-9] regular expression
        if (!preg_match("/^[a-zA-z0-9]+$/",$user_login)) {
            echo("<script>
        alert('Invalid login information, please try again!');
        window.location.href='../supervisor/supervisor_login.php';
        </script>");
        }


        //Cross check with the database
        $advisor_check_query = $con ->prepare("SELECT * FROM advisor WHERE advisor_id = ?");
        $advisor_check_query->bind_param("s",$user_login);
        $advisor_check_query->execute();
        $result_query = $advisor_check_query->get_result();
        $advisor = $result_query->fetch_assoc();

        if ($advisor) {
            if ($advisor['ADVISOR_ID'] === $user_login && $advisor['PASSWORD'] === $user_password) {
                $_SESSION['advisor_id'] = $advisor['ADVISOR_ID'];

                echo ("<script>
                    alert('Login successfully');
                    window.location.href='../supervisor/supervisor_dashboard.php';
                    </script>");
            }
            else {
                echo ("<script>
                alert('Invalid login information, please try again!');
                window.location.href='../supervisor/supervisor_login.php';
                </script>");
            }

        }
        else {
            echo "ERROR: Login broke";
        }

        //if token is invalid, malicious site trying to access form, do nothing
    }else{
        echo ("<script>
            window.location.href='../supervisor/supervisor_login.php';
            </script>");
    }

