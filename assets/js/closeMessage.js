document.addEventListener('DOMContentLoaded', function() {
    var message = document.querySelector('.message');
    var closeButton = document.querySelector('#close-message');

    if (message) {
        setTimeout(function() {
            message.remove();
        }, 3000); // 3000 milliseconds = 3 seconds

        closeButton.addEventListener('click', function() {
            message.remove();
        });
    }
});