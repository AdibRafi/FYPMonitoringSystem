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

    $deleteSql = "DELETE FROM Student WHERE STUDENT_ID = '" . $oldStudentID . "'";

    $insertSql = "INSERT INTO Student(STUDENT_ID,NAME,PASSWORD,AGE,EMAIL,MARK_ID,PROJ_ID,ISVERIFIED)
                  VALUES ('".$getStudent["STUDENT_ID"]."','".$newName."','".$getStudent["PASSWORD"]."'
                  ,'".$newAge."','".$newEmail."','".$getStudent["MARK_ID"]."','".$getStudent["PROJ_ID"]."',b'1')";


    if ($con->query($deleteSql) === TRUE) {
        if ($con->query($insertSql) === TRUE) {
            echo "<script>
          alert('Edit successful');
          </script>";
            echo "<script>window.location.href='list_student.php';</script>";
        }
    }
}
