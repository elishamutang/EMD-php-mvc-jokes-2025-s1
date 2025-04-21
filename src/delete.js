/**
 *  Opens up a dialog / modal to confirm if user wants to delete a specific joke.
 *  @returns void
 */

document.addEventListener('DOMContentLoaded', () => {
    const showButton = document.getElementById('showDialog');
    const cancelButton = document.getElementById('cancelBtn');
    const dialog = document.getElementById('dialog-container');

    // Show dialog
    showButton.addEventListener('click', () => {
        dialog.classList.toggle('hidden')
    })

    cancelButton.addEventListener('click', () => {
        dialog.classList.toggle('hidden');
    })
})