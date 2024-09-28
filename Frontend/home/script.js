function openMenu() {
    document.getElementById("menu").style.width = "60%";
    document.getElementById("main").style.marginLeft = "400px";
    document.addEventListener('click', handleClickOutside);
}

function closeMenu() {
    document.getElementById("menu").style.width = "0%";
    document.getElementById("main").style.marginLeft = "0px";
    document.removeEventListener('click', handleClickOutside);
}

function handleClickOutside(event) {
    const menu = document.getElementById('menu');
    if (!menu.contains(event.target) && !document.getElementById('navbar-links').contains(event.target)) {
        closeMenu();
    }
}
