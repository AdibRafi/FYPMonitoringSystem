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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Proposal Management</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/sidebar_header.css">
    <link rel="stylesheet" href="css/supervisor_project_proposal_management.css">
    <!-- Javascipts -->
    <script type="text/javascript" src="js/sidebar.js" defer></script>
    <script type="text/javascript" src="js/loginPage.js" defer></script>
    <script type="text/javascript" src="js/projectProposal.js" defer></script>
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
                        <a><img class="sidebar-item selected" src="../src/icon/project_proposal_management_128px.png" alt="project proposal management icon" title="Project Proposal Management"></a>
                    </li>
                    <li>
                        <a href="project_planning.php"><img class="sidebar-item" src="../src/icon/project_planning_128px.png" alt="project planning icon" title="Project Planning"></a>
                    </li>
                    <li>
                        <a href="student-to-project_assignment.php"><img class="sidebar-item" src="../src/icon/student-to-project_assignment_128px.png" alt="student-to-project assignment icon" title="Student-To-Project Assignment"></a>
                    </li>
                    <li>
                        <a href="meeting_management.php"><img class="sidebar-item" src="../src/icon/meeting_management_128px.png" alt="meeting management icon" title="Meeting Management"></a>
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
            <div class="proposal-management-box">
                <h1 class="center">Welcome to Project Proposal Management</h1>
                <div class="proposed-project-list">
                    <h1>Proposed Project By You</h1>
                    <button class="propose-project-btn">Propose Project</button>
                    <?php

                    $sql = "select * from project where supervisor_id = ? and student_id is null";
                    $getProjectList_query = $con->prepare($sql);
                    $getProjectList_query->bind_param("s", $_SESSION['SUPERVISOR_ID']);
                    $getProjectList_query->execute();

                    $getProjectList_query_result = $getProjectList_query->get_result();

                    if (mysqli_num_rows($getProjectList_query_result) > 0) {
                        while ($row = $getProjectList_query_result->fetch_assoc()) {
                            $isApprovedbyAdmin = ($row['APPROVED_ADMIN'] == 0) ? "Not Approved" : "Approved";
                            $isApprovedbySupervisor = ($row['APPROVED_SUPERVISOR'] == 0) ? "Not Approved" : "Approved";
                            $statusCSS_isApprovedbyAdmin = ($row['APPROVED_ADMIN'] == 0) ? "redFont" : "greenFont";
                            $statusCSS_isApprovedbySupervisor = ($row['APPROVED_SUPERVISOR'] == 0) ? "redFont" : "greenFont";

                            echo "<div class='project-box'>";
                            echo "<div id=" . $row['PROJ_ID'] . " style='display: flex;align-items: center;'>Project ID: " . $row['PROJ_ID'] . "<span class='remove-project-btn' onclick='removeProjectBtn(this)'>&times;</span></div>";
                            echo "<div>Project Name: " . $row['NAME'] . "</div>";
                            echo "<div>Project Description: " . $row['DESCRIPTION'] . "</div>";
                            echo "<div>Proposed by: " . $user_data['NAME'] . "</div>";
                            echo "<div>Approved by Admin: " . "<span class='" . $statusCSS_isApprovedbyAdmin . "'>" . $isApprovedbyAdmin . "</span></div>";
                            echo "<div>Approved by Supervisor: " . "<span class='" . $statusCSS_isApprovedbySupervisor . "'>" . $isApprovedbySupervisor . "</span></div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div style='width:fit-content;'class='project-box'>";
                        echo "<h2 style='text-align:center;'>THERE IS NO PROPOSED PROJECT BY YOU</h2>";
                        echo "</div>";
                    }

                    ?>
                </div>
                <div class="popup-box">
                    <div class="project-propose-box">
                        <span class="close-btn">&times;</span>
                        <h2>Propose a project</h2>
                        <form method="get" action="../src/proposeProject.php" id="mainForm">
                            <div class="project-name-box">
                                <h2>Project Name:</h2><input name="projectName" type="text" placeholder="Project Name" class="required">
                            </div>
                            <div class="project-description-box">
                                <h2>Project Description:</h2><textarea name="projectDescription" title="Project Description" placeholder="Project Description" class="required"></textarea>
                            </div>
                            <div class="propose-btn-box">
                                <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token">
                                <input class="submit-btn" type="submit" value="Propose Project">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>