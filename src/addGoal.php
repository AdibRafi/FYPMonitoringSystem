<?php

    require("database.php");
    
    //Get data required to insert into the table
    $student_user = $_GET['user_id'];
    $progress = $_GET['percentage'];
    $project = $_GET['project_id'];
    $name = $_GET['user_name'];

    //Check if student is in database

    //Check if project is in database

     //Get ID of latest data entry
     $get_check_query = "SELECT GOAL_ID FROM Goal";

     //Append 1 to ID
 
     //Insert data into database accordingly 

    //Insert into table

?>