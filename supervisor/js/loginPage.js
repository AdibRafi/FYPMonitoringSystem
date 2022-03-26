//determine if inputField is empty
function makeClean(inputField){
    inputField.classList.remove("error");
}

function isBlank(inputField){
    if (inputField.value === ""){
        return true
    }
    return false
}

// wait until the window load before executing the function
window.addEventListener("load",function (){
    var requiredInputs = document.querySelectorAll(".required");
    for (var i = 0; i < requiredInputs; i++) {
        requiredInputs[i].addEventListener("change", function (e) {
            makeClean(e.target);
        });
    }

    var mainForm = document.getElementById("mainForm");
    mainForm.addEventListener("submit", function (e){
        var requiredInputs = document.querySelectorAll(".required");
        for (var i = 0; i < requiredInputs.length; i++) {
            if (isBlank(requiredInputs[i])) {
                e.preventDefault();
                requiredInputs[i].classList.add("error");
            }
        }
    })
})