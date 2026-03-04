var fondoMenu = $(".fondoMenu");

var originalBorderRadius = fondoMenu.css("border-radius");

let lastScrollPosition = 0;

window.addEventListener('scroll', function () {
    const currentScrollPosition = window.scrollY;

    if (currentScrollPosition > lastScrollPosition) {
        //console.log('Scrooll baja');
        overlay.css({
            "background-color": "rgba(0, 0, 0, 0.5)",
            "transition": "1s ease"
        });
    } else if (currentScrollPosition < lastScrollPosition) {
        //console.log('Scrooll sube');
        fondoMenu.css({
            "border-radius": originalBorderRadius,
        });
        overlay.css({
            "background-color": "rgba(181, 28, 64, 0.1)",
            "transition": "background-color 1s ease",
            "border-radius": originalBorderRadius,
            "transition": "border-radius 1s ease"
        });
    }

    lastScrollPosition = currentScrollPosition;
});



//Cambiar imagenes de fondo

var images = ["Index/imagenes/2.jpg", "Index/imagenes/4.jpg", "Index/imagenes/3.jpg", "Index/imagenes/8.jpg", "Index/imagenes/7.jpg", "Index/imagenes/5.jpg", "Index/imagenes/1.jpg", "Index/imagenes/6.jpg"];
var currentIndex = 0;

function changeImage() {
    fondoMenu.css({
        "background-image": "url(" + images[currentIndex] + ")",
    });

    currentIndex = (currentIndex + 1) % images.length;
}

const tiempocambioimagen = 2850;

window.onload = function () {
    changeImage();
    setInterval(changeImage, tiempocambioimagen);
};

