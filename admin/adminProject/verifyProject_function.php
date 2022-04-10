<?php
session_start();
require('../../src/database.php');

$project = $_POST['project'];
$select = $_POST['submitResult'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($project)) {
        echo "<script>
        alert('Please Select a row');
        </script>";
        echo "<script>window.location.href='verify_project.php';</script>";
    } else if (empty($select)) {
        echo "<script>
        alert('Please Select Verify or Remove');
        </script>";
        echo "<script>window.location.href='verify_project.php';</script>";
    } else {
        if (count($project) != 0) {
            $loop = 0;
            if ($select == "verify") {
                for ($i = 0; $i < count($project); $i++) {
                    $verifySQL = "UPDATE Project SET APPROVED_ADMIN = 1 WHERE PROJ_ID = '" . $project[$i] . "'";
                    if ($con->query($verifySQL) === TRUE) {
                        $loop++;
                    }
                }
                if ($loop === count($project)) {
                    echo "<script>
                    alert('Verify successful');
                    </script>";
                }
            } else {
                for ($i = 0; $i < count($project); $i++) {
                    $removeSQL = "DELETE FROM Project WHERE PROJ_ID = '" . $project[$i] . "'";
                    if ($con->query($removeSQL) === TRUE) {
                        $loop++;
                    }
                }
                if ($loop === count($project)) {
                    echo "<script>
        alert('Remove successful');
        </script>";
                }
            }
            //todo: need to verifyUserFunction location after done
            echo "<script>window.location.href='verify_project.php';</script>";
        }
    }
}
