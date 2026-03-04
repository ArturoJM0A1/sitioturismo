//////////////Ir a abajo

function desplazarhaciaabajo1() {
    document.getElementById('desplazarhaciaabajo1').scrollIntoView({ behavior: 'smooth' });
}

//////////////Menu

function Inicio() {
    document.getElementById('body').scrollIntoView({ behavior: 'smooth' });
}


//////////////Login

function Login() {

    document.getElementById('body').scrollIntoView({ behavior: 'smooth' });

    var divBienvenida = document.querySelector('.DivDeBienvenida');
    divBienvenida.style.display = 'none';

    var login = document.querySelector('.login');
    login.style.display = 'flex';

    var hidalgoGob = document.querySelector('.hidalgoGob');
    hidalgoGob.style.display = 'none';

    var MenuHidalgoPortal = document.querySelector('.MenuHidalgoPortal');
    MenuHidalgoPortal.style.display = 'none';

    if (window.innerWidth <= 768) {
        var circulomenu = document.querySelector('.circulomenu');
        circulomenu.style.display = 'none';
    }
}

function cerrarLogin() {
    var divBienvenida = document.querySelector('.DivDeBienvenida');
    divBienvenida.style.display = 'flex';

    var login = document.querySelector('.login');
    login.style.display = 'none';

    var hidalgoGob = document.querySelector('.hidalgoGob');
    hidalgoGob.style.display = 'flex';

    var MenuHidalgoPortal = document.querySelector('.MenuHidalgoPortal');
    MenuHidalgoPortal.style.display = 'none';

    var LoginMenu = document.getElementById("LoginMenu");
    LoginMenu.classList.remove("active");

    
    if (window.innerWidth <= 768) {
        var circulomenu = document.querySelector('.circulomenu');
        circulomenu.style.display = 'flex';
    }

    // Limpiar los campos de entrada por ID
    document.getElementById("usuario").value = '';
    document.getElementById("pass").value = '';
}

//Ojos de contraseña

function ojoabierto() {
    var ojoabierto = document.querySelector('#ojoabierto');
    ojoabierto.style.display = 'none';

    var ojocerrado = document.querySelector('#ojocerrado');
    ojocerrado.style.display = 'flex';

    var pass = document.getElementById("pass");
    pass.type = "text";
}

function ojocerrado(){
    var ojoabierto = document.querySelector('#ojoabierto');
    ojoabierto.style.display = 'flex';

    var ojocerrado = document.querySelector('#ojocerrado');
    ojocerrado.style.display = 'none';

    var pass = document.getElementById("pass");
    pass.type = "password";
}


//////////////hidalgo.gob.mx

function MenuPortalGob(){
    var MenuHidalgoPortal = document.querySelector('.MenuHidalgoPortal');
    MenuHidalgoPortal.style.display = 'flex';

    var login = document.querySelector('.login');
    login.style.display = 'none';

    var divBienvenida = document.querySelector('.DivDeBienvenida');
    divBienvenida.style.display = 'none';
}

function CerrarMenuPortalGob(){
    var MenuHidalgoPortal = document.querySelector('.MenuHidalgoPortal');
    MenuHidalgoPortal.style.display = 'none';

    var divBienvenida = document.querySelector('.DivDeBienvenida');
    divBienvenida.style.display = 'flex';
}



var VerTodasLasNoticias = document.getElementById("VerTodasLasNoticias");

VerTodasLasNoticias.addEventListener("click", function () {
    window.location.href = "NoticiasPublicadas.php";
});



var VerTodosLosEventos = document.getElementById("VerTodosLosEventos");

VerTodosLosEventos.addEventListener("click", function () {
    window.location.href = "CalendarioEventos.php";
});


var VerTodosDescrubreHidalgo = document.getElementById("VerTodosDescrubreHidalgo");

VerTodosDescrubreHidalgo.addEventListener("click", function () {
    window.location.href = "DescubreHidalgo/index.html";
});




