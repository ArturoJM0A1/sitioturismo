function eliminarImagen(imagenId, boton) {
    // Verificar si la imagen es principal
    var esPrincipal = boton.parentElement.querySelector('.imagen-evento').classList.contains('imagen-principal');
    if (esPrincipal) {
        alert('No puedes eliminar la imagen principal.');
        return;
    }

    if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
        // Realizar solicitud AJAX para eliminar la imagen
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "EditarEvento/php/eliminarImagen.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Eliminar el div de la imagen si la eliminación fue exitosa
                if (xhr.responseText.includes('Imagen eliminada correctamente')) {
                    var divImagen = boton.parentElement;
                    divImagen.remove();

                    // Opcional: Actualizar la interfaz después de eliminar la imagen
                    // Por ejemplo, podrías volver a cargar la lista de imágenes completa
                    // o simplemente eliminar el div de la imagen específica eliminada.
                } else {
                    alert('Error al eliminar la imagen: ' + xhr.responseText);
                }
            }
        };
        xhr.send("idImagen=" + imagenId);
    }
}
