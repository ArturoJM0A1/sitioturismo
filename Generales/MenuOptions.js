const tabs = document.querySelectorAll('.tab-nav-container .tab');
const tabNavContainer = document.querySelector('.tab-nav-container');

var menu = $(".tab-nav-container");


document.addEventListener('scroll', () => {
    if (window.scrollY === 0) {
        //console.log('Scrooll top');

        // Si el scroll está en la parte superior
        tabs.forEach(tab => {
            tab.classList.remove('white');
            tab.classList.add('pink');
        });
        tabNavContainer.classList.remove('white');

        menu.css({
            "background-color": "rgba(255, 255, 255, 1)",
            "color": "#801741"
        });
    } else {
        // Si el scroll no está abajo
        tabs.forEach(tab => {
            tab.classList.remove('pink');
            tab.classList.add('white');
        });
        tabNavContainer.classList.add('white');

        menu.css({
            "background-color": "#801741",
            "color": "#ffffff"
        });
    }
});

tabs.forEach(clickedTab => {
    clickedTab.addEventListener('click', () => {
        tabs.forEach(tab => {
            tab.classList.remove('active');
        });
        clickedTab.classList.add('active');
    });
});




document.addEventListener("DOMContentLoaded", function() {
    const abrirMenu = document.querySelector(".abrirmenu");
    const cerrarMenu = document.querySelector(".cerrarMenu");
    const abrirTexto = document.querySelector(".abrirTexto");
    const cerrarTexto = document.querySelector(".cerrarTexto");

    abrirMenu.addEventListener("click", function() {
        abrirMenu.style.display = "none";
        abrirTexto.style.display = "none";
        cerrarMenu.style.display = "flex";
        cerrarTexto.style.display = "flex";

        var tabNavContainer = document.querySelector(".tab-nav-container");
        tabNavContainer.style.height = "auto";
        tabNavContainer.style.width = "110px";
        tabNavContainer.style.overflow = "visible"; 
    });


    cerrarMenu.addEventListener("click", function() {
        abrirMenu.style.display = "flex";
        abrirTexto.style.display = "flex";
        cerrarMenu.style.display = "none";
        cerrarTexto.style.display = "none";

        var tabNavContainer = document.querySelector(".tab-nav-container");

        tabNavContainer.style.height = "36px";
        tabNavContainer.style.width = "75px";
        tabNavContainer.style.overflow = "hidden";
    });
    
});





