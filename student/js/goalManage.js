function openGoalEdit(id) {
    //Load popup
    const mainId = document.getElementById("editContent");
    const fragment = document.createDocumentFragment();

    var popupDiv = document.createElement('div');
    var popupForm = document.createElement('form');
    var label = document.createElement('h2');
    var labelTag = document.createElement('label');
    var closeBtn = document.createElement('a');
    var closeBtnImg = document.createElement('img');
    var inputPercentage = document.createElement('input');
    var inputHiddenValue = document.createElement('input');

    var submit = document.createElement('p');
    var submitInput = document.createElement('input');
    var idVal = id;
    console.log("1");

    popupDiv.setAttribute('class','popup-content');
    popupDiv.setAttribute('id','popupContent');

    popupForm.setAttribute('method', 'get');
    popupForm.setAttribute('action', '../src/modifyGoal.php');

    labelTag.textContent = "Goal Percentage";
    
    closeBtn.setAttribute('href','#');
    closeBtn.setAttribute('onClick','closeGoalEdit()');

    closeBtnImg.setAttribute('class','closeBtn');
    closeBtnImg.setAttribute('src','../src/icon/exitIcon.png');
    closeBtnImg.setAttribute('style', 'width: 42px; height: 42px;');
    closeBtnImg.setAttribute('alt', 'exit');

    inputPercentage.setAttribute('type','text');
    inputPercentage.setAttribute('name','goal_percentage');
    inputPercentage.setAttribute('placeholder','New Percentage');

    inputHiddenValue.setAttribute('type', 'hidden');
    inputHiddenValue.setAttribute('name', 'goal_id');
    inputHiddenValue.setAttribute('value', id);

    submit.setAttribute('class', 'button');
    submitInput.setAttribute('type', 'Submit');
    submitInput.setAttribute('value', 'Save Changes');

    label.appendChild(labelTag);
    closeBtn.appendChild(closeBtnImg);
    submit.appendChild(submitInput);

    popupForm.appendChild(label);
    popupForm.appendChild(closeBtn);
    popupForm.appendChild(inputPercentage);
    popupForm.appendChild(inputHiddenValue);
    popupForm.appendChild(submit);
    
    popupDiv.appendChild(popupForm);

    fragment.appendChild(popupDiv);
    mainId.appendChild(fragment);
    
    //Trigger transparency
    document.querySelector(".popupEdit").style.display = "flex";
}

function closeGoalEdit() {
    //Remove div
    var parent = document.getElementById("editContent");
    var toRemoveChild = parent.getElementsByClassName("popup-content")[0];
    parent.removeChild(toRemoveChild);


    //Change style back to none
    document.querySelector(".popupEdit").style.display = "none";
}

function openGoalRemove(id) {
    //Load popup
    const mainId = document.getElementById("removeContent");
    const fragment = document.createDocumentFragment();

    var popupDiv = document.createElement('div');
    var popupForm = document.createElement('form');
    var label = document.createElement('h2');
    var labelTag = document.createElement('label');
    var closeBtn = document.createElement('a');
    var closeBtnImg = document.createElement('img');
    var inputHiddenValue = document.createElement('input');
    var yesBtn = document.createElement('p');
    var submitInput = document.createElement('input');
    var noBtn = document.createElement('p');

    popupDiv.setAttribute('class','popup-content');
    popupDiv.setAttribute('id','popupContent');

    popupForm.setAttribute('method', 'get');
    popupForm.setAttribute('action', '../src/removeGoal.php');

    labelTag.textContent = "Are you sure that you want to remove this goal?";

    closeBtn.setAttribute('href','#');
    closeBtn.setAttribute('onClick','closeGoalRemove()');

    closeBtnImg.setAttribute('class','closeBtn');
    closeBtnImg.setAttribute('src','../src/icon/exitIcon.png');
    closeBtnImg.setAttribute('style', 'width: 42px; height: 42px;');
    closeBtnImg.setAttribute('alt', 'exit');

    inputHiddenValue.setAttribute('type', 'hidden');
    inputHiddenValue.setAttribute('name', 'goal_id');
    inputHiddenValue.setAttribute('value', id);

    yesBtn.setAttribute('class', 'button');
    submitInput.setAttribute('type', 'Submit');
    submitInput.setAttribute('value', 'Yes');

    label.appendChild(labelTag);
    closeBtn.appendChild(closeBtnImg);
    yesBtn.appendChild(submitInput);

    popupForm.appendChild(label);
    popupForm.appendChild(closeBtn);
    popupForm.appendChild(inputHiddenValue);
    popupForm.appendChild(yesBtn);

    popupDiv.appendChild(popupForm);

    fragment.appendChild(popupDiv);
    console.log(fragment);
    mainId.appendChild(fragment);

    //Trigger transparency
    document.querySelector(".popupRemove").style.display = "flex";
}

function closeGoalRemove() {
    //Remove div
    var parent = document.getElementById("removeContent");
    var toRemoveChild = parent.getElementsByClassName("popup-content")[0];
    parent.removeChild(toRemoveChild);

    //Change style back to none
    document.querySelector(".popupRemove").style.display = "none";
}