<?php

session_start();

if (isset($_SESSION)){

    session_destroy();
}

echo ("<script>
        alert('Logout successfully');
        window.location.href='../loginPage.php';
        </script>");