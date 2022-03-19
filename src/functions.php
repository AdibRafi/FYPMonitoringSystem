<?php

function checkLogin($con){

    if(isset($_SESSION['supervisor_id'])){

        $supervisor_username = $_SESSION['supervisor_id'];
        $query = "select * from supervisor where supervisor_id = '$supervisor_username' limit 1";
        $result = mysqli_query($con,$query);

        if($result && mysqli_num_rows($result) > 0){

            return mysqli_fetch_assoc($result);

        }
    }

    //redirect to login
    echo "<script>window.location.href='../supervisor/supervisor_login.html';</script>";
    die;
}


?>