<?php
session_start();


require("functions.php");
require("database.php");

function checkingInfoValidation($username, $age, $fullname, $email)
{

    //only allowing user to enter pattern [a-zA-Z0-9] regular expression
    if (!preg_match("/^[a-zA-z0-9]+$/", $username)) {
        $register_data = 'fullname=' . $fullname . '&age=' . $age . '&email=' . $email;
        echo("<script>
            alert('Invalid username, please try again!');
            window.location.href='../registerPage.php?$register_data';
            </script>");
    }

    //if username contain space, return error and send user back to register
    if (str_contains($username, " ")) {
        $register_data = 'fullname=' . $fullname . '&age=' . $age . '&email=' . $email;
        echo("<script>
                alert('Spaces are not allowed in username, please try again!');
                window.location.href='../registerPage.php?$register_data';
                </script>");
    }

    //invalid age
    if ($age > 100) {
        $register_data = 'fullname=' . $fullname . '&username=' . $username . '&email=' . $email;
        echo("<script>
                    alert('Invalid age, please try again!');
                    window.location.href='../registerPage.php?$register_data';
                    </script>");
    }

}

function checkingAccountDuplication($con, $username, $email, $usertype): bool
{
    $duplicate = false;

    if (strtolower($usertype) === "supervisor") {
        $duplicate_query = $con->prepare("select * from Supervisor where SUPERVISOR_ID = ? or EMAIL = ?");
        $duplicate_query->bind_param("ss", $username, $email);
        $duplicate_query->execute();
        $duplicate_query_result = $duplicate_query->get_result();
        //free result set
        $duplicate_query->close();
        $con->next_result();

        if ($duplicate_query_result && mysqli_num_rows($duplicate_query_result) > 0) {
            $duplicate = true;
        }

    }

    if (strtolower($usertype) === "student") {
        $duplicate_query = $con->prepare("select * from Student where STUDENT_ID = ? or EMAIL = ?");
        $duplicate_query->bind_param("ss", $username, $email);
        $duplicate_query->execute();
        $duplicate_query_result = $duplicate_query->get_result();
        //free result set
        $duplicate_query->close();
        $con->next_result();
        if ($duplicate_query_result && mysqli_num_rows($duplicate_query_result) > 0) {
            $duplicate = true;
        }

    }

    return $duplicate;

}

$form_token = $_GET['token'];
if (isset($_SESSION['token']) && isset($form_token) && $_SESSION['token'] === $form_token) {

    //Get registration data
    $fullname = $_GET['fullname'];
    $username = $_GET['username'];
    $password = $_GET['password'];
    $confirmpassword = $_GET['confirmPassword'];
    $age = $_GET['age'];
    $email = $_GET['email'];
    $usertype = $_GET['userType'];
    $isVerified = false;

    if (checkingAccountDuplication($con, $username, $email, $usertype)) {
        $register_data = 'fullname=' . $fullname . '&age=' . $age;
        echo("<script>
                alert('Email or Username taken, please try again!');
                window.location.href='../registerPage.php?$register_data';
                </script>");
    } else if ($password !== $confirmpassword) {
        echo("<script>
                alert('Password Not Match With Confirm Password');
                window.location.href='../registerPage.php?';
                </script>");
    }

    switch ($usertype) {
        case "supervisor":
            $profession = $_GET['profession'];
            $sql = "INSERT INTO Supervisor (SUPERVISOR_ID,PASSWORD,AGE,EMAIL,NAME,PROFESSION,ISVERIFIED)values(?,?,?,?,?,?,?)";
            $register_query = $con->prepare($sql);

            try {
                $register_query_result = $register_query->execute([$username, $password, $age, $email, $fullname, $profession, $isVerified]);
                //free result set
                $register_query->close();
                $con->next_result();
                if ($register_query_result) {
                    echo("<script>
                        alert('Registration Successful!');
                        window.location.href='../loginPage.php';
                        </script>");
                }
            } catch (Exception $e) {
                //free result set
                $register_query->close();
                $con->next_result();

                $register_data = 'fullname=' . $fullname . '&age=' . $age . '&email=' . $email . "&username=" . $username;
                echo("<script>
                    alert('Something went wrong, please try again!');
                    window.location.href='../registerPage.php?$register_data';
                    </script>");
            }
            break;
        case "student":
            $register_query = $con->prepare("INSERT INTO Student (STUDENT_ID,PASSWORD,AGE,EMAIL,NAME,ISVERIFIED)values(?,?,?,?,?,?)");

            try {
                $register_query_result = $register_query->execute([$username, $password, $age, $email, $fullname, $isVerified]);
                //free result set
                $register_query->close();
                $con->next_result();
                if ($register_query_result) {

                    echo("<script>
                        alert('Registration Successful!');
                        window.location.href='../loginPage.php';
                        </script>");
                }
            } catch (Exception $e) {
                //free result set
                $register_query->close();
                $con->next_result();

                $register_data = 'fullname=' . $fullname . '&age=' . $age . '&email=' . $email . "&username=" . $username;
                echo("<script>
                    alert('Something went wrong, please try again!');
                    window.location.href='../registerPage.php?$register_data';
                    </script>");
            }
            break;
        default:
            $register_data = 'fullname=' . $fullname . '&age=' . $age . '&email=' . $email . "&username=" . $username;
            echo("<script>
                    alert('Invalid user type, please try again!');
                    window.location.href='../registerPage.php?$register_data';
                    </script>");
    }


} else {
    //if token is invalid, malicious site trying to access form, do nothing
    echo("<script>window.location.href='../registerPage.php';</script>");
}