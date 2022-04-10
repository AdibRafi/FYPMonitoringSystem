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
    <title>Edit Profile</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/sidebar_header.css" />
    <link rel="stylesheet" href="css/editProfile.css" />
    <!-- Javascripts -->
    <script type="text/javascript" src="js/sidebar.js" defer></script>
    <script type="text/javascript" src="js/editProfile.js" defer></script>
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
                        <a href="project_planning.php"><img class="sidebar-item" src="../src/icon/approve_student_project.png" alt="project planning icon" title="Project Planning"></a>
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
                        <a><img class="sidebar-item selected" src="../src/icon/edit_profile_128px.png" alt="edit profile icon" title="Edit Profile"></a>
                    </li>
                    <li>
                        <a href="../src/logout.php"><img class="sidebar-item" src="../src/icon/logout_128px.png" alt="logout icon" title="Logout"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="edit-profile-box">
                <h1>Edit Profile</h1>
                <div class="email-row">
                    <span>Email:<?php echo (" " . $user_data['EMAIL']) ?></span>
                    <div class="button-box">
                        <button id="<?= $user_data['PASSWORD'] ?>" onclick=changeEmail(this) class="emailChange" role="button">Change Email</button>
                    </div>
                </div>
                <div class="password-row">
                    <span>Password:
                        <?php
                        $passwordLen = strlen($user_data['PASSWORD']);
                        echo (str_repeat("*", $passwordLen));
                        ?></span>
                    <div class="button-box">
                        <button id="<?= $user_data['PASSWORD'] ?>" onclick=changePassword(this) class="passwordChange" role="button">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>