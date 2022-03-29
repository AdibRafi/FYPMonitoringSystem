<?php
session_start();
require('../../../src/database.php');

$newSupervisorID = $_POST['supervisorId'];
$newName = $_POST['name'];
$newAge = $_POST['age'];
$newEmail = $_POST['email'];
$newProfession = $_POST['profession'];
$newMarkID = $_POST['markId'];
$oldSupervisorID = $_SESSION['passedSupervisorParameter'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM Student WHERE STUDENT_ID = '" . $oldSupervisorID . "'";
    $getSql = $con->query($sql);
    $getStudent = $getSql->fetch_assoc();

    echo "<script>
    alert('$oldSupervisorID $newSupervisorID $newName $newAge $newEmail $newMarkID $newProfession');
    </script>";

    $deleteSql = "DELETE FROM Supervisor WHERE SUPERVISOR_ID = '" . $oldSupervisorID . "'";

    $insertSql = "INSERT INTO Supervisor(SUPERVISOR_ID,NAME,PASSWORD,AGE,EMAIL,PROFESSION,MARK_ID,ISVERIFIED)
                  VALUES ('".$newSupervisorID."','".$newName."','".$getStudent["PASSWORD"]."'
                  ,'".$newAge."','".$newEmail."','".$newProfession."','".$newMarkID."',b'1')";


    if ($con->query($deleteSql) === TRUE) {
        if ($con->query($insertSql) === TRUE) {
            echo "<script>
          alert('Edit successful');
          </script>";
            echo "<script>window.location.href='list_supervisor.php';</script>";
        }
    }
}
