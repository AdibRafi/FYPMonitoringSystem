<?php
session_start();

require("../src/functions.php");
require("../src/database.php");

$user_data = checkLogin($con);

$queryProj = $con->prepare('SELECT * FROM Project WHERE STUDENT_ID = "' . $user_data["STUDENT_ID"] . '"');
$queryProj->execute();
$queryProj_result = $queryProj->get_result();

$queryGoal = $con->prepare('SELECT * FROM Goal WHERE STUDENT_ID = "' . $user_data["STUDENT_ID"] . '"');
$queryGoal->execute();
$queryGoal_result = $queryGoal->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/student_GoalSetting_PlanningTracking.css">
    <link rel="stylesheet" href="../supervisor/css/sidebar_header.css">
    <script type="text/javascript" src="../supervisor/js/sidebar.js" defer></script>
    <script type="text/javascript" src="js/goalManage.js" defer></script>
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
                    <a href="../student/student_dashboard.php"><img class="sidebar-item"
                                                                    src="../src/icon/studentDashboard.png"
                                                                    alt="student dashboard icon"
                                                                    title="Student Dashboard"></a>
                </li>
                <li>
                    <a><img class="sidebar-item selected" src="../src/icon/goal_progress_128px.png"
                            alt="goal setting & progress setting icon" title="Goal Setting & Progress Setting"></a>
                </li>
                <li>
                    <a href="../student/student_projectPlanning.php"><img class="sidebar-item"
                                                                          src="../src/icon/project_planning_128px.png"
                                                                          alt="project planning icon"
                                                                          title="Project Planning"></a>
                </li>
                <li>
                    <a href="../student/student_meeting_management.php"><img class="sidebar-item"
                                                                             src="../src/icon/meeting_management_128px.png"
                                                                             alt="project planning icon"
                                                                             title="Meeting Management"></a>
                </li>
                <li>
                    <a href="../student/submitProject.php"><img class="sidebar-item"
                                                                src="../src/icon/submit_project.png"
                                                                alt="project submission icon"
                                                                title="Project Submission"></a>
                </li>
            </ul>
        </div>
        <div class="bottom-sidebar">
            <ul class="sidebar-item-list">
                <li>
                    <a href="editProfile.php"><img class="sidebar-item" src="../src/icon/edit_profile_128px.png"
                                                   alt="edit profile icon"
                                                   title="Edit Profile">
                </li>
                <li>
                    <a href="../src/logout.php"><img class="sidebar-item" src="../src/icon/logout_128px.png"
                                                     alt="logout icon" title="Logout"></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="banner">
            <form method="get" action="../src/addGoal.php">
                <h1 class="student">Welcome to Goal Setting and Progress Tracking</h1>
                <div class="goalName inputTextField">
                    <h2><label>Goal Name</label></h2>
                    <input type="text" name="goal_name" placeholder="Enter Goal Name" required>
                </div>

                <div class="goalDescription inputTextField">
                    <h2><label>Goal Description</label></h2>
                    <input type="text" name="goal_description" placeholder="Enter Goal Description" required>
                </div>

                <div class="projectDropDown">
                    <h2><label>Select Project:</label>
                        <h2>
                            <select name="project_id">
                                <option value="PRNUL">Select Project</option>
                                <?php
                                //Foreach loop to send the id values and the option
                                while ($project_arr = mysqli_fetch_assoc($queryProj_result)) {
                                    if ($project_arr['STUDENT_ID'] === $_SESSION['STUDENT_ID']
                                        && $project_arr['APPROVED_SUPERVISOR'] === 1
                                        && $project_arr['APPROVED_ADMIN'] === 0) {
                                        echo '<option value="' . $project_arr['PROJ_ID'] . '">' . $project_arr['NAME'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                </div>

                <div class="percentage inputTextField">
                    <h2><label>Percentage:</label>
                        <h2>
                            <input type="text" name="goal_percentage" placeholder="Enter Percentage (Ex.: 30)">
                </div>

                <div class="student">
                    <?php
                    echo '<input type="hidden" name ="student_id" value="' . $_SESSION['STUDENT_ID'] . '">';
                    ?>
                </div>
                <p class="addgoal"><input type="Submit" value="Add Goal"></p>
            </form>
        </div>

        <div class="currentGoal">
            <section>
                <?php
                if ($queryGoal_result && mysqli_num_rows($queryGoal_result) > 0) {
                    while ($goal_arr = mysqli_fetch_assoc($queryGoal_result)) {
                        echo '<p class="fontsizeGoal">' . $goal_arr['NAME'] . '
                        <a href="#" onclick="openGoalRemove(\'' . (string)$goal_arr['GOAL_ID'] . '\')"><img class="deleteIcon" 
                        src="../src/icon/delete_icon.png" alt="delete icon" title="Delete Goal"></a>
                        <a href="#" onclick="openGoalEdit(\'' . $goal_arr['GOAL_ID'] . '\')"><img class="editIcon" 
                        width="20" height="20" src="../src/icon/edit.png" alt="edit icon" 
                        title="Edit Goal"></a></p>';
                    }
                } else {
                    echo '<h2>No goals are currently set</h2>';
                }
                ?>

            </section>
        </div>
        <div class="popupEdit" id="editContent">
        </div>
        <div class="popupRemove" id="removeContent">
        </div>
    </div>

</body>
<?php
/*
<div class="popupEdit">
<div class="popup-content">
    <form method="get" action="../src/modifyGoal.php">
        <h2><label>Change Percentage</label></h2>
        <a href="#" onclick="closeGoalEdit()"><img class="closeBtn" src="../src/icon/exitIcon.png"
                                                   style="width: 42px; height: 42px;" alt="exit"></a>
        <input type="text" class="popupInput" placeholder="New Percentage">
        <?php
        echo '<input type="hidden" name ="goal_id" value="">';
        ?>
        <p class="button"><input type="Submit" value="Save Changes"></p>
    </form>
</div>
</div>

<div class="popupRemove">
<div class="popup-content">
    <form method="get" action="../src/modifyGoal.php">
    <h2><label>Are you sure you want to remove this goal?</label></h2>
    <a href="#" onclick="closeGoalRemove()"><img class="closeBtn" src="../src/icon/exitIcon.png"
                                                 style="width: 42px; height: 42px;" alt="exit"></a>
    <a href="../src/removeGoal.php" class="button">Yes</a>
    <a href="#" onclick="closeGoalRemove()" class="button">No</a>
    </form>
</div>
</div>
*/
?>
</html>