function validarLogin() {
    var usuario = $('#usuario').val();
    var contrasena = $('#pass').val();

    $.ajax({
        type: 'POST',
        url: 'Index/php/Acceso.php',
        data: { usuario: usuario, pass: contrasena },
        success: function (response) {
            if (response === 'admin_success') {
                window.location.href = 'MenuUsuario.php';
            } else if (response === 'Prensa_success') {
                window.location.href = 'CrudNoticia/php/PublicarNoticia.php';
            } else if (response === 'edicionP_success') {
                window.location.href = 'MenuUsuario.php';
            } else if (response === 'edicionM_success') {
                window.location.href = 'MenuUsuario.php';
            } else if (response === 'Marketing_success') {
                window.location.href = 'CrudEvento/php/PublicarEvento.php';
            } else {
                alert('Datos ingresados incorrectos');
            }
        },
        error: function (xhr, status, error) {
            console.error("Error :( ");
        }
    });

    return false;
} 