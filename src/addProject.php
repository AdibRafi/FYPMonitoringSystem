<?php

require("database.php");
require("functions.php");

//Get data required to insert into the table
$project_name = $_GET['plan_name'];
$project_description = $_GET['plan_desc'];
$supervisor_id = $_GET['supervisor_id'];
$project_backup = $_GET['plan_backup'];
$student_id = $_GET['student_id'];

//Ensure length has not exceeded db limit
if (strlen($project_name) > 90) {
    echo ("<script>
        alert('Project name is too long!');
        window.location.href='../student/student_projectPlanning.php';
        </script>");
    die;
}

if (strlen($project_description) > 1000) {
    echo ("<script>
        alert('Project description is too long!');
        window.location.href='../student/student_projectPlanning.php';
        </script>");
    die;
}

if (strlen($project_backup) > 1000) {
    echo ("<script>
        alert('Project backup description is too long!');
        window.location.href='../student/student_projectPlanning.php';
        </script>");
    die;
}


//Append 1 to ID
$project_id = getID($con, "project");
if ($project_id === "invalid") {
    echo ("<script>
        alert('invalid ID, please try again');
        window.location.href='../student/student_projectPlanning.php';
        </script>");
    die;
}

//Insert data into database accordingly
echo '<script>console.log("'.$project_id.'")</script>';
$addProject_query = $con->prepare("INSERT INTO Project (PROJ_ID, NAME, DESCRIPTION, STUDENT_ID, SUPERVISOR_ID, BACKUP_DESCRIPTION, APPROVED_SUPERVISOR,APPROVED_ADMIN) values(?,?,?,?,?,?,?,?)");

$addProject_query_result = $addProject_query->execute([$project_id, $project_name, $project_description, $student_id, $supervisor_id, $project_backup, false, false]);

$addProject_query->close();
$con->next_result();

if ($addProject_query_result) {

    echo ("<script>
         alert('Project successfully added! Please wait for verification');
         window.location.href='../student/student_projectPlanning.php';
         </script>");
    die;
} else {
    echo ("<script>
         alert('Something went wrong!');
         window.location.href='../student/student_projectPlanning.php';
         </script>");
    die;
}
