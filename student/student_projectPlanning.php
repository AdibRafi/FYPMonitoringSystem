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
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/student_ProjectPlanning.css">
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
                        <a href="../student/student_dashboard.php"><img class="sidebar-item " src="../src/icon/studentDashboard.png" alt="student dashboard icon" title="Student Dashboard"></a>
                    </li>
                    <li>
                        <a href="../student/student_GoalSetting_ProgressTracking.php"><img class="sidebar-item" src="../src/icon/goal_progress_128px.png" alt="goal setting & progress setting icon" title="Goal Setting & Progress Setting"></a>
                    </li>
                    <li>
                        <a><img class="sidebar-item selected" src="../src/icon/project_planning_128px.png" alt="project planning icon" title="Project Planning"></a>
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
                <h1 class = "student">Welcome to Project Planning</h1>
                <p class = "ProjectName">Project Name</p>
                <p class = "ProjectDesc">Project Description</p>
            </div> 
            <div class = "planInfo">
                <form method= "get" action = "http://www.randyconnolly.com/tests/process.php">
                <div class = "plan">
                    <h2><label>Plan</label></h2>
                    <input type = "text" name = "Plan A" placeholder="Enter Your Plan" required>
                </div>

                <div class = "plan">
                    <h2><label>Backup Plan</label></h2>
                    <input type = "text" name = "Backup Plan" placeholder="Enter Your Backup Plan" required>
                </div>
                    
                <p class = "addPlan"><input type = "Submit" value = "Add Plan" ></p>
            </div>
        </div>
    </div>
</body>
</html>