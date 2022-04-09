const proposeProjectBtn = document
  .getElementsByClassName("propose-project-btn")
  .item(0);

const popupBox = document.getElementsByClassName("popup-box").item(0);

const projectListBox = document
  .getElementsByClassName("proposed-project-list")
  .item(0);

const closeBtn = document.getElementsByClassName("close-btn").item(0);

const submitProposalBtn = document.getElementsByClassName("submit-btn").item(0);

proposeProjectBtn.addEventListener("click", () => {
  popupBox.classList.toggle("visible");
  projectListBox.classList.toggle("hidden");
});

closeBtn.addEventListener("click", () => {
  popupBox.classList.toggle("visible");
  projectListBox.classList.toggle("hidden");
});

function removeProjectBtn(clicked) {
  const projectID = clicked.parentNode.id;

  if (confirm("Are you sure you want to delete this proposed project?")) {
    window.location.href =
      "../src/removeProsedProject.php?projectID=" + projectID;
  }
}
