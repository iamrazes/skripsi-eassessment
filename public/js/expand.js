
document.addEventListener('DOMContentLoaded', function () {
    const accordionButton = document.getElementById('accordionButton');
    const accordionMenu = document.getElementById('accordionMenu');

    accordionButton.addEventListener('click', function () {
        accordionMenu.classList.toggle('hidden');
    });
});
