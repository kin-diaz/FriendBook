// Post button functionality, waits for the window to load.

window.onload = function(){
    // Gets all the elements and stores in variables.
    var open = document.getElementById('post-btn');
    var modal_container = document.getElementById('modal-container');
    var close = document.getElementById('close-btn');

    // Once the post button is clicked.
    open.addEventListener('click', () => {
        modal_container.classList.add('show'); // Add the show class to the modal-container div.
    });

    // Once the close button is clicked.
    close.addEventListener('click', () => {
        modal_container.classList.remove('show'); // Remove the show class to the modal-container div.
    });
}