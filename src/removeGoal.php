<?php
require("database.php");
require("functions.php");

$goal_id = $_GET['goal_id'];
echo '<script>alert(' . $goal_id . ')</script>';
//Prepare query
$delete_goal = $con->prepare('DELETE FROM GOAL WHERE GOAL_ID="' . $goal_id . '"');
$delete_goal_result = $delete_goal->execute();

$delete_goal->close();
$con->next_result();

//Check result
if ($delete_goal_result) {
    echo ("<script>
        alert('Goal successfully deleted!');
        window.location.href='../student/student_GoalSetting_ProgressTracking.php';
        </script>");
    die;
} else {
    echo ("<script>
        alert('Something went wrong! Please try again');
        window.location.href='../student/student_GoalSetting_ProgressTracking.php';
        </script>");
    die;
}
