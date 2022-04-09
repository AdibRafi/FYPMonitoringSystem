<?php
    $mark_name = $_GET['mark_name'];
    $mark_path = $GET['mark_link'];
    $student_id = $GET['student_id'];
    $supervisor_id = $GET['supervisor_id'];


    //Append ID
    $mark_id = getID($con, "mark");
    if ($mark_id === "invalid") {
        echo ("<script>
            alert('invalid ID, please try again');
            window.location.href='../student/student_GoalSetting_ProgressTracking.php';
            </script>");
        die;
    }

    $addMark_query = $con->prepare("INSERT INTO Mark (MARK_ID, NAME, PATH, PERCENTAGE, IS_MARKED, SUPERVISOR_ID, STUDENT_ID) values(?,?,?,?,?,?,?)");
    $addMark_query->execute([$mark_id, $mark_name, $mark_path, 0.01, 0, $supervisor_id, $student_id]);
    $addMark_query_result = $addGoal_query->get_result();

    $addMark_query->close();
    $con->next_result();

    if (mysqli_affected_rows($con)) {
        echo ("<script>
            alert('Mark successfully added!');
            window.location.href='../student/submitProject.php';
            </script>");
        die;
    } else {
        echo ("<script>
            alert('Something went wrong!');
            window.location.href='../student/submitProject.php';
            </script>");
        die;
    }
?>