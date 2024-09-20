
// DROPDOWN SUBMENU
let submenu = document.querySelector('.submenu');

// Ved hover på .sub-menu-top, vis submenu
document.querySelector('.sub-menu-top').addEventListener('mouseover', function () {
    submenu.style.display = 'block';
});

// Luk submenu hvis musen forlader klasse .sub-menu-top
document.querySelector('.sub-menu-top').addEventListener('mouseleave', function () {
    submenuTimeout = setTimeout(function () { // Luk submenu efter 300 ms
        submenu.style.display = 'none';
    }, 300);
});

// Hvis musen er over submenu, så skal den ikke lukkes
submenu.addEventListener('mouseover', function () {
    clearTimeout(submenuTimeout); // Annuller lukningen hvis musen er over submenu
});

// Når musen forlader submenu, lukkes den
submenu.addEventListener('mouseleave', function () {
    submenuTimeout = setTimeout(function () {
        submenu.style.display = 'none';
    }, 300);
});
