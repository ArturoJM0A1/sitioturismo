var Inicio = document.getElementById("Inicio");
Inicio.addEventListener("click", function () {
    window.location.href = "index.html";
});

var Noticias = document.getElementById("Noticias");
Noticias.addEventListener("click", function () {
    window.location.href = "NoticiasPublicadas.php";
});

var Eventos = document.getElementById("Eventos");
Eventos.addEventListener("click", function () {
    window.location.href = "CalendarioEventos.php";
});


/////////////////////


var alineacionTexto = document.getElementById('alineacionTexto').textContent.trim();

var alineacionTexto = document.getElementById('alineacionTexto').textContent.trim();
var caracteristicasTarjeta = document.querySelector('.descricion');

if (alineacionTexto === '1') {
    caracteristicasTarjeta.style.textAlign = 'left';
} else if (alineacionTexto === '2') {
    caracteristicasTarjeta.style.textAlign = 'center';
} else if (alineacionTexto === '3') {
    caracteristicasTarjeta.style.textAlign = 'right';
} else if (alineacionTexto === '4') {
    caracteristicasTarjeta.style.textAlign = 'justify';
} else {
    caracteristicasTarjeta.style.textAlign = 'start';
}



/////////////////////


function copiarNoticia() {
    var contenidoNoticia = document.getElementById('todaNoticia');
    var enlace = document.querySelector('.enlace');
    var enlaceNoticia = enlace ? enlace.getAttribute('href') : ''; // Obtener el enlace de la noticia si existe

    var contenidoCopiado = contenidoNoticia.innerText;
    if (enlaceNoticia) {
        contenidoCopiado += '\n' + enlaceNoticia;
    }

    var elementoTemporal = document.createElement('textarea');
    elementoTemporal.value = contenidoCopiado;
    document.body.appendChild(elementoTemporal);

    elementoTemporal.select();
    document.execCommand('copy');

    document.body.removeChild(elementoTemporal);

    alert('Noticia copiada');
}

document.getElementById('copiarNoticia').addEventListener('click', copiarNoticia);



/////////////////////
var Menumedialsocial = document.getElementById("Menumedialsocial");
var filtroMedialSocial = document.getElementById("filtroMedialSocial");

Menumedialsocial.addEventListener("click", function () {
    filtroMedialSocial.style.display = "flex";
});


filtroMedialSocial.addEventListener("click", function () {
    $("#Menumedialsocial").addClass("active");
});


$(document).ready(function () {
    $("#Menumedialsocial").on("click", function () {
        // Verificar si el ancho de la pantalla es igual o menor a 768px
        if (window.matchMedia("(max-width: 768px)").matches) {
            var tab = document.getElementsByClassName("tab");
            $(tab).css("overflow", "visible");

            var tabnavcontainer = document.getElementsByClassName("tab-nav-container");
            $(tabnavcontainer).css("width", "110px");
            $(tabnavcontainer).css("height", "auto");
        }
    });
});


//Cerrar

$(document).ready(function () {
    $("#Menumedialsocial").click(function () {
        $("#filtroMedialSocial").css("display", "flex");
        $("#Menumedialsocial").addClass("active");
        $("#XfiltroMedialSocial").css("display", "flex");
    });

    $("#XfiltroMedialSocial").click(function () {
        location.reload(); // Recargar la página
    });
});

/////////////////////////


document.addEventListener('DOMContentLoaded', function () {
    var facebookButton = document.getElementById('Facebook');
    var twitterButton = document.getElementById('Twitter');
    var whatsappButton = document.getElementById('WhatsApp');
    var instagramButton = document.getElementById('Instagram');
    var telegramButton = document.getElementById('Telegram');

    function abrirVentanaCompartir(url) {
        window.open(url, '_blank');
        window.location.reload();
    }

    facebookButton.addEventListener('click', function () {
        var facebookShareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href);
        abrirVentanaCompartir(facebookShareUrl);
    });

    twitterButton.addEventListener('click', function () {
        var twitterShareUrl = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(window.location.href);
        abrirVentanaCompartir(twitterShareUrl);
    });

    whatsappButton.addEventListener('click', function () {
        var whatsappShareUrl = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(window.location.href);
        abrirVentanaCompartir(whatsappShareUrl);
    });

    instagramButton.addEventListener('click', function () {
        var instagramShareUrl = 'https://www.instagram.com/?url=' + encodeURIComponent(window.location.href);
        abrirVentanaCompartir(instagramShareUrl);
    });

    telegramButton.addEventListener('click', function () {
        var telegramShareUrl = 'https://t.me/share/url?url=' + encodeURIComponent(window.location.href);
        abrirVentanaCompartir(telegramShareUrl);
    });
});



