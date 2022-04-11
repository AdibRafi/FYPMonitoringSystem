<?php

session_start();

require('database.php');
require('functions.php');

$projectID = $_GET['projectID'];

$sql = "UPDATE Project SET APPROVED_SUPERVISOR = 1 WHERE PROJ_ID = ?";
$approveProject_query = $con->prepare($sql);
$approveProject_query->execute([$projectID]);
$approveProject_query_result = $approveProject_query->get_result();

if (mysqli_affected_rows($con) > 0) {
    $approveProject_query->close();
    $con->next_result();

    echo ("<script>
        alert('Project successfully approved!');
        window.location.href='../supervisor/project_proposal_management.php';
        </script>");
    die;
} else {
    echo ("
        <script>
            alert('Something went wrong!');
            window.location.href='../supervisor/project_proposal_management.php';
        </script>
    ");
}
