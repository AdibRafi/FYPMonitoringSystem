<?php
session_start();
require('../../../src/database.php');

$newStudentID = $_POST['studentId'];
$newName = $_POST['name'];
$newAge = $_POST['age'];
$newEmail = $_POST['email'];
$newMarkID = $_POST['markId'];
$newProjectID = $_POST['projectId'];
$oldStudentID = $_SESSION['passedStudentParameter'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM Student WHERE STUDENT_ID = '" . $oldStudentID . "'";
    $getSql = $con->query($sql);
    $getStudent = $getSql->fetch_assoc();

    echo "<script>
    alert('$oldStudentID $newStudentID $newName $newAge $newEmail $newMarkID $newProjectID');
    </script>";

    $deleteSql = "DELETE FROM Student WHERE STUDENT_ID = '" . $oldStudentID . "'";

    $insertSql = "INSERT INTO Student(STUDENT_ID,NAME,PASSWORD,AGE,EMAIL,MARK_ID,PROJ_ID,ISVERIFIED)
                  VALUES ('".$newStudentID."','".$newName."','".$getStudent["PASSWORD"]."'
                  ,'".$newAge."','".$newEmail."','".$newMarkID."','".$newProjectID."',b'1')";


    if ($con->query($deleteSql) === TRUE) {
        if ($con->query($insertSql) === TRUE) {
            echo "<script>
          alert('Edit successful');
          </script>";
            echo "<script>window.location.href='list_student.php';</script>";
        }
    }
}
