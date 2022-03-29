<?php

    require("database.php");
    require("functions.php");
    
    //Get data required to insert into the table
    $goal_name = $_GET['goal_name'];
    $goal_description = $_GET['goal_description'];
    $goal_percentage = $_GET['goal_percentage'];
    $project_name = $_GET['project_name'];
    $student_name = $_GET['student_id'];

    //Check if student is in database
    $student = checkUsername($student_name, "student");
    $student_check_query->close();
    $con->next_result();

    //Check if project is in database

     //Get ID of latest data entry
     $get_check_query = "SELECT GOAL_ID FROM Goal";

     //Append 1 to ID
    $goal_id = getID($con,"goal");
    if($goal_id === "invalid"){
        echo("<script>
        alert('invalid ID, please try again');
        window.location.href='../student/student_GoalSetting_ProgressTracking.php';
        </script>");
    }
 
     //Insert data into database accordingly 

    //Insert into table

?>