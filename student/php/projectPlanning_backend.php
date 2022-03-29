<?php

require("database.php");

//Get the data from the process
$project_name = $_GET['project_name'];
$project_description = $_GET['project_description'];
$student_id = $_GET['student_id'];

//Generate an ID of the Project
$project_id = getID($con,"project");
    if($project_id === "invalid"){
        echo("<script>
        alert('invalid ID, please try again');
        window.location.href='../student/student_projectPlanning.php';
        </script>");
    }

//Push to database
?>