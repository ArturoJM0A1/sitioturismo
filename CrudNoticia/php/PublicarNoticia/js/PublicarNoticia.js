console.log("Antes de publicar la noticia");

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

function validarFormulario() {
    var internoExterno = document.getElementById("internoExterno").value;
    if (internoExterno == "" || internoExterno == 0) {
        alert("Por favor, selecciona si la noticia es interna o externa.");
        return false;
    }

    var cAreaGeografica = document.getElementById("cAreaGeografica").value;
    if (cAreaGeografica == "" || cAreaGeografica == 0) {
        alert("Por favor, selecciona el Area geográfica de la noticia.");
        return false;
    }

    var autor = document.getElementById("autor").value;
    if (autor.trim() === "" || autor.trim() === " ") {
        alert("Por favor, ingresa el autor.");
        return false;
    }

    if (internoExterno === "2") {
        var enlace = document.getElementById("enlace").value;

        if (enlace.trim() === "") {
            alert("Por favor, ingresa el enlace.");
            return false;
        }
    }

    var descripcion = document.getElementById("descripcion").value;
    if (descripcion.length < 450) {
        alert("La descripción debe tener más de 450 caracteres.");
        return false;
    }

    var alineacion = document.getElementById("Alineacion").value;
    if (alineacion == "" || alineacion == 0) {
        alert("Por favor, selecciona la alineación del texto.");
        return false;
    }


    return true;
}


var checkboxCount = 0; // Contador para llevar el control del número de checkboxes seleccionados

// Al escoger estatal desplegar los municipios
document.getElementById("cAreaGeografica").addEventListener("change", function () {
    var areaGeograficaTexto = this.options[this.selectedIndex].text; // Obtener el texto de la opción seleccionada
    var cMunicipio = document.getElementById("cMunicipio");

    if (areaGeograficaTexto === "Estatal (Hidalgo)" || areaGeograficaTexto === "Estatal" || areaGeograficaTexto === "Hidalgo") {
        cMunicipio.style.display = "flex"; 
        cMunicipio.style.backgroundColor = "rgba(10, 198, 35, 0.3)"; 
        console.log(areaGeograficaTexto);
    } else {
        cMunicipio.style.display = "none"; 
        cMunicipio.style.backgroundColor = "rgba(255, 0, 0, 0.18)"; 
        
        // Deseleccionar checkboxes de cMunicipio
        var checkboxes = cMunicipio.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });

        // Si se llego a seleccionar un checkbox, resetear a 0
        checkboxCount = 0;
        municipioSeleccionado = false;
    }
});