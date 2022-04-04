<?php
    session_start();

    require ("../src/functions.php");
    require ("../src/database.php");

    $user_data = checkLogin($con);

    $queryGoal = $con->prepare("SELECT * FROM GOAL");
    $queryGoal->execute();
    $queryGoal_result = $queryGoal->get_result();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/student_dashboard.css">
    <link rel="stylesheet" href="../supervisor/css/sidebar_header.css">
    <script type="text/javascript" src="../supervisor/js/sidebar.js"></script>
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
                        <a><img class="sidebar-item selected" src="../src/icon/studentDashboard.png" alt="student dashboard icon" title="Student Dashboard"></a>
                    </li>
                    <li>
                        <a href="../student/student_GoalSetting_ProgressTracking.php"><img class="sidebar-item" src="../src/icon/goal_progress_128px.png" alt="goal setting & progress setting icon" title="Goal Setting & Progress Setting"></a>
                    </li>
                    <li>
                        <a href="../student/student_ProjectPlanning.php"><img class="sidebar-item" src="../src/icon/project_planning_128px.png" alt="project planning icon" title="Project Planning"></a>
                    </li>
                    <li>
                        <a href="../student/student_meeting_management.php"><img class="sidebar-item" src="../src/icon/meeting_management_128px.png" alt="project planning icon" title="Project Planning"></a>
                    </li>                    
                </ul>
            </div>
            <div class="bottom-sidebar">
                <ul class="sidebar-item-list">
                    <li>
                        <img class="sidebar-item" src="../src/icon/edit_profile_128px.png" alt="edit profile icon" title="Edit Profile">
                    </li>
                    <li>
                        <a href="../src/logout.php"><img class="sidebar-item" src="../src/icon/logout_128px.png" alt="logout icon" title="Logout"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class = "banner">
                <h1 class = "student">Welcome to Student Dashboard</h1>
                <div class = "projectBox">
                    <h2>Current Project Display Here</h2>
                </div> 
            </div> 
            <div class="skill-bars">
                <div class = "goal">
                    <span>Goal</span>
                </div>
                <?php
                    while ($goal_arr = mysqli_fetch_assoc($queryGoal_result)) {
                        echo '<div class="bar">';
                            echo '<div class="info">';
                            echo '<span>'.$goal_arr['NAME'].'</span>';
                            echo '</div>';
                            echo '<div class="progress-line '.$goal_arr['NAME'].'">';
                            echo '<span style="width:'.($goal_arr['PERCENTAGE']*100).'%;"></span>';
                            echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>