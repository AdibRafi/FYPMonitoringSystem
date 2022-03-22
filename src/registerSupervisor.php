<?php
    session_start();


    require("functions.php");
    require("database.php");

    //Get registration data
    $advisor_fullname = $_GET['fullname'];
    $advisor_username = $_GET['username'];
    $advisor_password = $_GET['password'];
    $advisor_confirmpassword = $_GET['confirmPassword'];
    $advisor_age = $_GET['age'];
    $advisor_email = $_GET['email'];
  
    $form_token = $_GET['token'];

    $register_data = 'fullname='.$advisor_fullname.'&username='.$advisor_username.'&age='.$advisor_age.'&email='.$advisor_email;

    //only allowing user to enter pattern [a-zA-Z0-9] regular expression
    if (!preg_match("/^[a-zA-z0-9]+$/",$advisor_username)) {
        echo("<script>
        alert('Invalid username, please try again!');
        window.location.href='../supervisor/supervisor_register.php?$register_data';
        </script>");
    }

    //if all valid means form token is valid, proceed to register
    if (isset($_SESSION['token']) && isset($form_token) && $_SESSION['token'] === $form_token){
        $duplicate_query = $con->prepare("select * from advisor where ADVISOR_ID = ? or EMAIL = ?");
        $duplicate_query->bind_param("ss",$advisor_username,$advisor_email);
        $duplicate_query->execute();
        $duplicate_query_result = $duplicate_query->get_result();

        //free result set
        $duplicate_query->close();
        $con->next_result();

        if($duplicate_query_result && mysqli_num_rows($duplicate_query_result)>0){
            echo ("<script>
                alert('Email or Username taken, please try again!');
                window.location.href='../supervisor/supervisor_register.php?$register_data';
                </script>");

        }else{
            if ($advisor_age > 100 ){
                    echo ("<script>
                        alert('Invalid age, please try again!');
                        window.location.href='../supervisor/supervisor_register.php?$register_data';
                        </script>");
            }

            //if username contain space, return error and send user back to register
            if (str_contains($advisor_username," ")){
                echo ("<script>
                alert('Spaces are not allowed in username, please try again!');
                    window.location.href='../supervisor/supervisor_register.php?$register_data';
                    </script>");
            }

            //if password does not match confirm password, return error
            if ($advisor_password != $advisor_confirmpassword){
                echo ("<script>
                    alert('Password does not match, please try again!');
                    window.location.href='../supervisor/supervisor_register.php?$register_data';
                    </script>");
            }

            $sql = "INSERT INTO Advisor (ADVISOR_ID,PASSWORD,AGE,EMAIL,NAME)values(?,?,?,?,?)";
            $register_query = $con->prepare($sql);
            try {
                $register_query_result = $register_query->execute([$advisor_username, $advisor_password, $advisor_age, $advisor_email, $advisor_fullname]);
                if ($register_query_result) {

                    //free result set
                    $register_query->close();
                    $con->next_result();

                    echo("<script>
                    alert('Registration Successful!');
                    window.location.href='../supervisor/supervisor_login.php';
                    </script>");
                }
            } catch (Exception $e) {
                //free result set
                $register_query->close();
                $con->next_result();

                echo("<script>
                alert('Something went wrong, please try again!');
                window.location.href='../supervisor/supervisor_register.php?$register_data';
                </script>");
            }

        }
    }else{
        //if token is invalid, malicious site trying to access form, do nothing
        echo("<script>
               window.location.href='../supervisor/supervisor_register.php';
               </script>");
    }



?>