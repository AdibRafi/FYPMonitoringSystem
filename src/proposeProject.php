<?php

    session_start();

    require ("database.php");
    require ("functions.php");

    $token = $_GET['token'];

    if (isset($_SESSION['token']) && isset($token) && $_SESSION['token'] === $token){
        $projectName = $_GET['projectName'];
        $projectDescription = $_GET['projectDescription'];
        $projectID = getID($con,"project");
        $supervisor_id = $_SESSION['SUPERVISOR_ID'];

        $sql = "insert into Project (PROJ_ID,NAME,DESCRIPTION,SUPERVISOR_ID,IS_APPROVED)values(?,?,?,?,0)";
        $addProject_query = $con->prepare($sql);
        $addProject_query->bind_param("ssss",$projectID,$projectName,$projectDescription,$supervisor_id);
        $addProject_query->execute();
        $addProject_query_result = $addProject_query->get_result();

        if($addProject_query){
            echo("
            <script>
                alert('Project proposal submitted successfully!');
                window.location.href='../supervisor/project_proposal_management.php';
            </script>
            ");
        }else{
            echo("
                <script>
                    alert('something went wrong!');
                    window.location.href='../supervisor/project_proposal_management.php';
                </script>
            ");
        }
        
    }else{
        echo("error");
    }

   
    


?>