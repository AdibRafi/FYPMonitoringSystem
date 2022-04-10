<?php

require("database.php");
require("functions.php");

//Get data required to insert into the table
$goal_name = $_GET['goal_name'];
$goal_description = $_GET['goal_description'];
$project_id = $_GET['project_id'];
$goal_percentage = $_GET['goal_percentage'];
$student_name = $_GET['student_id'];

//Handle percentage offset
if ($goal_percentage > 100 || $goal_percentage < 1) {
    echo ("<script>
        alert('Goal percentage invalid');
        window.location.href='../student/student_GoalSetting_ProgressTracking.php';
        </script>");
    die;
}


$goal_percentage = $goal_percentage / 100;

//Get ID of latest data entry
$get_check_query = "SELECT GOAL_ID FROM Goal";

//Append 1 to ID
$goal_id = getID($con, "goal");
if ($goal_id === "invalid") {
    echo ("<script>
        alert('invalid ID, please try again');
        window.location.href='../student/student_GoalSetting_ProgressTracking.php';
        </script>");
    die;
}

//Insert data into database accordingly
$addGoal_query = $con->prepare("INSERT INTO Goal (GOAL_ID, NAME, DESCRIPTION, PERCENTAGE, PROJ_ID, STUDENT_ID) values(?,?,?,?,?,?)");
$addGoal_query->execute([$goal_id, $goal_name, $goal_description, $goal_percentage, $project_id, $student_name]);
$addGoal_query_result = $addGoal_query->get_result();

$addGoal_query->close();
$con->next_result();

if (mysqli_affected_rows($con)) {
    echo ("<script>
        alert('Goal successfully added!');
        window.location.href='../student/student_GoalSetting_ProgressTracking.php';
        </script>");
    die;
} else {
    echo ("<script>
        alert('Something went wrong!');
        window.location.href='../student/student_GoalSetting_ProgressTracking.php';
        </script>");
    die;
}
