<?php

session_start();

require('database.php');
require('functions.php');

$projectID = $_GET['projectID'];
$supervisorID = $_SESSION['SUPERVISOR_ID'];


$sql = "UPDATE Project SET APPROVED_SUPERVISOR = 1,SUPERVISOR_ID = ? WHERE PROJ_ID = ?";
$approveProject_query = $con->prepare($sql);
$approveProject_query->execute([$supervisorID, $projectID]);
$approveProject_query_result = $approveProject_query->get_result();

if (mysqli_affected_rows($con) > 0) {
    $approveProject_query->close();
    $con->next_result();

    $studentID = getStudentIDByProjectID($con, $projectID);

    $sql = "UPDATE Student SET PROJ_ID = ? WHERE STUDENT_ID = ?";
    $updateStudent_query = $con->prepare($sql);
    $updateStudent_query->execute([$projectID, $studentID]);
    $updateStudent_query_result = $updateStudent_query->get_result();

    if (mysqli_affected_rows($con) > 0) {
        $updateStudent_query->close();
        $con->next_result();

        echo ("<script>
        alert('Project successfully approved!');
        window.location.href='../supervisor/project_proposal_management.php';
        </script>");
        die;
    } else {
        echo ("<script>
        alert('Something went wrong!');
        window.location.href='../supervisor/project_proposal_management.php';
        </script>");
        die;
    }
} else {
    echo ("
        <script>
            alert('Something went wrong!');
            window.location.href='../supervisor/project_proposal_management.php';
        </script>
    ");
}
