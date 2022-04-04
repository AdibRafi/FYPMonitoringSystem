<?php

    function getStudentDatabyStudentID($con,$studentID){

        $getStudentName_query = $con->prepare("SELECT * FROM student where STUDENT_ID = ?");
        $getStudentName_query->bind_param("s",$studentID);
        $getStudentName_query->execute();
        $getStudentName_query_result = $getStudentName_query->get_result();
        
        $getStudentName_query->close();
        $con->next_result();

        return mysqli_fetch_assoc($getStudentName_query_result);

    }

    function getSupervisorDatabySupervisorID($con, $supervisorID){

        $getSupervisorName_query = $con->prepare("SELECT * FROM Supervisor where SUPERVISOR_ID = ?");
        $getSupervisorName_query->bind_param("s",$supervisorID);
        $getSupervisorName_query->execute();
        $getSupervisorName_query_result = $getSupervisorName_query->get_result();
        
        $getSupervisorName_query->close();
        $con->next_result();

        return mysqli_fetch_assoc($getSupervisorName_query_result);

    }

    function checkLogin($con){

        if(isset($_SESSION['SUPERVISOR_ID'])) {

            $supervisor_id = $_SESSION['SUPERVISOR_ID'];
            $login_check_query_result = getSupervisorDatabySupervisorID($con, $supervisor_id);

            if ($login_check_query_result) {
                return $login_check_query_result;
                die;
            }
        }else if(isset($_SESSION['STUDENT_ID'])){
            $student_id = $_SESSION['STUDENT_ID'];
            $login_check_query_result = getStudentDatabyStudentID($con,$student_id);

            if($login_check_query_result){
                return $login_check_query_result;
                die;
            }
        }

        //redirect to login
         echo "<script>window.location.href='../loginPage.php'</script>";
         die;
    }

    function getToken($length): string
    {
        return substr(md5(rand()), 0, $length);
    }
 
    
    function checkUsername($user_id, $user_type) {
        if ($user_type == "student") {
            //Student
            $query = $con->prepare("SELECT STUDENT_ID FROM STUDENT WHERE STUDENT_ID == ".$user_id);
            $query->bind_param("s", $user_id);
            $query->execute();
            $query_result = $query->get_result();
        } else {
            //Supervisor
            $query = $con->prepare("SELECT USER_ID FROM SUPERVISOR WHERE SUPERVISOR_ID == ?");
            $query->bind_param("s", $user_id);
            $query->execute();
            $query_result = $query->get_result();
        }

        if($query_result && mysqli_num_rows($query_result) > 0){

            return mysqli_fetch_assoc($query_result);

        }

        //Verification has failed
        if ($user_type == "student") {
            echo ("<script>
            alert('Student is not in the database, please try again');
            window.location.href='../supervisor/meeting_management.php';
            </script>");
        } else {
            echo ("<script>
            alert('Supervisor is not in the database, please try again');
            window.location.href='../supervisor/meeting_management.php';
            </script>");
        }
        die;
        
    }

    function getID($con, $type):string{

        switch(strtolower($type)){
            case "meeting":
                $query = $con->prepare("select * from meeting ORDER BY MEET_ID DESC LIMIT 1");
                $query->execute();
                $query_result = $query->get_result();
                $lastrow = $query_result->fetch_assoc();
                if ($query_result && mysqli_num_rows($query_result)>0){
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
                if ($query_result && mysqli_num_rows($query_result)>0){
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
                if ($query_result && mysqli_num_rows($query_result)>0){
                    $id = preg_replace_callback( "|(\d+)|", "increment", $lastrow['MARK_ID']);
        
                }else{
                    $id = "MK001";
                }
                break;
            case "project":
                $query = $con->prepare("select * from project ORDER BY PROJ_ID DESC LIMIT 1");
                $query->execute();
                $query_result = $query->get_result();
                $lastrow = $query_result->fetch_assoc();
                if ($query_result && mysqli_num_rows($query_result)>0){
                    $id = preg_replace_callback( "|(\d+)|", "increment", $lastrow['PROJ_ID']);
        
                }else{
                    $id = "PR001";
                }
                break;
            default:
                $id ="invalid";

        }

        return $id;
    }

    function getNameFromID($con, $id, $type):string {
        switch(strtolower($type)) {      
            case "student":
                $query = $con->prepare("SELECT NAME FROM STUDENT HAVING STUDENT_ID=".$id."");        
                break;

            case "supervisor":
                $query = $con->prepare('SELECT NAME FROM SUPERVISOR WHERE SUPERVISOR_ID="'.$id.'"');
                break;

            case "meeting":
                $query = $con->prepare("SELECT NAME FROM MEETING WHERE MEETING_ID=".$id."");
                break;

            case "goal":
                $query = $con->prepare("SELECT NAME FROM GOAL WHERE GOAL_ID=".$id."");
                break;

            case "mark":
                $query = $con->prepare("SELECT NAME FROM MARK WHERE MARK_ID=".$id."");
                break;

            case "project":
                $query = $con->prepare('SELECT NAME FROM PROJECT HAVING PROJ_ID='.$id.'');
                break;

            default:
                $name ="invalid";
        }

        $query->execute();
        $query_result = $query->get_result();
        while ($query_arr = mysqli_fetch_assoc($query_result)) {
            $name = $query_arr['NAME'];
        }
        return $name;
    }

    function isApproved($bit) {
        if ($bit == '0') {
            return 'Pending';
        } else {
            return 'Approved';
        }
    }

    function increment($matches){
        if(isset($matches[1])){
            $length = strlen($matches[1]);
            return sprintf("%0".$length."d", ++$matches[1]);
        }    
    }
    
    

?>