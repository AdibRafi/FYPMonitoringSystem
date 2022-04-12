const studentProposedProjectListBox = document
  .getElementsByClassName("student-proposed-project-list")
  .item(0);

const approveProjectBox = document
  .getElementsByClassName("approve-project-box")
  .item(0);

const planningBox = document.getElementsByClassName("planning-box");

const title = document
  .getElementsByClassName("approve-project-box-title")
  .item(0);

const closeBtn = document.getElementsByClassName("close-btn").item(0);
const approveBtn = document.getElementsByClassName("approve-btn").item(0);
const removeBtn = document.getElementsByClassName("remove-btn").item(0);

var projectID;

closeBtn.addEventListener("click", () => {
  title.innerHTML = "Approve project";
  approveProjectBox.classList.toggle("visible");
  studentProposedProjectListBox.classList.toggle("hidden");
});

function clickedProject(clicked) {
  projectID = clicked.children[0].id;
  title.innerHTML += "<div style='text-align:center'>" + projectID + "</div>";
  approveProjectBox.classList.toggle("visible");
  studentProposedProjectListBox.classList.toggle("hidden");
}

approveBtn.addEventListener("click", () => {
  if (confirm("Are you sure you want to approve this project?")) {
    window.location.href =
      "../src/approveProjectProposal.php?projectID=" + projectID;
  }
});

removeBtn.addEventListener("click",()=>{
  if (confirm("Are you sure you want to remove this project?")) {
    window.location.href =
        "../src/removeProjectProposal.php?projectID=" + projectID;
  }
})
