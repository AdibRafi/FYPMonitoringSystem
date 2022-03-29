<?php

    require "functions.php";
    require "database.php";

    session_start();
    $userdata = checkLogin($con);

    if(isset($_GET['changePasword'])){
        $changePassword = $_GET['changePasword'];
    }

    if(isset($_GET['changeEmail'])){
        $changeEmail = $_GET['changeEmail'];
    }

    //check which type of user is logged in
    //FOR SUPERVISOR
    if(isset($_SESSION['SUPERVISOR_ID'])){
        if (!empty($changePassword)){

            //VALIDATING IF NEW PASSWORD  === CURRENT PASSWORD
            if($changePassword === $userdata['PASSWORD']){
                echo("
                <script>
                alert('Password is the same, please try again with a different password');
                window.location.href='../supervisor/editProfile.php';
                </script>
                ");
                die;
            }

            //VALIDATING NEW PASSWORD, ONLY ACCEPTNG ALPHANUMERIC INPUTS 
            if (!preg_match("/^[a-zA-z0-9]+$/",$changePassword)) {
                echo("
                <script>
                alert('Wrong password format, please try again with a different password');
                window.location.href='../supervisor/editProfile.php';
                </script>
                ");
                die;
            }

            //Do query to update database
            $sql = "UPDATE supervisor set PASSWORD = ? where SUPERVISOR_ID = ?";
            $changePassword_query = $con->prepare($sql);
            $changePassword_query->bind_param("ss",$changePassword,$_SESSION['SUPERVISOR_ID']);
            $changePassword_query->execute();
            echo("
            <script>
                alert('Password successfully changed!');
                window.location.href='../supervisor/editProfile.php';
            </script>
            ");

        }
        
        if (!empty($changeEmail)){
            //VALIDATING IF NEW MAIL === CURRENT EMAIL
            if($changeEmail === $userdata['EMAIL']){
                echo("
                    <script>
                        alert('Email is the same, please try again with a different email');
                        window.location.href='../supervisor/editProfile.php';
                    </script>
                ");
                die;
            }
    
            //VALIDATING FOR VALID EMAIL FORMAT
            if (!filter_var($changeEmail, FILTER_VALIDATE_EMAIL)) {
                echo("
                    <script>
                        alert('Wrong email format, please try again with a different email');
                        window.location.href='../supervisor/editProfile.php';
                    </script>
                ");
                die;
            }
    
            //IF PASSED BOTH TEST ABOVE, DO QUERY UPDATE DATABASE
            $sql = "UPDATE supervisor set EMAIL = ? where SUPERVISOR_ID = ?";
            $changeEmail_query = $con->prepare($sql);
            $changeEmail_query->bind_param("ss",$changeEmail,$_SESSION['SUPERVISOR_ID']);
            $changeEmail_query->execute();
            echo("
                <script>
                    alert('Email successfully changed!');
                    window.location.href='../supervisor/editProfile.php';
                </script>
            ");
        }
        
    }

    //FOR STUDENT
    if(isset($_SESSION['STUDENT_ID'])){

        if (!empty($changePassword)){

            //VALIDATING IF THE NEW PASSWORD === CURRENT PASSWORD
            if($changePassword === $userdata['PASSWORD']){
                echo("
                <script>
                    alert('Password is the same, please try again with a different password');
                    window.location.href='../supervisor/editProfile.php';
                </script>
                ");
                die;
            }

            //VALIDATING NEW PASSWORD, ONLY ACCEPTNG ALPHANUMERIC INPUTS 
            if (!preg_match("/^[a-zA-z0-9]+$/",$changePassword)) {
                echo("
                <script>
                    alert('Wrong password format, please try again with a different password');
                    window.location.href='../supervisor/editProfile.php';
                </script>
                ");
                die;
            }
        
            //IF PASSED BOTH TEST ABOVE, DO QUERY UPDATE DATABASE
            $sql = "UPDATE student set PASSWORD = ? where STUDENT_ID = ?";
            $changePassword_query = $con->prepare($sql);
            $changePassword_query->bind_param("ss",$changePassword,$_SESSION['STUDENT_ID']);
            $changePassword_query->execute();
            //CHANGE TO STUDENT'S EDIT PROFILE PAGE
            // echo("
            //     <script>
            //         alert('Password successfully changed!');
            //         window.location.href='../supervisor/editProfile.php';
            //     </script>
            // ");
        }

        if (!empty($changeEmail)){
            
            //VALIDATING IF NEW MAIL === CURRENT EMAIL
            if($changeEmail === $userdata['EMAIL']){
                echo("
                    <script>
                        alert('Email is the same, please try again with a different Email');
                        window.location.href='../supervisor/editProfile.php';
                    </script>
                ");
                die;
            }
    
            //VALIDATING FOR VALID EMAIL FORMAT
            if (!filter_var($changeEmail, FILTER_VALIDATE_EMAIL)) {
                echo("
                <script>
                    alert('Wrong email format, please try again with a different Email');
                    window.location.href='../supervisor/editProfile.php';
                    </script>
                ");
                die;
            }

            //IF PASSED BOTH TEST ABOVE, DO QUERY UPDATE DATABASE
            $sql = "UPDATE student set email = ? where STUDENT_ID = ?";
            $changePassword_query = $con->prepare($sql);
            $changePassword_query->bind_param("ss",$changePassword,$_SESSION['STUDENT_ID']);
            $changePassword_query->execute();
            //CHANGE TO STUDENT'S EDIT PROFILE PAGE
            // echo("
            //     <script>
            //         alert('Email successfully changed!');
            //         window.location.href='../supervisor/editProfile.php';
            //     </script>
            // ");
        }

    }

?>