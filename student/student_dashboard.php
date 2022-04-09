<?php
    session_start();

    require ("../src/functions.php");
    require ("../src/database.php");

    $user_data = checkLogin($con);

    $queryGoal = $con->prepare("SELECT * FROM Goal");
    $queryGoal->execute();
    $queryGoal_result = $queryGoal->get_result();

    $queryProj = $con->prepare("SELECT * FROM Project");
    $queryProj->execute();
    $queryProj_result = $queryProj->get_result();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/student_dashboard.css">
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
                        <a><img class="sidebar-item selected" src="../src/icon/studentDashboard.png" alt="student dashboard icon" title="Student Dashboard"></a>
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
                <h1 class = "student">Welcome to Student Dashboard</h1>
                
                    <?php
                        //Insert project data here
                        if ($queryProj_result && mysqli_num_rows($queryGoal_result) > 0) {
                            while ($project_arr = mysqli_fetch_assoc($queryProj_result)) {
                                if ($project_arr['STUDENT_ID'] === $_SESSION['STUDENT_ID']) {  
                                    echo '<div class = "projectBox">';
                                    echo '<div> <b>Project ID:</b> '.$project_arr['PROJ_ID'].'</div>';
                                    echo '<div> <b>Project Name:</b> '.$project_arr['NAME'].'</div>';
                                    echo '</div>';
                                }
                            }
                        } else {
                            echo '<h2>There are no projects at the moment</h2>';
                        }
                        
                    ?>
                 
            </div> 
            <div class="skill-bars">
                <div class="goal">
                    <span>Goal</span>
                </div>
                <?php
                    if ($queryGoal_result && mysqli_num_rows($queryGoal_result) > 0) {
                        while ($goal_arr = mysqli_fetch_assoc($queryGoal_result)) {
                            $goal_percentage = $goal_arr['PERCENTAGE']*100;
                            $goal_percentage .= "%";
                            echo '<div class="bar">';
                            
                                echo '<div class="info">';
                                echo '<span>'.$goal_arr['NAME'].'</span>';
                                echo '</div>';
                                echo "<div class='progress-line GoalDescription'>";
                                echo '<span style="width:'.$goal_percentage.'" afterback="'.$goal_percentage.'"></span>';
                                echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<h2>There are no goals set at the moment</h2>';
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>