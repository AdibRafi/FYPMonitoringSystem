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
                <h2>Time</h2>
                <div class="time-box">
                    From <input name="start_time" type="time"> to <input name="end_time" type="time">
                </div>
                <h2>Date</h2>
                <div class="date-box">
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
                            <select title="Student name" id="student-name" name="user_id">
                                <?php
                                    require ("../src/database.php");

                                    $getStudentList_query = $con->prepare("SELECT * FROM student");
                                    $getStudentList_query->execute();
                                    $result = $getStudentList_query->get_result();

                                    while($row = $result->fetch_assoc()){
                                        echo '<option value='. $row['USER_ID'] .'>'.$row['NAME'].'</option>';
                                    }

                                ?>
                            </select>
                        </td>
                        <td class="supervisor">
                            <select title="Supervisor name" id="supervisor-name" name="advisor_id">
                                <?php

                                    require ("../src/database.php");

                                    $getAdvisorList_query = $con->prepare("SELECT * FROM advisor");
                                    $getAdvisorList_query->execute();
                                    $result = $getAdvisorList_query->get_result();

                                    while($row = $result->fetch_assoc()){
                                        echo '<option value='. $row['ADVISOR_ID'] .'>'.$row['NAME'].'</option>';
                                    }
                                    
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
                <input type="submit" value="Add Meeting">
            </div>
        </div>
    </div>
</body>
</html>