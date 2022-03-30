var proposeProjectBtn = document.getElementsByClassName("propose-project-btn").item(0);

var proposeProjectBox = document.getElementsByClassName("project-propose-box").item(0);

var projectListBox = document.getElementsByClassName("proposed-project-list").item(0);

var closeBtn = document.getElementsByClassName("close-btn").item(0);

var submitProposalBtn = document.getElementsByClassName("submit-btn").item(0);

proposeProjectBtn.addEventListener("click",()=>{
    proposeProjectBox.classList.toggle("visible");
    projectListBox.classList.toggle("hidden");
})

closeBtn.addEventListener("click",()=>{
    proposeProjectBox.classList.toggle("visible");
    projectListBox.classList.toggle("hidden");
})

submitProposalBtn.addEventListener("click",()=>{
    
})