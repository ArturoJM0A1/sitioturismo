function setPrincipalImage(imageName) {
    document.getElementById('imgPrincipalName').value = imageName;
}

var InfoSeleccionarLugar = document.getElementById('InfoSeleccionarLugar');

InfoSeleccionarLugar.addEventListener('click', function() {
    Swal.fire({
        imageUrl: '../../Index/imagenes/SeleccionarLugarGoogleMapsApi.png',  
        imageWidth: 740, 
        imageHeight: 215,  
        text: 'Para crear un marcador da click en una de las opciones sugeridas.',
        confirmButtonText: 'Entendido'
    });
});

function validarFormulario() {
    var lugar = document.getElementById('lugar').value.trim();
    if (lugar === "") {
        alert("Debes ingresar el lugar del marcador.");
        return false;
    }

    var imgPrincipal = document.getElementById('imgPrincipal').files.length;
    if (imgPrincipal === 0) {
        alert("Debes seleccionar una imagen.");
        return false;
    }

    return true;
}



function cargarImagen(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.imagenColocada').attr('src', e.target.result);
            $('.seleccionarImagen').html('Imagen: ' + input.files[0].name);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
