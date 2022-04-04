const popupBox = document.getElementsByClassName("popup-box").item(0);

const meetListBox = document.getElementsByClassName("meeting-list-box").item(0);

const addMeetBtn = document.getElementsByClassName("addMeet-btn").item(0);

const closeBtn = document.getElementsByClassName("close-btn").item(0);

closeBtn.onclick = function(){
    popupBox.classList.toggle("visible");
    meetListBox.classList.toggle("hidden");
}

addMeetBtn.onclick = function(){
    popupBox.classList.toggle("visible");
    meetListBox.classList.toggle("hidden");
}
