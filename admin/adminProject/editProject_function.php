<?php
session_start();
require('../../src/database.php');

$newName = $_POST['name'];
$newDescription = $_POST['description'];
$newBackupDescription = $_POST['backup_description'];
$oldProjectID = $_SESSION['passedProjectParameter'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM Project WHERE PROJ_ID = '" . $oldProjectID . "';";
    $getSql = $con->query($sql);
    $getProject = $getSql->fetch_assoc();

    $updateSql = "UPDATE Project Set NAME = '" . $newName . "', DESCRIPTION = '" . $newDescription . "',
    BACKUP_DESCRIPTION = '" . $newBackupDescription . "' WHERE Project.PROJ_ID = '" . $oldProjectID . "'";


    if ($con->query($updateSql) === TRUE) {
        echo "<script>
          alert('Edit successful');
          </script>";
    } else {
        echo "<script> alert('Unable to edit')</script>";
    }
    echo "<script>window.location.href='list_project.php';</script>";
}
