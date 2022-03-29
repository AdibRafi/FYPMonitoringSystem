<?php
session_start();
require('../../src/database.php');

$newProjectID = $_POST['projectId'];
$newName = $_POST['name'];
$newDescription = $_POST['description'];
$newStudentID = $_POST['studentId'];
$newSupervisorID = $_POST['supervisorId'];
$oldProjectID = $_SESSION['passedProjectParameter'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $deleteSql = "DELETE FROM Project WHERE PROJ_ID = '" . $oldProjectID . "'";

    $insertSQL = "INSERT INTO Project (PROJ_ID, NAME, DESCRIPTION, STUDENT_ID,
                     SUPERVISOR_ID, IS_APPROVED) 
                     VALUES ('" . $newProjectID . "', '" . $newName . "', 
                     '" . $newDescription . "', '" . $newStudentID . "',
                      '" . $newSupervisorID . "', b'0');"; //todo: find solution how to deal with approved

    if ($con->query($deleteSql) === TRUE) {
        if ($con->query($insertSQL) === TRUE) {
            echo "<script>
          alert('Edit successful');
          </script>";
            echo "<script>window.location.href='list_project.php';</script>";
        }
    }
}
