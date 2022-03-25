<?php
//    session_start();

//require("../src/database.php");

//$sql = "SELECT * from Student";


//if (isset($_POST['student'])) echo('<p>' . $_POST['student'] . '</p>');

$student = $_POST['student'];
if (empty($student)) {
    echo"You didn't select any name";
}
else{
    $N = count($student);
    echo"<p>You selected $N students</p>";
    for ($i = 0; $i < $N; $i++) {
        echo($student[$i] . " ");
    }
}
