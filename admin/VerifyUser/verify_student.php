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
    <script type="text/javascript" src="../../supervisor/js/sidebar.js"></script>
</head>
<body>
<header class="header">
    <img class="menu-icon" src="../../src/icon/menu_128px.png" alt="menu icon" title="Menu">
    <div class="welcome-msg">
        Welcome, Gaylord.
    </div>
</header>
<div class="container">
    <div class="sidebar">
        <div class="middle-sidebar">
            <ul class="sidebar-item-list">
                <li>
                    <a href="verify_supervisor.php"><img class="sidebar-item" src="../../src/icon/verify_128px.png"
                                                         alt="verify supervisor" title="Verify Supervisor"></a>
                </li>
                <li>
                    <a href="verify_student.php"><img class="sidebar-item selected"
                                                      src="../../src/icon/verify_128px.png" alt="verify student"
                                                      title="Verify Student"></a>
                </li>
                <li>
                    <a href="../adminProject/verify_project.php"><img class="sidebar-item"
                                                                      src="../../src/icon/verify_project_128px.png"
                                                                      alt="verify project"
                                                                      title="Verify Project"></a>
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
                    <a href="../adminProject/list_project.php"><img class="sidebar-item"
                                                                    src="../../src/icon/project_list_128px.png"
                                                                    alt="list project"
                                                                    title="List Project"></a>
                </li>
            </ul>
        </div>
        <div class="bottom-sidebar">
            <ul class="sidebar-item-list">
                <li>
                    <img class="sidebar-item" src="../../src/icon/edit_profile_128px.png" alt="edit profile icon"
                         title="Edit Profile">
                </li>
                <li>
                    <a href="../../src/logout.php"><img class="sidebar-item" src="../../src/icon/logout_128px.png"
                                                        alt="logout icon" title="Logout"></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="verify-box">
            <h1>Verify Student</h1>
            <h2>Click row to checked</h2>
            <form action="verifyStudent_fucntion.php" method="post">
                <table>
                    <tr>
                        <th></th>
                        <th>Student_ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Email</th>
                    </tr>
                    <?php
                    $sql = "SELECT * from Student where ISVERIFIED = 0";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr onclick="selectRow(this)">
                        <td><input type="checkbox" name="student[]" value="' . $row["STUDENT_ID"] . '"></td>
                        <td>' . $row["STUDENT_ID"] . '</td>
                        <td>' . $row["NAME"] . '</td>
                        <td>' . $row["AGE"] . '</td>
                        <td>' . $row["EMAIL"] . '</td>
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
                        <div class="floated" style="text-align: center">
                            <div class="radioBtn">
                                <input type="radio" value="verify" id="verify" name="submitResult">
                                <label for="verify">Verify</label>
                            </div>
                            <div class="radioBtn">
                                <input type="radio" value="remove" id="remove" name="submitResult">
                                <label for="remove">Remove</label>
                            </div>
                        </div>
                    </td>
                    <div class="floated">
                        <input type="submit" name="submit" value="submit" class="submitBtn">
                    </div>
                </tr>
                </tfoot>
            </form>
        </div>
    </div>
</div>
</body>
</html>
