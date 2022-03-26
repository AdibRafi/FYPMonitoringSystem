<?php
session_start();

    require ("../src/functions.php");
    require ("../src/database.php");

    $user_data = checkLogin($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meeting Management</title>
    <link rel="stylesheet" href="css/supervisor_dashboard.css">
    <link rel="stylesheet" href="css/supervisor_meetingManagement.css">
    <script type="text/javascript" src="js/supervisor_sidebar.js"></script>
    <script type="text/javascript" src="js/supervisor_login.js"></script>
</head>

<body>
    <header class="header">
        <img class="menu-icon" src="../src/icon/menu_128px.png" alt="menu icon" title="Menu">
        <div class="welcome-msg">
            Welcome, <?php echo $user_data['NAME']?>
        </div>
    </header>
    <div class="container">
        <div class="sidebar">
            <div class="middle-sidebar">
                <ul class="sidebar-item-list">
                    <li>
                        <a href="supervisor_dashboard.php"><img class="sidebar-item" src="../src/icon/goal_progress_128px.png" alt="goal setting & progress setting icon" title="Goal Setting & Progress Setting"></a>
                    </li>
                    <li>
                        <a href="supervisor_project_proposal_management.php"><img class="sidebar-item" src="../src/icon/project_proposal_management_128px.png" alt="project proposal management icon" title="Project Proposal Management"></a>
                    </li>
                    <li>
                        <a href="supervisor_projectPlanning.php"><img class="sidebar-item" src="../src/icon/project_planning_128px.png" alt="project planning icon" title="Project Planning"></a>
                    </li>
                    <li>
                        <a href="supervisor_student-to-project_assignment.php"><img class="sidebar-item" src="../src/icon/student-to-project_assignment_128px.png" alt="student-to-project assignment icon" title="Student-To-Project Assignment"></a>
                    </li>
                    <li>
                        <a><img class="sidebar-item selected" src="../src/icon/meeting_management_128px.png" alt="meeting management icon" title="Meeting Management"></a>
                    </li>
                </ul>
            </div>
            <div class="bottom-sidebar">
                <ul class="sidebar-item-list">
                    <li>
                        <img class="sidebar-item" src="../src/icon/edit_profile_128px.png" alt="edit profile icon" title="Edit Profile">
                    </li>
                    <li>
                        <a href="supervisor_login.php"><img class="sidebar-item" src="../src/icon/logout_128px.png" alt="logout icon" title="Logout"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <form method="get" id="mainForm" action="../src/addMeeting.php"> 
            <div class="add-meet-box">
                <h1>Meeting Management</h1><br>
                <div class="name-box">
                    <h2>Meeting Name</h2>
                    <p><mark>**Default meeting name will be [Student Username] and [Advisor Username] meeting.</mark></p>
                    <input type="text" name="name" placeholder="Insert meeting name here">
                </div>
                <div class="place-box">
                    <h2>Meeting Place</h2>
                    <input type="text" name="place" placeholder="Insert meeting place here" class="required">
                </div>
                <div class="time-box">
                    <h2>Time</h2>
                    From <input name="start_time" type="time"> to <input name="end_time" type="time">
                </div>
                <div class="date-box">
                    <h2>Date</h2>
                    <input name="date" type="date">
                </div>
                <h2>People</h2>
                <table class="people-box">
                    <tr>
                        <th class="student">
                            Student
                        </th>
                        <th class="supervisor">
                            Supervisor
                        </th>
                    </tr>
                    <tr>
                        <td class="student">
                            <select title="Student name" id="student-name" name="student_id">
                                <?php
                                    require ("../src/database.php");

                                    $getStudentList_query = $con->prepare("SELECT * FROM student");
                                    $getStudentList_query->execute();
                                    $result = $getStudentList_query->get_result();

                                    while($row = $result->fetch_assoc()){
                                        echo '<option value='. $row['STUDENT_ID'] .'>'.$row['NAME'].'</option>';
                                    }

                                ?>
                            </select>
                        </td>
                        <td class="supervisor">
                            <select title="Supervisor name" id="supervisor-name" name="advisor_id">
                                <option value="<?=$user_data['ADVISOR_ID']?>"><?=$user_data['NAME']?></option>';                                    
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
                <input type="submit" value="Add Meeting">
            </div>
            </form>
            <div class="meeting-list-box">
                <h1>Meeting List</h1>
                <?php
                    require ("../src/database.php");

                    $getMeetingList_query = $con->prepare("SELECT * FROM meeting");
                    $getMeetingList_query->execute();
                    $getMeetingList_query_result = $getMeetingList_query->get_result();

                    $getMeetingList_query->close();
                    $con->next_result();

                    while($row = $getMeetingList_query_result->fetch_assoc()){
                        
                        $studentData = getStudentDatabyStudentID($con,$row['STUDENT_ID']);
                        $advisorData = getAdvisorDatabyAdvisorID($con,$row['ADVISOR_ID']);

                        echo '
                        <div class="meeting-box">
                            <div> <b>Meeting ID:</b> '.$row['MEET_ID'].'</div>'.
                            '<div> <b>Meeting Name:</b> '.$row['NAME'].'</div>'.
                            '<div> <b>Meeting Time:</b> '.$row['TIME'].'</div>'.
                            '<div> <b>Meeting Duration:</b> '.$row['DURATION'].' minutes'.'</div>'.
                            '<div> <b>Meeting Place:</b> '.$row['PLACE'].'</div>'.
                            '<div> <b>Meeting Participant:</b><br> <div style="margin-left: 40px"><b>Student:</b> '.$studentData['NAME']. '<br><b>Advisor:</b> '.$advisorData['NAME'].'</div></div>
                        </div>
                        ';
                    }

                ?>
            </div>
        </div>
    </div>
</body>
</html>