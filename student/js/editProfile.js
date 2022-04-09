const changePassordBtn = document.getElementsByClassName("").item(0);

const changeEmailBtn = document.getElementsByClassName("").item(0);

function changePassword(button) {
  let newPassword = prompt("Please enter your new password.", "");

  if (newPassword != null && newPassword.length > 0) {
    if (
      confirm(
        "Do you wish to change your password to " +
          newPassword +
          ' ? Press "OK" to confirm, press cancel to revoke action'
      )
    ) {
      let inputPassword = prompt(
        "Please enter your old password to proceed.",
        ""
      );
      if (inputPassword === button.id) {
        window.location.href =
          "../src/editprofile.php?changePasword=" + newPassword;
      } else {
        alert("password incorrect!");
      }
    } else {
      window.location.href = "../student/editProfile.php";
    }
  } else {
  }
}

function changeEmail(button) {
  let newEmail = prompt("Please enter your new email.", "");

  if (newEmail != null && newEmail.length > 0) {
    if (
      confirm(
        "Do you wish to change your email to " +
          newEmail +
          ' ? Press "OK" to confirm, press cancel to revoke action'
      )
    ) {
      let inputPassword = prompt("Please enter your password to proceed.", "");
      if (inputPassword === button.id) {
        window.location.href = "../src/editprofile.php?changeEmail=" + newEmail;
      } else {
        alert("password incorrect!");
      }
    } else {
      window.location.href = "../student/editProfile.php";
    }
  } else {
  }
}
