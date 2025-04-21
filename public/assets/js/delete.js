document.addEventListener('DOMContentLoaded', () => {
    const showButton = document.getElementById('showDialog');
    const confirmButton = document.getElementById('confirmBtn');
    const cancelButton = document.getElementById('cancelBtn');
    const dialog = document.getElementById('dialog-container');
    const body = document.querySelector('body');

    // Show dialog
    showButton.addEventListener('click', () => {
        dialog.classList.toggle('hidden')
    })

    cancelButton.addEventListener('click', () => {
        dialog.classList.toggle('hidden');
    })
})