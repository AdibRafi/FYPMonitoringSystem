<?php

require('database.php');

$meetID = $_GET['meetID'];

$sql = "DELETE FROM Meeting WHERE MEET_ID = ?";
$removeMeet_query = $con->prepare($sql);
$removeMeet_query->bind_param("s", $meetID);
$removeMeet_query->execute();
$removeMeet_query_result = $removeMeet_query->get_result();

if (mysqli_affected_rows($con)) {
    echo ("<script>
    alert('Meeting successfully removed!');
    window.location.href='../supervisor/meeting_management.php';
    </script>");
    die;
} else {
    echo ("<script>
    alert('Something went wrong!');
    window.location.href='../supervisor/meeting_management.php';
    </script>");
    die;
}
