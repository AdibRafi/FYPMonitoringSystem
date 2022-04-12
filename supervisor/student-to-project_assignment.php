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
    <title>Student-To-Project Assignment</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/sidebar_header.css">
    <link rel="stylesheet" href="css/supervisor_student-to-project_assignment.css">
    <!-- Javascript -->
    <script type="text/javascript" src="js/sidebar.js" defer></script>
    <script type="text/javascript" src="js/assignProject.js" defer></script>
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
                        <a href="dashboard.php"><img class="sidebar-item" src="../src/icon/goal_progress_128px.png" alt="goal setting & progress setting icon" title="Goal Setting & Progress Setting"></a>
                    </li>
                    <li>
                        <a href="project_proposal_management.php"><img class="sidebar-item" src="../src/icon/project_proposal_management_128px.png" alt="project proposal management icon" title="Project Proposal Management"></a>
                    </li>
                    <li>
                        <a href="project_proposal_approval.php"><img class="sidebar-item" src="../src/icon/approve_student_project.png" alt="project planning icon" title="Project Planning"></a>
                    </li>
                    <li>
                        <a><img class="sidebar-item selected" src="../src/icon/student-to-project_assignment_128px.png" alt="student-to-project assignment icon" title="Student-To-Project Assignment"></a>
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
            <div class="student-to-project-assignment-box">
                <h1>Welcome to Student-to-Project Assignment</h1>
                <div class="approved-project-list-box">
                    <h1>Approved Project List</h1>
                    <?php
                    $sql = "SELECT * FROM Project WHERE APPROVED_ADMIN = 1 and SUPERVISOR_ID = ? and STUDENT_ID is NULL";
                    $getApprovedProject_query = $con->prepare($sql);
                    $getApprovedProject_query->execute([$user_data['SUPERVISOR_ID']]);
                    $getApprovedProject_query_result = $getApprovedProject_query->get_result();
                    if (mysqli_num_rows($getApprovedProject_query_result) > 0) {
                        while ($row = mysqli_fetch_assoc($getApprovedProject_query_result)) {
                            echo "<div class='approved-project-box' onclick='clickedProject(this)'>";
                            echo "<div class='approved-project-header'>";
                            echo $row['PROJ_ID'];
                            echo "<br>";
                            echo $row['NAME'];
                            echo "</div>";
                            echo "<div class='approved-project-body'>";
                            echo $row['DESCRIPTION'];
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div style='pointer-events: none;padding:10px' class='approved-project-box'> ";
                        echo "<h2>NO APPROVED PROJECT</h2>";
                        echo "</div>";
                    }
                    ?>
                </div>
                <div class="select-student-box">
                    <span class="close-btn">&times;</span>
                    <h1>Select Student</h1>
                    <div class="select-student">
                        <select required title='Student name' id='student-id' name='student_id'>
                            <?php
                            $sql = "SELECT STUDENT_ID,NAME FROM Student WHERE NOT EXISTS
                                    (SELECT STUDENT_ID FROM Project WHERE
                                    Project.STUDENT_ID=Student.STUDENT_ID) AND 
                                    ISVERIFIED = 1;";
                            $getStudent_query = $con->prepare($sql);
                            $getStudent_query->execute();
                            $getStudent_query_result = $getStudent_query->get_result();
                            if (mysqli_num_rows($getStudent_query_result) > 0) {
                                while ($row = mysqli_fetch_assoc($getStudent_query_result)) {
                                    echo '<option value=' . $row['STUDENT_ID'] . '>' . $row['NAME'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <input type="hidden" value="<?= $_SESSION['token'] ?>" id="token">
                        <button class="assign-btn">Assign project to student</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>