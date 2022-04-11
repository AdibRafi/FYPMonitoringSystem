<?php
session_start();

require("../src/functions.php");
require("../src/database.php");

$user_data = checkLogin($con);

function generateRow($markName, $weightAge, $descriptionID, $radioName, $jsFunction)
{
    echo '<tr>
           <td>' . $markName . '</td>
                    <td>' . $weightAge . '</td>
                    <td>
                    <div style="width: 300px">
                        <p id="' . $descriptionID . '">
                        Press Button to Display Description
                        </p>
                    </div>
                    </td>
                    <td>
                        <div class="scoreColumn" onload="' . $jsFunction . '" onclick="' . $jsFunction . '">
                            <div class="radiobtn-list">
                                <span>0 <input type="radio" name="' . $radioName . '" value="0"></span>
                                <span>1 <input type="radio" name="' . $radioName . '" value="1"></span>
                                <span>2 <input type="radio" name="' . $radioName . '" value="2"></span>
                                <span>3 <input type="radio" name="' . $radioName . '" value="3"></span>
                                <span>4 <input type="radio" name="' . $radioName . '" value="4"></span>
                                <span>5 <input type="radio" name="' . $radioName . '" value="5"></span>
                            </div>            
                        </div>
                    </td>
                </tr>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marksheet</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/sidebar_header.css" />
    <link rel="stylesheet" href="css/markSheet.css" />
    <!-- Javascripts -->
    <script type="text/javascript" src="js/sidebar.js" defer></script>
    <script type="text/javascript" src="js/markSheet.js" defer></script>
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
                        <a><img class="sidebar-item" src="../src/icon/project_proposal_management_128px.png" alt="project proposal management icon" title="Project Proposal Management"></a>
                    </li>
                    <li>
                        <a href="project_proposal_approval.php"><img class="sidebar-item" src="../src/icon/approve_student_project.png" alt="project planning icon" title="Project Planning"></a>
                    </li>
                    <li>
                        <a href="student-to-project_assignment.php"><img class="sidebar-item" src="../src/icon/student-to-project_assignment_128px.png" alt="student-to-project assignment icon" title="Student-To-Project Assignment"></a>
                    </li>
                    <li>
                        <a href="meeting_management.php"><img class="sidebar-item" src="../src/icon/meeting_management_128px.png" alt="meeting management icon" title="Meeting Management"></a>
                    </li>
                    <li>
                        <a href="mark_sheets.php"><img class="sidebar-item selected" src="../src/icon/marking_128px.png" alt="marking icon" title="Mark Sheets"></a>
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
            <form action="../src/setMark.php" method="get" id="mainForm">

                <div class="marksheet-box">
                    <h1>Welcome to Supervisor Mark Sheets</h1>
                    <div style="padding-bottom: 20px">
                        Select Students:
                        <select name="studentId" id="studentType" onchange="studentProject(this)">
                            <?php
                            //GET THE LIST OF STUDENT WITH NO MARK AND HAVE A PROJECT ASSIGNED TO THEM
                            $sql = "SELECT Student.NAME,Student.STUDENT_ID FROM Student,Mark WHERE Student.STUDENT_ID = Mark.STUDENT_ID and Mark.PATH is not null and Mark.PERCENTAGE = 0.01";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["STUDENT_ID"] . '">'
                                        . $row["NAME"] . '</option>';
                                }
                            }
                            //todo: find ways to display project name (JS inside php)
                            //                        $projectName = getNameFromID($con,$row["STUDENT_ID"],"project")
                            ?>
                        </select>
                    </div>
                    <div class="markSheet-table">
                        <table>
                            <tr>
                                <th>Area of Assessment</th>
                                <th>Weightage</th>
                                <th>Description</th>
                                <th>Score</th>
                            </tr>
                            <?php
                            generateRow(
                                "Abstract",
                                3,
                                "abstractDesc",
                                "abstractScore",
                                "abstractJS()"
                            );
                            generateRow(
                                "Problem Statement",
                                5,
                                "problemStatementDesc",
                                "problemStatementScore",
                                "problemJS()"
                            );
                            generateRow(
                                "Literature Review",
                                10,
                                "literatureReviewDesc",
                                "literatureScore",
                                "literatureJS()"
                            );
                            generateRow(
                                "Proposed Solution",
                                20,
                                "proposedSolutionDesc",
                                "proposeSolutionScore",
                                "proposeSolutionJS()"
                            );
                            generateRow(
                                "Spelling",
                                3,
                                "spellingDesc",
                                "spellingScore",
                                "spellingJS()"
                            );
                            generateRow(
                                "Writing Style",
                                3,
                                "writeStyleDesc",
                                "writeStyleScore",
                                "writeStyleJS()"
                            );
                            generateRow(
                                "Figures,Tables,Graph",
                                3,
                                "figureDesc",
                                "figureScore",
                                "figureJS()"
                            );
                            generateRow(
                                "Abbreviations,Bibliography and Appendices",
                                3,
                                "abbreviationsDesc",
                                "abbreviationScore",
                                "abbreviationJS()"
                            );
                            ?>
                        </table>
                    </div>
                    <input type="submit" name="submit" value="Add Mark">
                </div>
            </form>
        </div>
    </div>
</body>

</html>