<?php

    require("database.php");

    //Get data required to insert into the table
    $student_user = $_GET['user_id'];
    $advisor_user = $_GET['advisor_id'];
    $start = $_GET['date'].$_GET['start_time'];
    $end = $_GET['date'].$_GET['end_time']; 
    // $place = $_GET['location'];
    // $duration = $_GET['duration'];

    //Check if student is in database
    
    //Check if advisor is in database

    //Check table to ensure no conflict

    //Get ID of latest data entry
    $get_check_query = "SELECT MEETING_ID FROM Meeting";

    //Append 1 to ID

    //Insert data into database accordingly
    if (isset($_SESSION['token']) && isset($form_token) && $_SESSION['token'] === $form_token){

    }else{
        echo ("<script>
            window.location.href='../supervisor/supervisor_meetingManagement.php';
            </script>");
    }

    //Insert into table

?>