<?php
session_start();
require('../../src/database.php');

$project = $_POST['selectRadio'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($project)) {
        echo "<script>
        alert('Please Select Project');
        </script>";
        echo "<script>window.location.href='list_project.php';</script>";
    }
    else if (isset($_POST['editBtn'])) {
        echo "<script>
        alert('Edit Button Click');
        </script>";
        echo "<script>window.location.href='list_project.php';</script>";
    }
    else if (isset($_POST['removeBtn'])) {
        $removeSql = "DELETE FROM Project WHERE PROJ_ID = '".$project."'";
        if ($con->query($removeSql) === TRUE) {
            echo "<script>
        alert('$project has been removed from database');
        </script>";
            echo "<script>window.location.href='list_project.php';</script>";
        } else {
            mysqli_connect_error();
            echo "<script>window.location.href='list_project.php';</script>";
        }
    }
}
