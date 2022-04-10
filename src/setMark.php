<?php

session_start();

require("database.php");
require("functions.php");

function calculateScore($score, $weightage)
{
    return $weightage * (($score / 10) * 2);
}

function calculateTotalScore($scoreArray)
{
    $totalScore = 0;
    foreach ($scoreArray as $score) {
        $totalScore += $score;
    }
    return $totalScore * 2;
}

$abstractScore = $_GET["abstractScore"];
$problemStatementScore = $_GET["problemStatementScore"];
$literatureReviewScore = $_GET["literatureScore"];
$proposeSolutionScore = $_GET["proposeSolutionScore"];
$spellingScore = $_GET["spellingScore"];
$writeStyleScore = $_GET["writeStyleScore"];
$figureScore = $_GET["figureScore"];
$abbreviationScore = $_GET["abbreviationScore"];
$studentId = $_GET["studentId"];
$PATH = "";

if (isset($studentId) && isset($abstractScore) && isset($problemStatementScore) && isset($literatureReviewScore) && isset($proposeSolutionScore) && isset($spellingScore) && isset($writeStyleScore) && isset($figureScore) && isset($abbreviationScore)) {

    //Get data required to insert into the table
    $scoreArray = array(
        "abstractScore" => calculateScore($_GET["abstractScore"], 3),
        "problemStatementScore" => calculateScore($_GET["problemStatementScore"], 5),
        "literatureReviewScore" => calculateScore($_GET["literatureScore"], 10),
        "proposedSolutionScore" => calculateScore($_GET["proposeSolutionScore"], 20),
        "spellingScore" => calculateScore($_GET["spellingScore"], 3),
        "writingStyleScore" => calculateScore($_GET["writeStyleScore"], 3),
        "figureScore" => calculateScore($_GET["figureScore"], 3),
        "abbreviationScore" => calculateScore($_GET["abbreviationScore"], 3)
    );

    $totalScore = calculateTotalScore($scoreArray);

    //Check if student is in database
    $studentData = getStudentDatabyStudentID($con, $studentId);
    if (!$studentData) {
        echo ("<script>
        alert('Student not found!');
        window.location.href='../supervisor/mark_sheets.php';
        </script>");
        die;
    }

    //Get ID of latest data entry
    $get_check_query = "SELECT MARK_ID FROM Mark";

    //Append 1 to ID
    $markId = getID($con, "mark");

    //Insert data into database accordingly
    $sql = "INSERT INTO Mark (MARK_ID,NAME,PATH,PERCENTAGE,IS_MARKED,SUPERVISOR_ID,STUDENT_ID) values (?,?,?,?,?,?,?)";
    $addMeet_query = $con->prepare($sql);
    $addMeet_query->bind_param("sssssss", $markId, $studentData["NAME"] . " Mark", $PATH, $totalScore / 100, 1, $_SESSION["SUPERVISOR_ID"], $studentData["STUDENT_ID"]);

    //Insert into table


} else {
    echo "<script>";
    echo "alert('Please fill in all the fields');";
    echo "window.location.href='../supervisor/mark_sheets.php'";
    echo "</script>";
}
