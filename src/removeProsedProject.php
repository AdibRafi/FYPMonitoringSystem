<?php

require('database.php');

$projectID = $_GET['projectID'];

$sql = "DELETE FROM Project WHERE PROJ_ID = ?";
$removeProposedProject_query = $con->prepare($sql);
$removeProposedProject_query->bind_param("s", $projectID);
$removeProposedProject_query->execute();
$removeProposedProject_query_result = $removeProposedProject_query->get_result();

if (mysqli_affected_rows($con)) {
    echo ("<script>
    alert('Proposed project successfully removed!');
    window.location.href='../supervisor/project_proposal_management.php';
    </script>");
} else {
    echo ("<script>
    alert('Something went wrong!');
    window.location.href='../supervisor/project_proposal_management.php';
    </script>");
}
