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
    <link rel="stylesheet" href="css/student_GoalSetting_PlanningTracking.css">
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
                        <a href="../student/student_dashboard.php"><img class="sidebar-item" src="../src/icon/studentDashboard.png" alt="student dashboard icon" title="Student Dashboard"></a>
                    </li>
                    <li>
                        <a><img class="sidebar-item selected" src="../src/icon/goal_progress_128px.png" alt="goal setting & progress setting icon" title="Goal Setting & Progress Setting"></a>
                    </li>
                    <li>
                        <a href="../student/student_ProjectPlanning.php"><img class="sidebar-item" src="../src/icon/project_planning_128px.png" alt="project planning icon" title="Project Planning"></a>
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
                <form method= "get" action = "http://www.randyconnolly.com/tests/process.php">
                <h1 class = "student">Welcome to Goal Setting and Progress Tracking</h1>
                <div class = "goalName">
                    <h2><label>Goal Name</label></h2>
                    <input type = "text" name = "Goal Name" placeholder="Enter Goal Name" required>
                </div>

                <div class = "goalDescription">
                    <h2><label>Goal Description</label></h2>
                    <input type = "text" name = "Goal Description" placeholder="Enter Goal Description" required>
                </div>
                
                <p class = "addgoal"><input type = "Submit" value = "Add Goal" ></p>

            </div> 
            <div class = "currentGoal">
                <section>
                    <p class = fontsizeGoal>Current Goal 1 <a href="#"><img class="deleteIcon " src="../src/icon/delete_icon.png" alt="delete icon" title="Delete Goal"></a></p>
                    <p class = fontsizeGoal>Current Goal 2 <a href="#"><img class="deleteIcon " src="../src/icon/delete_icon.png" alt="delete icon" title="Delete Goal"></a></p>
                    <p class = fontsizeGoal>Current Goal 3 <a href="#"><img class="deleteIcon " src="../src/icon/delete_icon.png" alt="delete icon" title="Delete Goal"></a></p>
                </section>
            </div>
        </div>
    </div>
</body>
</html>