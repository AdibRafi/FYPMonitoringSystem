<?php

session_start();

if (isset($_SESSION['supervisor_id'])){
    unset($_SESSION['supervisor_id']);

    session_destroy();
}

echo ("<script>
        alert('Logout successfully');
        window.location.href='../loginPage.php';
        </script>");