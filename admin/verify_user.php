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
    <table>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php

        require("../src/database.php");

        $sql = "SELECT * from Student"; //todo need to change in phpmyadmin: only display !isVerified bit(1)
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr onclick="selectRow(this)"><td><input type="checkbox" name="name1"></td><td>' . $row["USER_ID"] . '</td>
                <td>' . $row["NAME"] . '</td><td>' . $row["PASSWORD"] . '</td></tr>';
            }
            echo "</table>";
        } else
            echo "0 result";

        $con->close();
        ?>
    </table>
    <form>
        <div>
            <div class="floated" style="text-align: center">
                <div class="radioBtn">
                    <input type="radio" value="Verify" id="verify" name="submitResult">
                    <label for="verify">Verify</label>
                </div>
                <div class="radioBtn">
                    <input type="radio" value="Remove" id="remove" name="submitResult">
                    <label for="remove">Remove</label>
                </div>
            </div>
            <input type="submit" value="Submit" class="verify-box">
        </div>
    </form>
</div>
</body>
</html>