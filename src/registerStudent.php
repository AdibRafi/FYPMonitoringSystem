<?php

    session_start();

    require("functions.php");
    require("database.php");

    //Get registration data
    $student_name = $_GET['name'];
    $student_username = $_GET['username'];
    $student_password = $_GET['password'];
    $student_confirmpassword = $_GET['confirmPassword'];
    $student_age = $_GET['age'];
    $student_email = $_GET['email'];
    $form_token = $_GET['token'];


    //Cross-check credentials
    if (!preg_match("/^[a-zA-z0-9]+$/",$student_username)) {
        echo("<script>
        alert('Invalid username, please try again!');
        window.location.href='../student/student_register.php';
        </script>");
    }

    //Check and prepare for database connection
    if (isset($_SESSION['token']) && isset($form_token) && $_SESSION['token'] === $form_token){
        $duplicate_query = $con->prepare("select * from Student where USER_ID = ? or EMAIL = ?");
        $duplicate_query->bind_param("ss",$student_username,$student_email);
        $duplicate_query->execute();
        $duplicate_query_result = $duplicate_query->get_result();

        //Modification starts here
        //free result set
        $duplicate_query->close();
        $con->next_result();

        if($duplicate_query_result && mysqli_num_rows($duplicate_query_result)>0){
            echo ("<script>
                alert('Email or Username taken, please try again!');
                window.location.href='../student/student_register.php';
                </script>");

        if ($student_age > 100 ){
            echo ("<script>
                alert('Invalid age, please try again!');
                window.location.href='../student/student_register.php';
                </script>");
        }

        //if username contain space, return error and send user back to register
        if (str_contains($student_username," ")){
            echo ("<script>
            alert('Spaces are not allowed in username, please try again!');
                window.location.href='../student/student_register.php';
                </script>");
        }

        //if password does not match confirm password, return error
        if ($student_password != $student_confirmpassword){
            echo ("<script>
                alert('Password does not match, please try again!');
                window.location.href='../student/student_register.php';
                </script>");
        }
        
        $sql = "INSERT INTO Student (USER_ID,PASSWORD,AGE,EMAIL,NAME)values(?,?,?,?,?)";
        $register_query = $con->prepare($sql);

        //Send data to database
        try {
            $register_query_result = $register_query->execute([$student_username, $student_password, $student_age, $student_email, $student_fullname]);
            if ($register_query_result) {

                //free result set
                $register_query->close();
                $con->next_result();

                echo("<script>
                alert('Registration Successful!');
                window.location.href='../student/student_login.php';
                </script>");
            }
        } catch (Exception $e) {
            //free result set
            $register_query->close();
            $con->next_result();

            echo("<script>
            alert('Something went wrong, please try again!');
            window.location.href='../student/student_register.php';
            </script>");
        }
    } 
?>