const projectBox = document.getElementsByClassName("approved-project-box");

const projectListBox = document
  .getElementsByClassName("approved-project-list-box")
  .item(0);

const selectStudentBox = document
  .getElementsByClassName("select-student-box")
  .item(0);

const closeBtn = document.getElementsByClassName("close-btn").item(0);

const assignBtn = document.getElementsByClassName("assign-btn").item(0);

var selectedProjectID = "";

closeBtn.addEventListener("click", () => {
  projectListBox.classList.toggle("hidden");
  selectStudentBox.classList.toggle("visible");
});

function clickedProject(clicked) {
  selectedProjectID = clicked.children[0].innerHTML.slice(0, 5);
  projectListBox.classList.toggle("hidden");
  selectStudentBox.classList.toggle("visible");
}

assignBtn.addEventListener("click", () => {
  const studentID = document.getElementById("student-id").value;
  const token = document.getElementById("token").value;
  console.log(studentID, selectedProjectID, token);
  window.location.href =
    "../src/assignProject.php?projectID=" +
    selectedProjectID +
    "&studentID=" +
    studentID +
    "&token=" +
    token;
});
