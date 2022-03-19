<?php

session_start();

if (isset($_SESSION['supervisor_id'])){
    unset($_SESSION['supervisor_id']);
}

echo ("<script>
        alert('Logout successfully');
        window.location.href='../supervisor/supervisor_login.html';
        </script>");