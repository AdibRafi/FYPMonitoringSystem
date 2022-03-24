function selectRow(row) {
    var firstInput = row.getElementsByTagName('input')[0];
    firstInput.checked = !firstInput.checked;
}