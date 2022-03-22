<?php

    function checkLogin($con){

        if(isset($_SESSION['supervisor_id'])){

            $supervisor_id = $_SESSION['advisor_id'];
            $login_check_query = $con->prepare("select * from Advisor where advisor_id = ? limit 1");
            $login_check_query->bind_param("s",$supervisor_id);
            $login_check_query->execute();
            $login_check_query_result = $login_check_query->get_result();

            if($login_check_query_result && mysqli_num_rows($login_check_query_result) > 0){

                return mysqli_fetch_assoc($login_check_query_result);

            }
        }

        //redirect to login
        echo "<script>window.location.href='../supervisor/supervisor_login.php';</script>";
        die;
    }

    function getToken($length): string
    {
        return substr(md5(rand()), 0, $length);
    }

    function checkUsername($user_id, $user_type) {
        if ($user_type == "student") {
            //Student
            $query = $con->prepare("SELECT USER_ID FROM STUDENT WHERE USER_ID == ?");
            $query->bind_param("s", $user_id);
            $query->execute();
            $query_result = $query->get_result();
        } else {
            //Advisor
            $query = $con->prepare("SELECT USER_ID FROM Advisor WHERE ADVISOR_ID == ?");
            $query->bind_param("s", $user_id);
            $query->execute();
            $query_result = $query->get_result();
        }

        if($query_result && mysqli_num_rows($query_result) > 0){

            return mysqli_fetch_assoc($query_result);

        }

        echo "verification failed!"
        die;
        
    }

?>