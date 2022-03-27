<?php
session_start();
require('../../../src/database.php');

$student = $_POST['student'];
$select = $_POST['submitResult'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['backBtn'])) {
        echo "<script>window.location.href='../../../loginPage.php';</script>";
    } else if (isset($_POST['studentTable'])) {
        echo "<script>window.location.href='../verify_student.php';</script>";
    } else if (isset($_POST['supervisorTable'])) {
        echo "<script>window.location.href='../verify_supervisor.php';</script>";
    } else if (empty($student) && empty($supervisor)) {
        echo "<script>
        alert('Please Select a row');
        </script>";
        echo "<script>window.location.href='../verify_student.php';</script>";
    } else if (empty($select)) {
        echo "<script>
        alert('Please Select Verify or Remove');
        </script>";
        echo "<script>window.location.href='../verify_student.php';</script>";
    } else {
        if (count($student) != 0) {
            $loop = 0;
            if ($select == "verify") {
                for ($i = 0; $i < count($student); $i++) {
                    $verifySQL = "UPDATE Student SET ISVERIFIED=1 WHERE STUDENT_ID = '" . $student[$i] . "'";
                    if ($con->query($verifySQL) === TRUE) {
                        $loop++;
                    }
                }
                if ($loop === count($student)) {
                    echo "<script>
                    alert('Verify successful');
                    </script>";
                }
            } else {
                for ($i = 0; $i < count($student); $i++) {
                    $removeSQL = "DELETE FROM Student WHERE STUDENT_ID = '" . $student[$i] . "'";
                    if ($con->query($removeSQL) === TRUE) {
                        $loop++;
                    }
                }
                if ($loop === count($student)) {
                    echo "<script>
        alert('Remove successful');
        </script>";
                }
            }
            //todo: need to update location after done
            echo "<script>window.location.href='../verify_student.php';</script>";
        }
    }
}