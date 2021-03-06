<?php
session_start();

require('../../src/database.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verify User</title>
    <link rel="stylesheet" href="../admin.css" type="text/css">
    <link rel="stylesheet" href="../../supervisor/css/sidebar_header.css" type="text/css">
    <script type="text/javascript" src="../admin.js"></script>
    <script type="text/javascript" src="../../supervisor/js/sidebar.js" defer></script>
</head>

<body>
<header class="header">
    <img class="menu-icon" src="../../src/icon/menu_128px.png" alt="menu icon" title="Menu">
    <div class="welcome-msg">
        Welcome, Admin.
    </div>
</header>
<div class="container">
    <div class="sidebar">
        <div class="middle-sidebar">
            <ul class="sidebar-item-list">
                <li>
                    <a href="../VerifyUser/verify_supervisor.php"><img class="sidebar-item"
                                                                       src="../../src/icon/verify_128px.png"
                                                                       alt="verify supervisor"
                                                                       title="Verify Supervisor"></a>
                </li>
                <li>
                    <a href="../VerifyUser/verify_student.php"><img class="sidebar-item"
                                                                    src="../../src/icon/verify_128px.png"
                                                                    alt="verify student" title="Verify Student"></a>
                </li>
                <li>
                    <a href="verify_project.php"><img class="sidebar-item" src="../../src/icon/verify_project_128px.png"
                                                      alt="verify project" title="Verify Project"></a>
                </li>
                <li>
                    <a href="../ListUser/student_list/list_student.php"><img class="sidebar-item"
                                                                             src="../../src/icon/list_student_128px.png"
                                                                             alt="list student"
                                                                             title="List Student"></a>
                </li>
                <li>
                    <a href="../ListUser/supervisor_list/list_supervisor.php"><img class="sidebar-item"
                                                                                   src="../../src/icon/list_supervisor_128px.png"
                                                                                   alt="list supervisor"
                                                                                   title="List Supervisor"></a>
                </li>
                <li>
                    <a href="list_project.php"><img class="sidebar-item selected"
                                                    src="../../src/icon/project_list_128px.png" alt="list project"
                                                    title="List Project"></a>
                </li>
            </ul>
        </div>
        <div class="bottom-sidebar">
            <ul class="sidebar-item-list">
                <!--                <li>-->
                <!--                    <img class="sidebar-item" src="../../src/icon/edit_profile_128px.png" alt="edit profile icon"-->
                <!--                         title="Edit Profile">-->
                <!--                </li>-->
                <li>
                    <a href="../../src/logout.php"><img class="sidebar-item" src="../../src/icon/logout_128px.png"
                                                        alt="logout icon" title="Logout"></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="verify-box">
            <h1>List Project</h1>
            <h2>Select Project ID</h2>
            <form action="listProject_function.php" method="post">
                <table>
                    <tr>
                        <th>Project Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Backup Description</th>
                        <th>Student ID</th>
                        <th>Supervisor ID</th>
                    </tr>
                    <?php
                    $sql = "SELECT * from Project WHERE APPROVED_ADMIN = 1 and APPROVED_SUPERVISOR = 1";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
                        <td><div class="radioBtn">
                        <input type="radio" value="' . $row["PROJ_ID"] . '"
                        id="' . $row["PROJ_ID"] . '" name="selectRadio">
                        <label for="' . $row["PROJ_ID"] . '">' . $row["PROJ_ID"] . '</label>
                        </div> </td>
                        <td>' . $row["NAME"] . '</td>
                        <td>' . $row["DESCRIPTION"] . '</td>
                        <td>' . $row["BACKUP_DESCRIPTION"] . '</td>
                        <td>' . $row["STUDENT_ID"] . '</td>
                        <td>' . $row["SUPERVISOR_ID"] . '</td>
                       </tr>';
                        }
                        echo "</table>";
                    } else
                        echo "0 result";

                    $con->close();
                    ?>
                </table>
                <tfoot>
                <tr>
                    <td>
                        <div class="floated">
                            <button class="listBtn" name="editBtn">Edit</button>
                            <button class="listBtn" name="removeBtn">Remove</button>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </form>
        </div>
    </div>
</div>
</body>

</html>