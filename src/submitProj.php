<?php

    require ("../src/functions.php");
    require ("../src/database.php");

    $mark_name = $_GET['mark_name'];
    $mark_path = $_GET['mark_link'];
    $student_id = $_GET['student_id'];
    $supervisor_id = $_GET['supervisor_id'];


    //Append ID
    $mark_id = getID($con, "mark");
    if ($mark_id === "invalid") {
        echo ("<script>
            alert('invalid ID, please try again');
            window.location.href='../student/submitProj.php';
            </script>");
        die;
    }

    if(strlen($mark_path) > 1000) {
        echo ("<script>
            alert('Link is too long, please send a shorter link');
            window.location.href='../student/submitProj.php';
            </script>");
    }

    $addMark_query = $con->prepare("INSERT INTO Mark (MARK_ID, NAME, PATH, PERCENTAGE, IS_MARKED, SUPERVISOR_ID, STUDENT_ID) values(?,?,?,?,?,?,?)");
    $addMark_query->execute([$mark_id, $mark_name, $mark_path, 0.01, false, $supervisor_id, $student_id]);
    $addMark_query_result = $addMark_query->get_result();

    $addMark_query->close();
    $con->next_result();

    if (mysqli_affected_rows($con)) {
        echo ("<script>
            alert('Submission has been sent!');
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