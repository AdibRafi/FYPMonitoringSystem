<?php
session_start();

require('../../../src/database.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verify User</title>
    <link rel="stylesheet" href="../../admin.css" type="text/css">
    <link rel="stylesheet" href="../../../supervisor/css/sidebar_header.css" type="text/css">
    <!--    PINJAM REGISTER.CSS JAP ALEX-->
    <link rel="stylesheet" href="../../../supervisor/css/registerPage.css" type="text/css">
    <script type="text/javascript" src="../supervisor/js/sidebar.js" defer></script>
    <script type="text/javascript" src="../../admin.js"></script>
</head>

<body>
    <header class="header">
        <img class="menu-icon" src="../../../src/icon/menu_128px.png" alt="menu icon" title="Menu">
        <div class="welcome-msg">
            Welcome, Admin.
        </div>
    </header>
    <div class="container">
        <div class="sidebar">
            <div class="middle-sidebar">
                <ul class="sidebar-item-list">
                    <li>
                        <a href="../../VerifyUser/verify_supervisor.php"><img class="sidebar-item" src="../../../src/icon/verify_128px.png" alt="verify supervisor" title="Verify Supervisor"></a>
                    </li>
                    <li>
                        <a href="../../VerifyUser/verify_student.php"><img class="sidebar-item" src="../../../src/icon/verify_128px.png" alt="verify student" title="Verify Student"></a>
                    </li>
                    <li>
                        <a href="../../adminProject/verify_project.php"><img class="sidebar-item" src="../../../src/icon/verify_project_128px.png" alt="verify project" title="Verify Project"></a>
                    </li>
                    <li>
                        <a href="../../ListUser/student_list/list_student.php"><img class="sidebar-item selected" src="../../../src/icon/list_student_128px.png" alt="list student" title="List Student"></a>
                    </li>
                    <li>
                        <a href="../supervisor_list/list_supervisor.php"><img class="sidebar-item" src="../../../src/icon/list_supervisor_128px.png" alt="list supervisor" title="List Supervisor"></a>
                    </li>
                    <li>
                        <a href="../../adminProject/list_project.php"><img class="sidebar-item" src="../../../src/icon/project_list_128px.png" alt="list project" title="List Project"></a>
                    </li>
                </ul>
            </div>
            <div class="bottom-sidebar">
                <ul class="sidebar-item-list">
                    <!--                <li>-->
                    <!--                    <img class="sidebar-item" src="../../../src/icon/edit_profile_128px.png" alt="edit profile icon"-->
                    <!--                         title="Edit Profile">-->
                    <!--                </li>-->
                    <li>
                        <a href="../../../src/logout.php"><img class="sidebar-item" src="../../../src/icon/logout_128px.png" alt="logout icon" title="Logout"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="verify-box">
                <h1>Edit Student</h1>
                <form action="editStudent_function.php" method="post">
                    <?php
                    $studentSelect = $_SESSION["passedStudentParameter"];
                    $sql = "SELECT * FROM Student WHERE STUDENT_ID = '" . $studentSelect . "'";
                    $result = $con->query($sql);
                    $student = $result->fetch_assoc();
                    echo '
                <div class="register-inputfield">
                    <label>
                        Student ID <br><p style="font-weight: bold">' . $student["STUDENT_ID"] . '</p>
                    </label>
                </div>
                <div class="register-inputfield">
                    <label> Name
                        <input placeholder="Name" type="text" name="name" value="' . $student["NAME"] . '">
                    </label>
                </div>
                <div class="register-inputfield">
                    <label> Age
                        <input placeholder="Age" type="text" name="age" value="' . $student["AGE"] . '">
                    </label>
                </div>
                <div class="register-inputfield">
                    <label> Email
                        <input placeholder="Student ID" type="email" name="email" value="' . $student["EMAIL"] . '">
                    </label>
                </div>
                '
                    ?>
                    <tfoot>
                        <tr>
                            <td>
                                <div class="floated">
                                    <button class="listBtn" name="submitBtn">Submit</button>
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