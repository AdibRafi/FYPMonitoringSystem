<?php
    session_start();

    require ("../src/functions.php");
    require ("../src/database.php");

    $user_data = checkLogin($con);

    $queryGoal = $con->prepare('SELECT * FROM Goal WHERE STUDENT_ID = "' . $user_data["STUDENT_ID"] . '"');
    $queryGoal->execute();
    $queryGoal_result = $queryGoal->get_result();

    $queryProj = $con->prepare('SELECT * FROM Project WHERE STUDENT_ID = "' . $user_data["STUDENT_ID"] . '"');
    $queryProj->execute();
    $queryProj_result = $queryProj->get_result();

    $queryProj_ID = "";
    $queryProj_Name = "";
    $queryProj_supervisorID = "";

    if ($queryProj_result && mysqli_num_rows($queryProj_result) > 0) {
        while ($proj_arr = mysqli_fetch_assoc($queryProj_result)) {
            if (isApproved($proj_arr['APPROVED_SUPERVISOR'], $proj_arr['APPROVED_ADMIN'])) {
                $queryProj_ID = $proj_arr['PROJ_ID'];
                $queryProj_Name = $proj_arr['NAME'];
                $queryProj_supervisorID = $proj_arr['SUPERVISOR_ID'];
            }
        }    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Submission</title>
    <link rel="stylesheet" href="../student/css/submitProject.css">
    <link rel="stylesheet" href="../supervisor/css/sidebar_header.css">
    <script type="text/javascript" src="../supervisor/js/sidebar.js" defer></script>
</head>
<body>
    <header class="header">
        <img class="menu-icon" src="../src/icon/menu_128px.png" alt="menu icon" title="Menu">
        <div class="welcome-msg">
            Welcome, <?php echo $user_data['NAME']?>.
        </div>
    </header>
    <div class="container">
        <div class="sidebar">
            <div class="middle-sidebar">
                <ul class="sidebar-item-list">
                    <li>
                        <a href="../student/student_dashboard.php"><img class="sidebar-item" src="../src/icon/studentDashboard.png" alt="student dashboard icon" title="Student Dashboard"></a>
                    </li>
                    <li>
                        <a href="../student/student_GoalSetting_ProgressTracking.php"><img class="sidebar-item" src="../src/icon/goal_progress_128px.png" alt="goal setting & progress setting icon" title="Goal Setting & Progress Setting"></a>
                    </li>
                    <li>
                        <a href="../student/student_projectPlanning.php"><img class="sidebar-item" src="../src/icon/project_planning_128px.png" alt="project planning icon" title="Project Planning"></a>
                    </li>
                    <li>
                        <a href="../student/student_meeting_management.php"><img class="sidebar-item" src="../src/icon/meeting_management_128px.png" alt="project planning icon" title="Meeting Management"></a>
                    </li>
                    <li>
                        <a href="../student/submitProject.php"><img class="sidebar-item selected" src="../src/icon/submit_project.png" alt="project submission icon" title="Project Submit"></a>
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
            <div class = "banner">
                <h1 class="title">Student Project Submission Panel</h1>
                <div class="submissionForm">
                    <form method="get" action="../src/submitProj.php">
                        <div class="project">
                            <?php
                            if ($queryProj_ID != "") {
                                echo '<h2><label>Project</label> = '.$queryProj_Name.'</h2>';
                            } else {
                                echo '<h2>No projects available to submit</h2>';
                            }
                            ?>   
                        </div>
                        <div class="name">
                        </div>
                        <?php
                            echo '<input type="hidden" name="mark_name" value="'.$queryProj_Name.'" required>';
                        ?>
                        <div class="path inputTextField">
                            <h2><label>Link to Project Folder</label></h2>
                            <input type="text" name="mark_link" placeholder="Enter Project Link" required>
                        </div>
                        <?php
                            echo '<input type="hidden" name="student_id" value="'.$_SESSION['STUDENT_ID'].'" required>';
                            echo '<input type="hidden" name="supervisor_id" value="'.$queryProj_supervisorID.'" required>';
                        ?>

                        <p class="submitProject"><input type="Submit" value="Submit Project"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>