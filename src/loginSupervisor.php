<?php

    session_start();

    include("database.php");
    include("functions.php");

    //Change credentials here if differ
    //User credentials
    $user_login = $_GET['username'];
    if (!preg_match("/^[a-zA-z0-9]+$/",$user_login)) {
        echo("<script>
        alert('Invalid login information, please try again!');
        window.location.href='../supervisor/supervisor_login.html';
        </script>");
    }
    $user_password = addslashes($_GET['password']);

    //Cross check with the database
    $advisor_check_query = $con ->prepare("SELECT * FROM supervisor WHERE supervisor_username = ?");
    $advisor_check_query->bind_param("s",$user_login);
    $advisor_check_query->execute();
    $result_query = $advisor_check_query->get_result();
    $advisor = $result_query->fetch_assoc();

    if ($advisor) {
        if ($advisor['supervisor_username'] === $user_login && $advisor['supervisor_password'] === $user_password) {
            $_SESSION['supervisor_id'] = $advisor['supervisor_id'];

            echo ("<script>
            alert('Login successfully');
            window.location.href='../supervisor/supervisor_dashboard.php';
            </script>");
        }
        else {
            echo ("<script>
            alert('Invalid login information, please try again!');
            window.location.href='../supervisor/supervisor_login.html';
            </script>");
        }

    }
    else {
        echo "ERROR: Login broke";
    }