/**
 * Tag interactivity on client side.
 * @return void
 */
document.addEventListener('DOMContentLoaded', () => {

    // Get all buttons to remove tags
    const removeTagBtns = document.getElementsByClassName('remove-tag');

    // Attach event listener to each button to listen for a button click.
    Array.from(removeTagBtns).forEach((btn) => {
        btn.addEventListener('click', removeOnClick, {once: true})
    })

    // Get input tag field.
    const tagInput = document.getElementById('Tags');

})

function removeOnClick(e) {
    console.log(e.currentTarget.parentElement);
    e.currentTarget.parentElement.remove();
}