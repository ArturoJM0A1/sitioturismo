function cambiarImagenPrincipal(imagenId, eventoId) {
    if (confirm('¿Estás seguro de que deseas establecer esta imagen como principal?')) {
        // Realizar solicitud AJAX para cambiar la imagen principal
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "EditarEvento/php/cambiarImagenPrincipal.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Actualizar la interfaz de usuario según sea necesario
                var respuesta = JSON.parse(xhr.responseText);
                if (respuesta.exito) {
                    // Remover el ID de cualquier divimagenprincipal existente
                    var divPrincipalActual = document.getElementById('divimagenprincipal');
                    if (divPrincipalActual) {
                        divPrincipalActual.removeAttribute('id');
                    }

                    // Asignar el ID divimagenprincipal al nuevo elemento seleccionado
                    var divNuevoPrincipal = document.querySelector('div[data-id="' + imagenId + '"]');
                    if (divNuevoPrincipal) {
                        divNuevoPrincipal.setAttribute('id', 'divimagenprincipal');
                    }

                    // Remover la clase 'imagen-principal' de todas las imágenes
                    document.querySelectorAll('.imagen-principal').forEach(function (img) {
                        img.classList.remove('imagen-principal');
                    });

                    // Agregar la clase 'imagen-principal' a la nueva imagen seleccionada
                    document.querySelectorAll('.imagen-evento').forEach(function (img) {
                        if (img.dataset.id == imagenId) {
                            img.classList.add('imagen-principal');
                        }
                    });

                    // Actualizar el valor del input imgPrincipalName con la nueva URL de la imagen principal
                    var nuevaUrlDeImagen = respuesta.nuevaUrl; // Asegúrate de que este sea el nombre correcto en tu respuesta JSON
                    document.getElementById('imgPrincipalName').value = nuevaUrlDeImagen;

                } else {
                    alert('Error al cambiar la imagen principal: ' + respuesta.mensaje);
                }
            }
        };
        xhr.send("idImagen=" + imagenId + "&idEvento=" + eventoId);
    }
}
