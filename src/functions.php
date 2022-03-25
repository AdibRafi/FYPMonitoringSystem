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

    function getID($con, $type):string{

        switch(strtolower($type)){
            case "meeting":
                $query = $con->prepare("select * from meeting ORDER BY MEET_ID DESC LIMIT 1");
                $query->execute();
                $query_result = $query->get_result();
                $lastrow = $query_result->fetch_assoc();
                if ($query_result){
                    $id = preg_replace_callback( "|(\d+)|", "increment", $lastrow['MEET_ID']);
        
                }else{
                    $id = "MT001";
                }
                break;
            case "goal":
                $query = $con->prepare("select * from goal ORDER BY GOAL_ID DESC LIMIT 1");
                $query->execute();
                $query_result = $query->get_result();
                $lastrow = $query_result->fetch_assoc();
                if ($query_result){
                    $id = preg_replace_callback( "|(\d+)|", "increment", $lastrow['GOAL_ID']);
        
                }else{
                    $id = "GO001";
                }
                break;
            case "mark":
                $query = $con->prepare("select * from mark ORDER BY MARK_ID DESC LIMIT 1");
                $query->execute();
                $query_result = $query->get_result();
                $lastrow = $query_result->fetch_assoc();
                if ($query_result){
                    $id = preg_replace_callback( "|(\d+)|", "increment", $lastrow['MARK_ID']);
        
                }else{
                    $id = "MK001";
                }
                break;
            case "project":
                $query = $con->prepare("select * from project BY PROJECT_ID DESC LIMIT 1");
                $query->execute();
                $query_result = $query->get_result();
                $lastrow = $query_result->fetch_assoc();
                if ($query_result){
                    $id = preg_replace_callback( "|(\d+)|", "increment", $lastrow['PROJECT_ID']);
        
                }else{
                    $id = "PR001";
                }
                break;
            default:
                $id ="invalid";

        }


       

        return $id;
    }

    function increment($matches){
        if(isset($matches[1])){
            $length = strlen($matches[1]);
            return sprintf("%0".$length."d", ++$matches[1]);
        }    
    }

    function getStudentDatabyStudentID($con,$studentID){

        $getStudentName_query = $con->prepare("SELECT * FROM student where STUDENT_ID = ?");
        $getStudentName_query->bind_param("s",$studentID);
        $getStudentName_query->execute();
        $getStudentName_query_result = $getStudentName_query->get_result();
        
        $getStudentName_query->close();
        $con->next_result();

        return mysqli_fetch_assoc($getStudentName_query_result);

    }

    function getAdvisorDatabyAdvisorID($con,$advisorID){

        $getAdvisorName_query = $con->prepare("SELECT * FROM advisor where ADVISOR_ID = ?");
        $getAdvisorName_query->bind_param("s",$advisorID);
        $getAdvisorName_query->execute();
        $getAdvisorName_query_result = $getAdvisorName_query->get_result();
        
        $getAdvisorName_query->close();
        $con->next_result();

        return mysqli_fetch_assoc($getAdvisorName_query_result);

    }

?>