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
    <title>Meeting Management</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../supervisor/css/sidebar_header.css">
    <link rel="stylesheet" href="css/student_meetingManagement.css">
    <!-- Javascript -->
    <script type="text/javascript" src="../supervisor/js/sidebar.js" defer></script>
    <script type="text/javascript" src="../supervisor/js/loginPage.js" defer></script>
    <script type="text/javascript" src="../supervisor/js/meetingManagement.js" defer></script>
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
                        <a href="../student/student_dashboard.php"><img class="sidebar-item" src="../src/icon/studentDashboard.png" alt="student dashboard icon" title="Student Dashboard"></a>
                    </li>
                    <li>
                        <a href="../student/student_GoalSetting_ProgressTracking.php"><img class="sidebar-item" src="../src/icon/goal_progress_128px.png" alt="goal setting & progress setting icon" title="Goal Setting & Progress Setting"></a>
                    </li>
                    <li>
                        <a href="../student/student_projectPlanning.php"><img class="sidebar-item" src="../src/icon/project_planning_128px.png" alt="project planning icon" title="Project Planning"></a>
                    </li>
                    <li>
                        <a><img class="sidebar-item selected" src="../src/icon/meeting_management_128px.png" alt="meeting management icon" title="Meeting Management"></a>
                    </li>
                    <li>
                        <a href="../student/submitProject.php"><img class="sidebar-item" src="../src/icon/submit_project.png" alt="project submission icon" title="Project Submission"></a>
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
            <div class="meeting-management-box">
                <h1 class="center">Welcome to Meeting Management</h1>
                <div class="meeting-list-box">
                    <?php
                    $getMeetingList_query = $con->prepare("SELECT * FROM Meeting where STUDENT_ID = ?");
                    $getMeetingList_query->bind_param("s", $_SESSION['STUDENT_ID']);
                    $getMeetingList_query->execute();
                    $getMeetingList_query_result = $getMeetingList_query->get_result();

                    $getMeetingList_query->close();
                    $con->next_result();

                    if ($getMeetingList_query_result && mysqli_num_rows($getMeetingList_query_result) > 0) {
                        while ($row = $getMeetingList_query_result->fetch_assoc()) {

                            $studentData = getStudentDatabyStudentID($con, $row['STUDENT_ID']);
                            $supervisorData = getSupervisorDatabySupervisorID($con, $row['SUPERVISOR_ID']);

                            echo '
                                <div class="meeting-box">
                                    <div> <b>Meeting ID:</b> ' . $row['MEET_ID'] . '</div>' .
                                '<div> <b>Meeting Name:</b> ' . $row['NAME'] . '</div>' .
                                '<div> <b>Meeting Time:</b> ' . $row['TIME'] . '</div>' .
                                '<div> <b>Meeting Duration:</b> ' . $row['DURATION'] . ' minutes' . '</div>' .
                                '<div> <b>Meeting Place:</b> ' . $row['PLACE'] . '</div>' .
                                '<div> <b>Meeting Participant:</b><br> 
                                        <div>
                                            <b>Student:</b> ' . $studentData['NAME'] . '<br>
                                            <b>Supervisor:</b> ' . $supervisorData['NAME'] . '
                                        </div>
                                    </div>
                                </div>
                                ';
                        }
                    } else {
                        echo ("
                            <h2>There's currently no meeting, come again next time</h2>
                        ");
                    }

                    ?>
                </div>
                <div class="popup-box">
                    <div class="add-meet-box">
                        <form method="get" id="mainForm" action="../src/addMeeting.php">
                            <span class="close-btn">&times;</span>
                            <h1>Add meeting
                                <div class="name-box">
                                    <h2>Meeting Name</h2>
                                    <p><mark>**Default meeting name will be [Student Username] and [Supervisor Username] meeting.</mark></p>
                                    <input class="required" type="text" name="name" placeholder="Insert meeting name here">
                                </div>
                                <div class="place-box">
                                    <h2>Meeting Place</h2>
                                    <input class="required" type="text" name="place" placeholder="Insert meeting place here">
                                </div>
                                <div class="time-box">
                                    <h2>Time</h2>
                                    From <input class="required" name="start_time" type="time"> to <input class="required" name="end_time" type="time">
                                </div>
                                <div class="date-box">
                                    <h2>Date</h2>
                                    <input class="required" name="date" type="date">
                                </div>
                                <h2>People</h2>
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
                                            <select class="required" title="Student name" id="student-name" name="student_id">
                                                <?php
                                                require("../src/database.php");

                                                $getStudentList_query = $con->prepare("SELECT * FROM student");
                                                $getStudentList_query->execute();
                                                $result = $getStudentList_query->get_result();

                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value=' . $row['STUDENT_ID'] . '>' . $row['NAME'] . '</option>';
                                                }

                                                ?>
                                            </select>
                                        </td>
                                        <td class="supervisor">
                                            <select title="Supervisor name" id="supervisor-name" name="supervisor_id">
                                                <option value="<?= $user_data['SUPERVISOR_ID'] ?>"><?= $user_data['NAME'] ?></option>';
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token">
                                <input type="submit" value="Add Meeting">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>