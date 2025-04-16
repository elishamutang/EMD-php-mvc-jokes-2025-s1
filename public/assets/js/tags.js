// Remove existing tags from joke
document.addEventListener('DOMContentLoaded', () => {

    // Get all buttons to remove tags
    const removeTagBtns = document.getElementsByClassName('remove-tag');

    // Attach event listener to each button to listen for a button click.
    Array.from(removeTagBtns).forEach((btn) => {
        btn.addEventListener('click', (e) => {
            console.log(e.currentTarget.parentElement);
        })
    }, true)

})