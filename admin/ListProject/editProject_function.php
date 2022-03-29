<?php
session_start();
require('../../src/database.php');

$newName = $_POST['name'];
$newDescription = $_POST['description'];
$oldProjectID = $_SESSION['passedProjectParameter'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM Project WHERE PROJ_ID = '" . $oldProjectID . "'";
    $getSql = $con->query($sql);
    $getProject = $getSql->fetch_assoc();

    $deleteSql = "DELETE FROM Project WHERE PROJ_ID = '".$oldProjectID."'";

    $insertSQL = "INSERT INTO Project(PROJ_ID,NAME,DESCRIPTION,STUDENT_ID,SUPERVISOR_ID,IS_APPROVED)
    VALUES('".$getProject["PROJ_ID"]."','".$newName."','".$newDescription."','".$getProject["STUDENT_ID"]."',
    '".$getProject["SUPERVISOR_ID"]."',b'0')"; //todo: find solution how to deal with approved

    if ($con->query($deleteSql) === TRUE) {
        if ($con->query($insertSQL) === TRUE) {
            echo "<script>
          alert('Edit successful');
          </script>";
            echo "<script>window.location.href='list_project.php';</script>";
        }
    }
}
