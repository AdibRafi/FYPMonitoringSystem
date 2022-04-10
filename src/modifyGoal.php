<?php
require("database.php");
require("functions.php");

$goal_id = $_GET['goal_id'];
$goal_percentage = $_GET['goal_percentage'];

//Handle percentage offset
if ($goal_percentage > 100 || $goal_percentage < 1) {
    echo ("<script>
        alert('Goal percentage invalid" . $goal_percentage . "');
        window.location.href='../student/student_GoalSetting_ProgressTracking.php';
        </script>");
    die();
}

$goal_percentage = $goal_percentage / 100;

<<<<<<< HEAD
//Prepare query
$modify_goal = $con->prepare('UPDATE Goal SET PERCENTAGE=' . $goal_percentage . ' WHERE GOAL_ID="' . $goal_id . '"');
$modify_goal_result = $modify_goal->execute();
=======
    //Prepare query
    $modify_goal = $con->prepare('UPDATE Goal SET PERCENTAGE='.$goal_percentage.' WHERE GOAL_ID="'.$goal_id.'"');
    $modify_goal_result = $modify_goal->execute();
>>>>>>> 5ba7d2f2a37ff04aa6f7f079acafc58b35440315

$modify_goal->close();
$con->next_result();

//Check result
if ($modify_goal_result) {

    echo ("<script>
        alert('Goal successfully modified!');
        window.location.href='../student/student_GoalSetting_ProgressTracking.php';
        </script>");
} else {
    echo ("<script>
        alert('Something went wrong! Please try again');
        window.location.href='../student/student_GoalSetting_ProgressTracking.php';
        </script>");
    die;
}
