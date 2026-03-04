///Al momento de enviar el formulario


function ActualizaFormulario() {
    // Verificar si al menos un municipio está seleccionado
    var checkboxes = document.querySelectorAll('#cMunicipio input[type="checkbox"]:checked');

    var cAreaGeografica = document.getElementById("cAreaGeografica");
    var areaGeograficaTexto = cAreaGeografica.options[cAreaGeografica.selectedIndex].text;

    // Verificar si el valor seleccionado coincide con los criterios
    if (areaGeograficaTexto === "Estatal (Hidalgo)" || areaGeograficaTexto === "Estatal" || areaGeograficaTexto === "Hidalgo") {
        // Si no se cumple el mínimo de selección, mostrar un mensaje de alerta y no enviar el formulario
        var minSeleccion = 1; // Mínimo de municipios seleccionados permitidos
        if (checkboxes.length < minSeleccion) {
            alert("Por favor, selecciona al menos un municipio.");
            return false;
        }

        // Verificar si se ha excedido el límite máximo de selección
        var maxSeleccion = 4; // Máximo de municipios seleccionados permitidos
        if (checkboxes.length > maxSeleccion) {
            alert("Solo puedes seleccionar un máximo de 4 municipios.");
            return false;
        }
    } else {
        // Deshabilitar y desmarcar los checkboxes si no se cumple la condición
        checkboxes.forEach(function (checkbox) {
            checkbox.disabled = true;
            checkbox.checked = false;
            checkbox.removeEventListener('change', limitarSeleccion);
        });
    }

    // Confirmar la actualización del formulario
    if (confirm('¿Estás seguro de que deseas actualizar esta noticia?')) {
        document.forms[0].submit(); // Enviar el formulario si se confirma
    } else {
        return false; // No enviar el formulario si se cancela
    }
}







////////////Al momento de hacer el cambio de Area geografica





document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        // Obtener el elemento select de cAreaGeografica
        var cAreaGeografica = document.getElementById("cAreaGeografica");

        // Agregar un evento de cambio al elemento select
        cAreaGeografica.addEventListener('change', function () {
            var areaGeograficaTexto = cAreaGeografica.options[cAreaGeografica.selectedIndex].text;
            var checkboxes = document.querySelectorAll('#cMunicipio input[type="checkbox"]');

            // Verificar si el valor seleccionado coincide con los criterios
            if (areaGeograficaTexto === "Estatal (Hidalgo)" || areaGeograficaTexto === "Estatal" || areaGeograficaTexto === "Hidalgo") {
                // Habilitar los checkboxes y limitar la selección a un máximo de 4
                checkboxes.forEach(function (checkbox) {
                    checkbox.disabled = false;
                    checkbox.addEventListener('change', limitarSeleccion);
                });
            } else {
                // Deshabilitar y desmarcar los checkboxes si no se cumple la condición
                checkboxes.forEach(function (checkbox) {
                    checkbox.disabled = true;
                    checkbox.checked = false;
                    checkbox.removeEventListener('change', limitarSeleccion);
                });
            }
        });

        // Función para limitar la selección de checkboxes
        function limitarSeleccion() {
            var checkboxes = document.querySelectorAll('#cMunicipio input[type="checkbox"]:checked');
            var maxSeleccion = 4; // Máximo de municipios seleccionados permitidos

            // Si se excede el límite máximo, desmarcar el checkbox seleccionado más reciente
            if (checkboxes.length > maxSeleccion) {
                this.checked = false;
                alert("Solo puedes seleccionar un máximo de 4 municipios.");
            }
        }

        // Disparar manualmente el evento de cambio cuando se carga la página para aplicar la lógica inicialmente
        cAreaGeografica.dispatchEvent(new Event('change'));
    }, 10);
});
