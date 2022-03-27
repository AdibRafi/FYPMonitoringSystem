function selectRow(row) {
    const firstInput = row.getElementsByTagName('input')[0];
    firstInput.checked = !firstInput.checked;
}

function changeTextToStudent(){
    document.getElementById("changeUserText").innerHTML = "Student"
}

function changeTextToSupervisor(){
    document.getElementById("changeUserText").innerHTML = "Supervisor"
}