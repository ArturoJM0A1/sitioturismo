//Al hacer click en X

function quitarfiltro(menu, filtro, xFiltro) {
    setTimeout(function () {
        menu.classList.remove('active');
        filtro.style.display = "none";
        xFiltro.style.display = "none";
        window.location.href = "CrudNoticia.php";
    }, 5); 
}