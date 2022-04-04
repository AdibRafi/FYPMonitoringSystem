<?php
session_start();
require('../../../src/database.php');

$newName = $_POST['name'];
$newAge = $_POST['age'];
$newEmail = $_POST['email'];
$oldStudentID = $_SESSION['passedStudentParameter'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM Student WHERE STUDENT_ID = '" . $oldStudentID . "'";
    $getSql = $con->query($sql);
    $getStudent = $getSql->fetch_assoc();

    $updateSql = "UPDATE Student SET NAME = '" . $newName . "', AGE = '" . $newAge . "',
    EMAIL = '" . $newEmail . "', ISVERIFIED = b'1' WHERE Student.STUDENT_ID = '" . $oldStudentID . "'";


    if ($con->query($updateSql) === TRUE) {
        echo "<script>
          alert('Edit successful');
          </script>";
        echo "<script>window.location.href='list_student.php';</script>";
    }
}
