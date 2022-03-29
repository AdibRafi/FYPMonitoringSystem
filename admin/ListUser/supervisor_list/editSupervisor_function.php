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

    $deleteSql = "DELETE FROM Supervisor WHERE SUPERVISOR_ID = '" . $oldSupervisorID . "'";

    $insertSql = "INSERT INTO Supervisor(SUPERVISOR_ID,NAME,PASSWORD,AGE,EMAIL,PROFESSION,MARK_ID,ISVERIFIED)
                  VALUES ('".$getSupervisor["SUPERVISOR_ID"]."','".$newName."','".$getSupervisor["PASSWORD"]."'
                  ,'".$newAge."','".$newEmail."','".$newProfession."','".$getSupervisor["MARK_ID"]."',b'1')";


    if ($con->query($deleteSql) === TRUE) {
        if ($con->query($insertSql) === TRUE) {
            echo "<script>
          alert('Edit successful');
          </script>";
            echo "<script>window.location.href='list_supervisor.php';</script>";
        }
    }
}
