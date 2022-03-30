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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Proposal Management</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/sidebar_header.css">
    <link rel="stylesheet" href="css/supervisor_project_proposal_management.css">
    <!-- Javascipts -->
    <script type="text/javascript" src="js/sidebar.js" defer></script>
    <script type="text/javascript" src="js/projectProposal.js" defer></script>
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
                <h1>Welcome to Project Proposal Management</h1>
                <div class="proposed-project-list">
                    <span><h2 style="display:inline">Proposed project by you</h2><button class="propose-project-btn">Propose Project</button></span>
                    <div class="project-box">
                        <div><strong>Project Name:</strong> </div>
                        <div><strong>Project Description:</strong> </div>
                        <div><strong>Proposed by:</strong> </div>
                        <div><strong>Approved:</strong></div>
                    </div>        
                </div>
                <div class="project-propose-box">
                    <span class="close-btn">&times;</span>
                    <h2>Propose a project</h2>
                    <form>
                        <div class="project-name-box">
                            <h2>Project Name:</h2><input type="text" placeholder="Project Name">
                        </div>
                        <div class="project-description-box">
                            <h2>Project Description:</h2><textarea title="Project Description" placeholder="Project Description"></textarea>
                        </div>
                        <div class="propose-btn-box">
                            <button class="submit-btn" type="submit">Propose Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>