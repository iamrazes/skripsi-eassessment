
document.addEventListener('DOMContentLoaded', function () {
    const accordionButtons = document.querySelectorAll('[id^="accordionButton"]');

    accordionButtons.forEach(button => {
        button.addEventListener('click', function () {
            const targetMenuId = button.getAttribute('data-target');
            const accordionMenu = document.getElementById(targetMenuId);
            accordionMenu.classList.toggle('hidden');
        });
    });
});
