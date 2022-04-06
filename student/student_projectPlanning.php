<?php
    session_start();

    require ("../src/functions.php");
    require ("../src/database.php");

    $user_data = checkLogin($con);

    $queryProj = $con->prepare("SELECT * FROM PROJECT");
    $queryProj->execute();
    $queryProj_result = $queryProj->get_result();

    $querySup = $con->prepare("SELECT SUPERVISOR_ID,NAME FROM SUPERVISOR");
    $querySup->execute();
    $querySup_result = $querySup->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/student_ProjectPlanning.css">
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
                        <a href="../student/student_dashboard.php"><img class="sidebar-item " src="../src/icon/studentDashboard.png" alt="student dashboard icon" title="Student Dashboard"></a>
                    </li>
                    <li>
                        <a href="../student/student_GoalSetting_ProgressTracking.php"><img class="sidebar-item" src="../src/icon/goal_progress_128px.png" alt="goal setting & progress setting icon" title="Goal Setting & Progress Setting"></a>
                    </li>
                    <li>
                        <a><img class="sidebar-item selected" src="../src/icon/project_planning_128px.png" alt="project planning icon" title="Project Planning"></a>
                    </li>
                    <li>
                        <a href="../student/student_meeting_management.php"><img class="sidebar-item" src="../src/icon/meeting_management_128px.png" alt="project planning icon" title="Meeting Management"></a>
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
            <h1 class = "student">Welcome to Project Planning</h1>

			<h2>Project Planning Table</h2>
			<table class = tableSize>
			  <tr>
				<th>Project Name</th>
				<th>Project Description</th>
				<th>Supervisor Name</th>
				<th>Status</th>
			  </tr>
		        <?php
                    if ($queryProj_result && mysqli_num_rows($queryProj_result) > 0) {
                        while ($proj_arr = mysqli_fetch_assoc($queryProj_result)) {
                            echo '<tr>'; 
                            echo '<td>'.$proj_arr['NAME'].'</td>';
                            echo '<td>'.$proj_arr['DESCRIPTION'].'</td>';
                            echo '<td>'.getNameFromID($con, $proj_arr['SUPERVISOR_ID'], "supervisor").'</td>';
                            echo '<td>'.isApproved($proj_arr['IS_APPROVED']).'</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<h2>No goals are currently set</h2>';
                    }
	            ?>
			</table>
            </div> 
            <div class = "planInfo">
                <form method= "get" action = "../src/addProject.php">
                <div class = "plan">
                    <h2><label>Plan</label></h2>
                    <input type = "text" name = "plan_name" placeholder="Enter Your Plan" required>
                </div>

                <div class = "planDesc">
                    <h2><label>Plan Description</label></h2>
                    <input type = "text" name = "plan_desc" placeholder="Enter Plan Description" required>
                </div>

                <div class = "supervisorDropDown">
                    <h2><label>Supervisor</label></h2>
                    <select name="supervisor_id">
                    <option value="SNULL">Select Supervisor</option>
                    <?php
                        //Foreach loop to send the id values and the option
                        while ($sup_arr = mysqli_fetch_assoc($querySup_result)) {
                            echo '<option value="'.$sup_arr['SUPERVISOR_ID'].'">'.$sup_arr['NAME'].'</option>';
                        }
                    ?>
                </div>

                <div class = "backupPlan">
                    <h2><label>Backup Plan</label></h2>
                    <input type = "text" name = "plan_backup" placeholder="Enter Your Backup Plan" required>
                </div>

                <div class ="student">
                        <?php
                            echo '<input type="hidden" name ="student_id" value="'.$_SESSION['STUDENT_ID'].'">';
                        ?>
                </div>
                    
                <p class = "addPlan"><input type = "Submit" value = "Add Plan" ></p>
            </div>
        </div>
    </div>
</body>
</html>
