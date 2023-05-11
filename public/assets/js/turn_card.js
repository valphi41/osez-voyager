document.addEventListener('DOMContentLoaded', function () {
    const articles = document.querySelectorAll('article');
    const buttons = document.querySelectorAll('a[role="button"]');

    buttons.forEach((button, index) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();

            const backContent = articles[index].querySelector('.back-content');

            if (backContent.style.display === 'none' || backContent.style.display === '') {
                backContent.style.display = 'block';
                button.textContent = 'Retour';
            } else {
                backContent.style.display = 'none';
                button.textContent = 'Lire mon experience';
            }
        });
    });
});
