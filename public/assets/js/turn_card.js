document.addEventListener('DOMContentLoaded', function() {
    var flipLinks = document.querySelectorAll('.flip-link');

    flipLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            var card = link.parentElement;
            var image = card.querySelector('.image-survivant');
            card.classList.toggle('flipped');
            image.classList.toggle('hidden');
        });
    });
});
