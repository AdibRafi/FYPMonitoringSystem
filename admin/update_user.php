<?php
session_start();
require('../src/database.php');

$student = $_POST['student'];
$select = $_POST['submitResult'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['backBtn'])) {
        echo "<script>window.location.href='../supervisor/supervisor_login.php';</script>";
    }
}
if (empty($student)) {
    echo "<script>
        alert('Please Select a row');
        </script>";

}else if (empty($select)){
    echo "<script>
        alert('Please Select Verify or Remove');
        </script>";
}
else {
    $studentCount = count($student);
    $loop = 0;
    if ($select == "verify") {
        for ($i = 0; $i < $studentCount; $i++) {
            $verifySQL = "UPDATE Student SET ISVERIFIED=1 WHERE STUDENT_ID = '" . $student[$i] . "'";
            if ($con->query($verifySQL) === TRUE) {
                $loop++;
            }
        }
        if ($loop === $studentCount) {
            echo "<script>
        alert('Verify successful');
        </script>";
        }
    } else {
        for ($i = 0; $i < $studentCount; $i++) {
            $removeSQL = "DELETE FROM Student WHERE STUDENT_ID = '" . $student[$i] . "'";
            if ($con->query($removeSQL) === TRUE) {
                $loop++;
            }
        }
        if ($loop === $studentCount) {
            echo "<script>
        alert('Remove successful');
        </script>";
        }
    }

//    echo"<p>You selected $N students</p>";
//    for ($i = 0; $i < $N; $i++) {
//        echo($student[$i] . " ");
//    }

}
//todo: need to update location after done
echo "<script>window.location.href='verify_user.php';</script>";
