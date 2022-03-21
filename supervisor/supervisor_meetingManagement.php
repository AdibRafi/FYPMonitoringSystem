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
    <title>Meeting Management</title>
    <link rel="stylesheet" href="css/supervisor_dashboard.css">
    <link rel="stylesheet" href="css/supervisor_meetingManagement.css">
</head>

<body>
    <header class="header">
        <img class="menu-icon" src="../src/icon/menu_128px.png" alt="menu icon" title="Menu">
        <div class="welcome-msg">
            Welcome, <?php echo $user_data['NAME']?>
        </div>
    </header>
    <div class="container">
        <div class="sidebar">
            <div class="middle-sidebar">
                <ul class="sidebar-item-list">
                    <li>
                        <a href="supervisor_dashboard.php"><img class="sidebar-item" src="../src/icon/goal_progress_128px.png" alt="goal setting & progress setting icon" title="Goal Setting & Progress Setting"></a>
                    </li>
                    <li>
                        <a href="supervisor_project_proposal_management.php"><img class="sidebar-item" src="../src/icon/project_proposal_management_128px.png" alt="project proposal management icon" title="Project Proposal Management"></a>
                    </li>
                    <li>
                        <a href="supervisor_projectPlanning.php"><img class="sidebar-item" src="../src/icon/project_planning_128px.png" alt="project planning icon" title="Project Planning"></a>
                    </li>
                    <li>
                        <a href="supervisor_student-to-project_assignment.php"><img class="sidebar-item" src="../src/icon/student-to-project_assignment_128px.png" alt="student-to-project assignment icon" title="Student-To-Project Assignment"></a>
                    </li>
                    <li>
                        <a><img class="sidebar-item selected" src="../src/icon/meeting_management_128px.png" alt="meeting management icon" title="Meeting Management"></a>
                    </li>
                </ul>
            </div>
            <div class="bottom-sidebar">
                <ul class="sidebar-item-list">
                    <li>
                        <img class="sidebar-item" src="../src/icon/edit_profile_128px.png" alt="edit profile icon" title="Edit Profile">
                    </li>
                    <li>
                        <a href="supervisor_login.php"><img class="sidebar-item" src="../src/icon/logout_128px.png" alt="logout icon" title="Logout"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="add-meet-box">
                <h1>Meeting Management</h1><br>
                <h2>Time</h2><br>
                From <input type="time"> to <input type="time"><br>
                <h2>People</h2><br>
                <table class="people-box">
                    <tr>
                        <th class="student">
                            Student
                        </th>
                        <th class="supervisor">
                            Supervisor
                        </th>
                    </tr>
                    <tr>
                        <td class="student">
                            <select title="Student name" id="student-name">
                                <option value="ok">ok</option>
                                <option value="notok">notok</option>
                            </select>
                        </td>
                        <td class="supervisor">
                            <select title="Supervisor name" id="supervisor-name">
                                <option value="ok">ok</option>
                                <option value="notok">notok</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>