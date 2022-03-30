var popupBox = document.getElementsByClassName("popup-box").item(0);

var meetListBox = document.getElementsByClassName("meeting-list-box").item(0);

var addMeetBtn = document.getElementsByClassName("addMeet-btn").item(0);

var closeBtn = document.getElementsByClassName("close-btn").item(0);

closeBtn.onclick = function(){
    popupBox.style.display = "none";
    meetListBox.style.display = "block";
}

addMeetBtn.onclick = function(){
    popupBox.style.display = "block";
    meetListBox.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == popupBox) {
        popupBox.style.display = "none";
        meetListBox.style.display = "block"
    }
}
