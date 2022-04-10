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
    <title>Project Planning</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/sidebar_header.css">
    <link rel="stylesheet" href="css/supervisor_projectPlanning.css">
    <!-- Javascript -->
    <script type="text/javascript" src="js/sidebar.js" defer></script>
    <script type="text/javascript" src="js/approveProject.js" defer></script>
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
                        <a><img class="sidebar-item selected" src="../src/icon/approve_student_project.png" alt="project planning icon" title="Project Planning"></a>
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
            <div class="project-planning-box">
                <h1 style="text-align: center;">Welcome to Project Planning</h1>
                <div class="student-proposed-project-list">
                    <h1>Student Proposed Project List</h1>
                    <?php

                    $sql = "SELECT * FROM Project where STUDENT_ID is not null and APPROVED_SUPERVISOR = 0 ";
                    $getProject_query = $con->prepare($sql);
                    $getProject_query->execute();
                    $getProject_query_result = $getProject_query->get_result();
                    $getProject_query->close();
                    $con->next_result();

                    if (mysqli_num_rows($getProject_query_result) > 0) {
                        while ($row = mysqli_fetch_assoc($getProject_query_result)) {
                            $studentData = getStudentDatabyStudentID($con, $row['STUDENT_ID']);
                            echo "<div class='planning-box' onclick='clickedProject(this)'>";
                            echo "<div class='planning-header' id='" . $row["PROJ_ID"] . "'>";
                            echo "<h2>" . $row["PROJ_ID"] . "<br>" . $row["NAME"] . "</h2>";
                            echo "</div>";
                            echo "<div class='planing-body'>";
                            echo "<h2>Description</h2>";
                            echo "<p>" . $row["DESCRIPTION"] . "</p>";
                            echo "<h2>Backup Description</h2>";
                            if ($row["BACKUP_DESCRIPTION"] == "") {
                                echo "<p>No Backup Description</p>";
                            } else {
                                echo "<p>" . $row["BACKUP_DESCRIPTION"] . "</p>";
                            }
                            echo "</div>";
                            echo "<div class='planning-footer'>";
                            echo "<p>" . $studentData["NAME"] . "</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div style='padding:10px;pointer-events: none;' class='planning-box'>";
                        echo "<h2>NO STUDENT PROPOSED PROJECT</h2>";
                        echo "</div>";
                    }
                    ?>
                </div>
                <div class="approve-project-box">
                    <h1 class="approve-project-box-title">Approve project</h1>
                    <div class="btn-box">
                        <button class="approve-btn"> Approve </button>
                        <button class="close-btn"> Close </button>
                    </div>
                </div>
            </div>

        </div>
</body>

</html>