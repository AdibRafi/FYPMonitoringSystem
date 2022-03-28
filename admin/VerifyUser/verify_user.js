function selectRow(row) {
    const firstInput = row.getElementsByTagName('input')[0];
    firstInput.checked = !firstInput.checked;
}
