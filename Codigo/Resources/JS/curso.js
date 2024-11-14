function seleccionarTodos() {
    const checkboxes = document.querySelectorAll('#curso input[type="checkbox"]');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = true;
    });
}

function deseleccionarTodos() {
    const checkboxes = document.querySelectorAll('#curso input[type="checkbox"]');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
}