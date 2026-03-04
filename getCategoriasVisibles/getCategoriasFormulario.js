//ESTE ES SCRIPT ES PARA LOS FORMULARIOS
//Una vez ya se implanten las subcategorias en la categoria en el HTML y ya se haya creado el boton..
//Función para obtener opciones de categoría y agregarlas a un elemento select
function obtenerOpcionesCategoria(url, elementoSelect) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error de red: ${response.status}`);
            }
            return response.json(); 
        })
        .then(opciones => {
            opciones.forEach(opcion => {
                var option = document.createElement("option");
                option.value = opcion.id;
                option.text = opcion.nombre;
                elementoSelect.appendChild(option); 
            });
        })
        .catch(error => {
            console.error('Error al obtener opciones:', error);
        });
}

// Función para obtener checkboxes de municipios y agregarlos al formulario
function obtenerCheckboxesMunicipios(url, contenedor) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error de red: ${response.status}`);
            }
            return response.json(); 
        })
        .then(municipios => {
            var municipioSeleccionado = false; // Variable para verificar si al menos un municipio está seleccionado

            municipios.forEach(municipio => {
                // Crear un contenedor div para cada par de checkbox y etiqueta
                var divContenedor = document.createElement("div");

                // Crear el checkbox
                var checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.name = "municipio[]"; // Este [] es importante para que los datos se envíen como un array
                checkbox.value = municipio.id;

                // Crear la etiqueta
                var label = document.createElement("label");
                label.textContent = municipio.nombre;

                // Agregar evento de escucha para contar checkboxes seleccionados
                checkbox.addEventListener("change", function() {
                    if (this.checked) {
                        if (checkboxCount >= 4) {
                            this.checked = false; // Desmarcar checkbox si excede 4
                            alert("Solo puedes seleccionar un máximo de 4 municipios.");
                        } else {
                            checkboxCount++;
                        }
                        municipioSeleccionado = true; // Indicar que al menos un municipio está seleccionado
                    } else {
                        checkboxCount--;
                        if (checkboxCount === 0) {
                            municipioSeleccionado = false; // Indicar que ningún municipio está seleccionado si se desmarca todo
                        }
                    }
                });

                // Agregar el checkbox y la etiqueta al contenedor div
                divContenedor.appendChild(checkbox);
                divContenedor.appendChild(label);

                // Agregar el contenedor div al contenedor principal
                contenedor.appendChild(divContenedor);
            });

            // Obtener el valor seleccionado en cAreaGeografica
            var cAreaGeografica = document.getElementById("cAreaGeografica");
            var areaGeograficaTexto = cAreaGeografica.options[cAreaGeografica.selectedIndex].text;

            // Verificar si el valor seleccionado coincide con los criterios
            if (areaGeograficaTexto === "Estatal (Hidalgo)" || areaGeograficaTexto === "Estatal" || areaGeograficaTexto === "Hidalgo") {
                // Agregar una validación para asegurarse de que al menos un municipio esté seleccionado antes de enviar el formulario
                contenedor.closest('form').addEventListener('submit', function(event) {
                    if (!municipioSeleccionado) {
                        event.preventDefault(); // Detener el envío del formulario si ningún municipio está seleccionado
                        alert("Por favor, selecciona al menos un municipio.");
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error al obtener municipios:', error);
        });
}


// Uso de la función para obtener checkboxes de municipios y mostrarlos en el formulario
var cMunicipio = document.getElementById("cMunicipio");
obtenerCheckboxesMunicipios("../../getCategoriasVisibles/categoriaMunicipio.php", cMunicipio);

// Uso de la función para obtener opciones de cada categoría
var cAreaGeografica = document.getElementById("cAreaGeografica");
obtenerOpcionesCategoria("../../getCategoriasVisibles/categoriaAreaGeografica.php", cAreaGeografica);

var cLugar = document.getElementById("cLugar");
obtenerOpcionesCategoria("../../getCategoriasVisibles/categoriaLugar.php", cLugar);

var cActividad = document.getElementById("cActividad");
obtenerOpcionesCategoria("../../getCategoriasVisibles/categoriaActividad.php", cActividad);

var cEvento = document.getElementById("cEvento");
obtenerOpcionesCategoria("../../getCategoriasVisibles/categoriaEvento.php", cEvento);
