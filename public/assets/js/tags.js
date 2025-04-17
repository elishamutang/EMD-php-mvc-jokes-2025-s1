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

    // Detect space key pressed and submit tag on key press.
    tagInput.addEventListener('keyup', submitOnSpace);

})

function removeOnClick(e) {
    console.log(e.currentTarget.parentElement);
    e.currentTarget.parentElement.remove();
}

function submitOnSpace(e) {
    if(e.code === 'Space') {
        let input = e.target.value.trim().toLowerCase();
        e.target.value = ''
        console.log(input)

        if(input !== '') {
            // Copy an existing tag component and overwrite element details.
            const newTagComp = document.querySelector('.tag').cloneNode(true);

            newTagComp.id = input
            newTagComp.querySelector('span').textContent = input
            newTagComp.querySelector('button').addEventListener('click', removeOnClick, {once: true})

            console.log(newTagComp);

            // Attach to DOM.
            const tagsContainer = document.getElementById('tags-container');
            tagsContainer.append(newTagComp);
        }
    }
}