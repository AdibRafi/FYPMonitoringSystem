<?php
session_start();
require('../../../src/database.php');

$newName = $_POST['name'];
$newAge = $_POST['age'];
$newEmail = $_POST['email'];
$newProfession = $_POST['profession'];
$oldSupervisorID = $_SESSION['passedSupervisorParameter'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM Supervisor WHERE SUPERVISOR_ID = '" . $oldSupervisorID . "'";
    $getSql = $con->query($sql);
    $getSupervisor = $getSql->fetch_assoc();

    $updateSql = "UPDATE Supervisor SET NAME = '" . $newName . "',AGE= '" . $newAge . "' ,
    EMAIL = '" . $newEmail . "' , PROFESSION = '" . $newProfession . "', ISVERIFIED = b'1'
    WHERE Supervisor.SUPERVISOR_ID = '" . $oldSupervisorID . "'";

    if ($con->query($updateSql) === TRUE) {
        echo "<script>
          alert('Edit successful');
          </script>";
        echo "<script>window.location.href='list_supervisor.php';</script>";
    }
}
