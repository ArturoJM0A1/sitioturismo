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
    var categoria = document.getElementById('categoria').value;
    if (categoria === "" || categoria === "0") {
        alert("Debes seleccionar una categoría.");
        return false;
    }

    var tipoEvento = document.getElementById('internoExterno').value;
    if (tipoEvento === "" || tipoEvento === "0") {
        alert("Debes seleccionar un tipo de evento.");
        return false;
    }

    var lugar = document.getElementById('lugar').value.trim();
    if (lugar === "") {
        alert("Debes ingresar el lugar del evento.");
        return false;
    }

    var files = document.getElementById('imagenes').files;
    if (files.length < 1) {
        alert("Debes subir al menos una imagen.");
        return false;
    } else if (files.length > 8) {
        alert("Solo puedes subir un máximo de 8 imágenes.");
        return false;
    }
    
    return true;
}

function mostrarImagenesSeleccionadas(input) {
    var preview = document.getElementById('imagenPreview');
    preview.innerHTML = '';

    if (input.files) {
        var filesAmount = input.files.length;

        for (var i = 0; i < filesAmount; i++) {
            var reader = new FileReader();

            reader.onload = (function (file, index) {
                return function (event) {
                    var imgContainer = document.createElement('div');
                    imgContainer.classList.add('imagenParaEscoger');

                    var img = document.createElement('img');
                    img.src = event.target.result;
                    img.style.maxWidth = '115px';
                    img.style.maxHeight = '115px';
                    imgContainer.appendChild(img);

                    // Crear div transparente para seleccionar como imagen principal
                    var tocarPrincipal = document.createElement('div');
                    tocarPrincipal.style.position = 'absolute';
                    tocarPrincipal.style.top = '0';
                    tocarPrincipal.style.left = '0';
                    tocarPrincipal.style.width = '100%';
                    tocarPrincipal.style.height = '100%';
                    tocarPrincipal.style.cursor = 'pointer';
                    tocarPrincipal.style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
                    tocarPrincipal.addEventListener('click', function () {
                        // Desmarcar todas las imágenes principales existentes
                        var imagenesPrincipales = document.querySelectorAll('.imgContainerPrincipal');
                        imagenesPrincipales.forEach(function (element) {
                            element.classList.remove('imgContainerPrincipal');
                        });

                        // Marcar esta imagen como principal
                        imgContainer.classList.add('imgContainerPrincipal');

                        // Remover el ID 'imgPrincipal' de la imagen previamente marcada como principal
                        var imagenPrincipalAnterior = document.getElementById('imgPrincipal');
                        if (imagenPrincipalAnterior) {
                            imagenPrincipalAnterior.removeAttribute('id');
                        }

                        // Establecer el ID 'imgPrincipal' en la nueva imagen principal
                        img.id = 'imgPrincipal';

                        // Establecer el nombre de la imagen principal en el campo oculto
                        setPrincipalImage(file.name);
                    });

                    imgContainer.appendChild(tocarPrincipal);

                    preview.appendChild(imgContainer);
                };
            })(input.files[i], i);

            reader.readAsDataURL(input.files[i]);
        }
    }
}
