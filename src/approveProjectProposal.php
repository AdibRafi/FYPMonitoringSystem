<?php

session_start();

require('database.php');

$projectID = $_GET['projectID'];
$supervisorID = $_SESSION['SUPERVISOR_ID'];

$sql = "UPDATE Project SET APPROVED_SUPERVISOR = 1,SUPERVISOR_ID = ? WHERE PROJ_ID = ?";
$approveProject_query = $con->prepare($sql);
$approveProject_query->bind_param("ss", $supervisorID, $projectID);
$approveProject_query->execute();
$approveProject_query_result = $approveProject_query->get_result();

if (mysqli_affected_rows($con) > 0) {
    echo ("
        <script>
            alert('Project approved successfully!');
            window.location.href='../supervisor/project_proposal_management.php';
        </script>
    ");
} else {
    echo ("
        <script>
            alert('something went wrong!');
            window.location.href='../supervisor/project_proposal_management.php';
        </script>
    ");
}
