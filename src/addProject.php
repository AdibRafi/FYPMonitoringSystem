<?php

    require ("database.php");
    require ("functions.php");

    //Get data required to insert into the table
    $project_name = $_GET['plan_name'];
    $project_description = $_GET['plan_desc'];
    $supervisor_id = $_GET['supervisor_id'];
    $project_backup = $_GET['plan_backup'];
    $student_name = $_GET['student_id'];

    //Append 1 to ID
    $project_id = getID($con,"project");
    if($project_id === "invalid"){
        echo("<script>
        alert('invalid ID, please try again');
        window.location.href='../student/student_projectPlanning.php';
        </script>");
    }

     //Insert data into database accordingly
     $addProject_query = $con->prepare("INSERT INTO Project (PROJECT_ID, NAME, DESCRIPTION, STUDENT_ID, SUPERVISOR_ID, BACKUP_DESCRIPTION, IS_VERIFIED) values(?,?,?,?,?,?)");
     $addProject_query_result = $addProject_query->execute([$project_id, $project_name, $project_description, $student_id, $supervisor_id,$project_backup, "0"]);
 
     $addProject_query-> close();
     $con->next_result();
 
     if($addProject_query_result){
 
         echo("<script>
         alert('Project successfully added! Please wait for verification');
         window.location.href='../student/student_projectPlanning.php';
         </script>");
 
 
     }else{
         echo("<script>
         alert('Something went wrong!');
         window.location.href='../student/student_projectPlanning.php';
         </script>");
     }
 

?>