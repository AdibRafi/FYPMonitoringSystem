<?php

    session_start();

    require("database.php");
    require("functions.php");

    //Get data required to insert into the table
    
    $form_token = $_GET['token'];
    
    //echo "<script>console.log('".$start->format('Y-m-d H:i')."')</script>";

    if (isset($_SESSION['token']) && isset($form_token) && $_SESSION['token'] === $form_token){

        $student_user = $_GET['student_id'];
        $advisor_user = $_GET['advisor_id'];
        $start = new DateTime($_GET['date'].' '.$_GET['start_time']);
        $start_string = $start->format('Y-m-d H:i');
        $end = new DateTime($_GET['date']." ".$_GET['end_time']); 
        $end_string = $end->format('Y-m-d H:i');
        $place = $_GET['place'];
        $duration = abs($start->getTimestamp() - $end->getTimestamp()) / 60; //duration in minutes
        $meeting_name = $_GET['name'];

        if (empty($meeting_name)){
            $meeting_name = $student_user." and ". $advisor_user." meeting";
        }

        //Check if student is in database
        $student_check_query = $con ->prepare("SELECT * FROM student WHERE STUDENT_ID = ?");
        $student_check_query->bind_param("s",$student_user);
        $student_check_query->execute();
        $result_query = $student_check_query->get_result();
        $student = $result_query->fetch_assoc();

        $student_check_query->close();
        $con->next_result();
        
        if (!$student){
            echo ("<script>
            alert('Student is not in the database, please try again');
            window.location.href='../supervisor/supervisor_meetingManagement.php';
            </script>");
        }
        
        //Check if advisor is in database
        $advisor_check_query = $con ->prepare("SELECT * FROM advisor WHERE ADVISOR_ID = ?");
        $advisor_check_query->bind_param("s",$advisor_user);
        $advisor_check_query->execute();
        $result_query = $advisor_check_query->get_result();
        $advisor = $result_query->fetch_assoc();

        $advisor_check_query->close();
        $con->next_result();
        
        if (!$advisor){
            echo ("<script>
            alert('Advisor is not in the database, please try again');
            window.location.href='../supervisor/supervisor_meetingManagement.php';
            </script>");
        }

        //Check table to ensure no conflict

        //checking if advisor is occupied
        $dateTime_check_query = $con ->prepare("SELECT * FROM meeting WHERE ADVISOR_ID = ?");
        $dateTime_check_query->bind_param("s",$advisor_user);
        $dateTime_check_query->execute();
        $dateTime_query_result = $dateTime_check_query->get_result();

        $dateTime_check_query->close();
        $con->next_result();

        while($row = $dateTime_query_result->fetch_assoc()){
            $start_datetime = new DateTime($row['TIME']);
            $end_datetime = new DateTime($row['TIME']);
            $end_datetime->add(new DateInterval('PT' . $row['DURATION'] . 'M'));
            

            if($start_datetime === $start){
                echo ("<script>
                alert('Advisor is occupied at ".$start_string." , please try again');
                window.location.href='../supervisor/supervisor_meetingManagement.php';
                </script>");
            }else if($end_datetime === $start){
                echo ("<script>
                alert('Advisor is occupied at ".$start_string." , please try again');
                window.location.href='../supervisor/supervisor_meetingManagement.php';
                </script>");
            }else if($start>=$start_datetime && $start<=$end_datetime){
                echo ("<script>
                alert('Advisor is occupied at ".$start_string." , please try again');
                window.location.href='../supervisor/supervisor_meetingManagement.php';
                </script>");
            }
        }

       

        //checking if Student is occupied
        $dateTime_check_query = $con ->prepare("SELECT * FROM meeting WHERE STUDENT_ID = ?");
        $dateTime_check_query->bind_param("s",$student_users);
        $dateTime_check_query->execute();
        $dateTime_query_result = $dateTime_check_query->get_result();

        $dateTime_check_query->close();
        $con->next_result();
        
        while($row = $dateTime_query_result->fetch_assoc()){
            $start_datetime = new DateTime($row['TIME']);
            $end_datetime = new DateTime($start_datetime->add(new DateInterval('PT' . $row['DURATION'] . 'M')));

            if($start_datetime === $start){
                echo ("<script>
                alert('Student is occupied at".$start_string.", please try again');
                window.location.href='../supervisor/supervisor_meetingManagement.php';
                </script>");
            }else if($end_datetime === $start){
                echo ("<script>
                alert('Student is occupied at".$start_string.", please try again');
                window.location.href='../supervisor/supervisor_meetingManagement.php';
                </script>");
            }else if($start>=$start_datetime && $start<=$end_datetime){
                echo ("<script>
                alert('Student is occupied at".$start_string.", please try again');
                window.location.href='../supervisor/supervisor_meetingManagement.php';
                </script>");
            }
        }

        //Get ID of latest data entry
        $get_check_query = "SELECT MEETING_ID FROM Meeting";

        //Append 1 to ID
        $meeting_id = getID($con,"meeting");
        if($meeting_id === "invalid"){
            echo("<script>
            alert('invalid ID, please try again');
            window.location.href='../supervisor/supervisor_meetingManagement.php';
            </script>");
        }

        //Insert data into database accordingly
        $addMeet_query = $con->prepare("INSERT INTO meeting (MEET_ID,NAME,PLACE,TIME,DURATION,STUDENT_ID,ADVISOR_ID) values(?,?,?,?,?,?,?)");
        $addMeet_query_result = $addMeet_query->execute([$meeting_id,$meeting_name, $place, $start_string, $duration, $student_user,$advisor_user]);

        $addMeet_query->close();
        $con->next_result();

        if($addMeet_query_result){

            echo("<script>
            alert('Meeting successfully added!');
            window.location.href='../supervisor/supervisor_meetingManagement.php';
            </script>");


        }else{
            echo("<script>
            alert('Something went wrong!');
            window.location.href='../supervisor/supervisor_meetingManagement.php';
            </script>");
        }

    }else{

        echo ("<script>
            window.location.href='../supervisor/supervisor_meetingManagement.php';
            </script>");
    }

    //Insert into table

?>