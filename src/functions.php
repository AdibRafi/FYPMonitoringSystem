<?php

    function checkLogin($con){

        if(isset($_SESSION['advisor_id'])){

            $supervisor_id = $_SESSION['advisor_id'];
            $login_check_query = $con->prepare("select * from  advisor where ADVISOR_ID = ? limit 1");
            $login_check_query->bind_param("s",$supervisor_id);
            $login_check_query->execute();
            $login_check_query_result = $login_check_query->get_result();

            if($login_check_query_result && mysqli_num_rows($login_check_query_result) > 0){

                return mysqli_fetch_assoc($login_check_query_result);

            }
        }

        //redirect to login
        echo "<script>window.location.href='../supervisor/supervisor_login.php'</script>";
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

        echo "verification failed!";
        die;
        
    }

    function getMeetingID($con):string{
        $query = $con->prepare("select * from meeting ORDER BY MEET_ID DESC LIMIT 1");
        $query->execute();
        $query_result = $query->get_result();
        $lastrow = $query_result->fetch_assoc();

        if ($query_result){
            $meeting_id = preg_replace_callback( "|(\d+)|", "increment", $lastrow['MEET_ID']);

        }else{
            $meeting_id = "M0001";
        }

        return $meeting_id;
    }

    function increment($matches){
        if(isset($matches[1])){
            $length = strlen($matches[1]);
            return sprintf("%0".$length."d", ++$matches[1]);
        }    
    }

?>