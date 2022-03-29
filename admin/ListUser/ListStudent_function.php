<?php
session_start();
require('../../src/database.php');

$student = $_POST['selectRadio'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($student)) {
        echo "<script>
        alert('Please Select Student');
        </script>";
        echo "<script>window.location.href='list_student.php';</script>";
    }
    else if (isset($_POST['editBtn'])) {
        echo "<script>
        alert('Edit Button Click');
        </script>";
        echo "<script>window.location.href='list_student.php';</script>";
    }
    else if (isset($_POST['removeBtn'])) {
        $removeSql = "DELETE FROM Student WHERE STUDENT_ID = '".$student."'";
        if ($con->query($removeSql) === TRUE) {
            echo "<script>
        alert('$student has been removed from database');
        </script>";
            echo "<script>window.location.href='list_student.php';</script>";
        } else {
            mysqli_connect_error();
            echo "<script>window.location.href='list_student.php';</script>";
        }
    }
}
