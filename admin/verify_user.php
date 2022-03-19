<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify User</title>
    <link rel="stylesheet" href="../supervisor/css/supervisor_register.css">
</head>
<body>
<div class="register-box">
    <h1>Verify User</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "fypfinal");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * from Student";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["USER_ID"]."</td><td>".$row["NAME"]."</td><td>".$row["PASSWORD"]."</td></tr>";
            }
            echo "</table>";
        }
        else
            echo "0 result";

        $conn->close();
        ?>
    </table>
    <div>
        <input type="radio" value="Verify" id="verify">
        <label for="verify">Verify</label>
        <input type="radio" value="Remove" id="remove">
        <label for="remove">Remove</label>
    </div>
    <input type="submit" value="Submit">
</div>
</body>
</html>