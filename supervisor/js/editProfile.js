const changePassordBtn = document.getElementsByClassName("").item(0);

const changeEmailBtn = document.getElementsByClassName("").item(0);


function changePassword(password) {
    let newPassword = prompt("Please enter your new password.","");

    if (confirm("Do you wish to change your password to "+newPassword+" ? Press \"OK\" to confirm, press cancel to revoke action")) {
        let inputPassword = prompt("Please enter your old password to proceed.","");
        if (inputPassword === password.toString()){
            window.location.href="../src/editprofile.php?changePasword="+newPassword;
        }else{
            alert("password incorrect!");
        }
    }

}

function changeEmail(password) {
    let newEmail = prompt("Please enter your new email.","");
    
    if (confirm("Do you wish to change your email to "+newEmail+" ? Press \"OK\" to confirm, press cancel to revoke action")) {
        let inputPassword = prompt("Please enter your password to proceed.","");
        if (inputPassword === password.toString()){
            window.location.href="../src/editprofile.php?changeEmail="+newEmail;
        }else{
            alert("password incorrect!");
        }
    }
}
