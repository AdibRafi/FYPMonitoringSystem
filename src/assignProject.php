<?php
session_start();

require("database.php");
require("functions.php");

$form_token = $_GET["token"];

if (isset($_SESSION['token']) && isset($form_token) && $_SESSION['token'] === $form_token) {
    $projectID = $_GET["projectID"];
    $studentID = $_GET["studentID"];
    if (!(empty($projectID)) && !(empty($studentID))) {
        $studentData = getStudentDatabyStudentID($con, $studentID);

        $sql = "UPDATE Project set STUDENT_ID = ? WHERE PROJ_ID = ?";
        $updateProject_query = $con->prepare($sql);
        $updateProject_query->execute([$studentID, $projectID]);
        $updateProject_query_result = $updateProject_query->get_result();

        $updateProject_query->close();
        $con->next_result();

        if (mysqli_affected_rows($con)) {

            echo ("<script>
                    alert('Project successfully assigned to " . $studentData['NAME'] . "!');
                    window.location.href='../supervisor/student-to-project_assignment.php';
                    </script>");
        } else {
            echo ("<script>
                    alert('Project not assigned!');
                    window.location.href='../supervisor/student-to-project_assignment.php';
                    </script>");
        }
    } else {
        echo ("<script>
                alert('Please select a student!');
                window.location.href='../supervisor/student-to-project_assignment.php';
                </script>");
        die;
    }
} else {
    echo ("<script>
        window.location.href='../supervisor/student-to-project_assignment.php';
        </script>");
    die;
}
