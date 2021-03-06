<?php
session_start();

require("../src/functions.php");
require("../src/database.php");

$user_data = checkLogin($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supervisor Dashboard</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/supervisor_dashboard.css" />
    <link rel="stylesheet" href="css/sidebar_header.css" />
    <!-- Javascript -->
    <script type="text/javascript" src="js/sidebar.js" defer></script>
</head>

<body>
    <header class="header">
        <img class="menu-icon" src="../src/icon/menu_128px.png" alt="menu icon" title="Menu">
        <div class="welcome-msg">
            Welcome, <?php echo $user_data['NAME'] ?>.
        </div>
    </header>
    <div class="container">
        <div class="sidebar">
            <div class="middle-sidebar">
                <ul class="sidebar-item-list">
                    <li>
                        <a><img class="sidebar-item selected" src="../src/icon/goal_progress_128px.png" alt="goal setting & progress setting icon" title="Goal Setting & Progress Setting"></a>
                    </li>
                    <li>
                        <a href="project_proposal_management.php"><img class="sidebar-item" src="../src/icon/project_proposal_management_128px.png" alt="project proposal management icon" title="Project Proposal Management"></a>
                    </li>
                    <li>
                        <a href="project_proposal_approval.php"><img class="sidebar-item" src="../src/icon/approve_student_project.png" alt="project planning icon" title="Project Planning"></a>
                    </li>
                    <li>
                        <a href="student-to-project_assignment.php"><img class="sidebar-item" src="../src/icon/student-to-project_assignment_128px.png" alt="student-to-project assignment icon" title="Student-To-Project Assignment"></a>
                    </li>
                    <li>
                        <a href="meeting_management.php"><img class="sidebar-item" src="../src/icon/meeting_management_128px.png" alt="meeting management icon" title="Meeting Management"></a>
                    </li>
                    <li>
                        <a href="mark_sheets.php"><img class="sidebar-item" src="../src/icon/marking_128px.png" alt="marking icon" title="Mark Sheets"></a>
                    </li>
                </ul>
            </div>
            <div class="bottom-sidebar">
                <ul class="sidebar-item-list">
                    <li>
                        <a href="editProfile.php"><img class="sidebar-item" src="../src/icon/edit_profile_128px.png" alt="edit profile icon" title="Edit Profile"></a>
                    </li>
                    <li>
                        <a href="../src/logout.php"><img class="sidebar-item" src="../src/icon/logout_128px.png" alt="logout icon" title="Logout"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="goal-progress-box">
                <h1>Welcome to Supervisor Dashboard</h1>
                <h1>Goal Progression</h1>
                <?php
                $supervisorID = $_SESSION['SUPERVISOR_ID'];
                $index = 0;

                $query = "SELECT Student.STUDENT_ID,Project.PROJ_ID,Student.NAME as SName,Project.NAME as PName from Student join Project where Project.STUDENT_ID = Student.STUDENT_ID and Project.SUPERVISOR_ID = ? and Project.APPROVED_SUPERVISOR = 1 and Project.APPROVED_ADMIN = 1";
                $getStudentList_query = $con->prepare($query);
                $getStudentList_query->bind_param("s", $supervisorID);
                $getStudentList_query->execute();
                $getStudentList_query_result = $getStudentList_query->get_result();
                $getStudentList_query->close();
                $con->next_result();


                if ($getStudentList_query_result && mysqli_num_rows($getStudentList_query_result) > 0) {
                    while ($studentList = $getStudentList_query_result->fetch_assoc()) {

                        $query = "SELECT *,Goal.NAME as GNAME,Project.NAME as PNAME FROM Goal JOIN
                    Project on Goal.Proj_id = Project.Proj_id 
                    where SUPERVISOR_ID = ? and Goal.STUDENT_ID = ? order by Goal.STUDENT_ID;";
                        $getStudentGoals_query = $con->prepare($query);
                        $getStudentGoals_query->bind_param("ss", $supervisorID, $studentList['STUDENT_ID']);
                        $getStudentGoals_query->execute();
                        $getStudentGoals_query_result = $getStudentGoals_query->get_result();
                        $getStudentGoals_query->close();
                        $con->next_result();

                        // $studentData = getStudentDatabyStudentID($con,$studentList['STUDENT_ID']);

                        $markData = getMarkDatabyStudentID($con, $studentList['STUDENT_ID']);
                        $studentName = $studentList['SName'];
                        $projectName = $studentList['PName'];
                        $projectID = $studentList['PROJ_ID'];

                        echo (" 
                            <h2>
                                " . $studentName . "<br>
                                Project Name: " . $projectName . " (" . $projectID . ") <br>
                                File Path: " . (isset($markData['PATH']) ? $markData['PATH'] : "No submission") . "
                            </h2>
                        ");
                        if ($getStudentGoals_query_result && mysqli_num_rows($getStudentGoals_query_result) > 0) {
                            while ($goalList = $getStudentGoals_query_result->fetch_assoc()) {

                                $goalID = $goalList['GOAL_ID'];
                                $goalDescription = $goalList['GNAME'];

                                $goalPercentage = $goalList['PERCENTAGE'] * 100;
                                $goalPercentage .= "%";

                                echo ("
                                <div class = 'goal'>
                                    <div class='bar'>
                                        <div class='info'>
                                            <span>" . $goalID . " : " . $goalDescription . "</span>
                                        </div>
                                        <div class='progress-line GoalDescription' >
                                            <span style='width: " . $goalPercentage . "'></span>
                                            <script>
                                                try{
                                                    let box = document.getElementsByClassName('progress-line GoalDescription');
                                                    let span = box.item(" . $index . ").querySelector('span');     
                                                    span.setAttribute('afterBack','" . $goalPercentage . "');                      
                                                }catch(err){
                                                    span = box.item(" . $index . ").querySelector('span');  
                                                    span.setAttribute('afterBack','" . $goalPercentage . "');
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            ");
                                $index++;
                            }
                        } else {
                            echo ("
                                <div class = 'goal'>
                                    <h2>NO GOALS</h2>
                                </div>
                            ");
                        }
                    }
                } else {
                    echo ("
                        <div class = 'goal' style='box-shadow:none'>
                            <h2 style='text-align:center'>NO PROJECTS/GOALS</h2>
                        </div>
                    ");
                }

                ?>
            </div>
        </div>
    </div>
</body>

</html>