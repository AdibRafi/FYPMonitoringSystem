<?php

function checkLogin($con){

    if(isset($_SESSION['supervisor_id'])){

        $supervisor_id = $_SESSION['supervisor_id'];
        $login_check_query = $con->prepare("select * from supervisor where supervisor_id = ? limit 1");
        $login_check_query->bind_param("i",$supervisor_id);
        $login_check_query->execute();
        $login_check_query_result = $login_check_query->get_result();

        if($login_check_query_result && mysqli_num_rows($login_check_query_result) > 0){

            return mysqli_fetch_assoc($login_check_query_result);

        }
    }

    //redirect to login
    echo "<script>window.location.href='../supervisor/supervisor_login.html';</script>";
    die;
}


?>