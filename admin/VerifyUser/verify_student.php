<?php
session_start();

require('../../src/database.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify User</title>
    <link rel="stylesheet" href="verify_user.css" type="text/css">
    <script type="text/javascript" src="verify_user.js"></script>
</head>
<body>
<div class="verify-box">
    <h1>Verify User</h1>
    <h2>Click row to checked</h2>
    <form action="update/update_student.php" method="post">
        <thead>
            <input type="submit" name="backBtn" value="Back to Login"
                   class="verify-box" style="display: inline-block;margin-left: 0">
            <input type="submit" name="studentTable" value="Student Table"
                    class="verify-box" style="display: inline-block;margin-left: 0" id="changeText"
                    onclick="changeTextToStudent(this)">
            <input type="submit" name="supervisorTable" value="Supervisor Table"
                   class="verify-box" style="display: inline-block;margin-left: 0" id="changeText"
                   onclick="changeTextToSupervisor(this)">
            <p style="text-align: center" id="changeUserText">
        </thead>
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
                        <td><input type="checkbox" name="student[]" value="'.$row["STUDENT_ID"].'"></td>
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
                <td>
                    <input type="submit" name="submit" value="submit" class="verify-box">
                </td>
            </tr>
        </tfoot>
    </form>
</div>
</body>
</html>
