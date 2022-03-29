<?php
session_start();
require('../../../src/database.php');

$supervisor = $_POST['selectRadio'];
$_SESSION["passedSupervisorParameter"] = $supervisor;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($supervisor)) {
        echo "<script>
        alert('Please Select Student');
        </script>";
        echo "<script>window.location.href='../list_supervisor.php.php';</script>";
    }
    else if (isset($_POST['editBtn'])) {
        echo "<script>
        alert('Edit Button Click');
        </script>";
        echo "<script>window.location.href='editSupervisor.php';</script>";
    }
    else if (isset($_POST['removeBtn'])) {
        $removeSql = "DELETE FROM Supervisor WHERE SUPERVISOR_ID = '".$supervisor."'";
        if ($con->query($removeSql) === TRUE) {
            echo "<script>
        alert('$supervisor has been removed from database');
        </script>";
            echo "<script>window.location.href='list_supervisor.php';</script>";
        } else {
            mysqli_connect_error();
            echo "<script>window.location.href='list_supervisor.php';</script>";
        }
    }
}
