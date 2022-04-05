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

submitProposalBtn.addEventListener("click", () => {});
