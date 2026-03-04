$(document).ready(function () {

    $('.fa-trash-can').on('click', function () {
        // Confirmación de eliminación
        if (confirm('¿Estás seguro de que deseas eliminar este marcador?')) {
            var idDescubreHidalgo = $(this).data('id');
            eliminaridDescubreHidalgo(idDescubreHidalgo);
        }
    });

    function eliminaridDescubreHidalgo(id) {
        $.ajax({
            url: 'CrudDescubreHidalgo/php/EliminarDescubreHidalgo/php/EliminarDescubreHidalgo.php',
            type: 'POST',
            data: { id: id },
            success: function (response) {
                if (response.trim().toLowerCase() === 'success_delate') {
                    location.reload();
                } else {
                    console.log('Hay un errror al eliminar marcador: ' + response);
                    location.reload();
                }
            },
            error: function (xhr, status, error) {
                alert('Error en la solicitud AJAX:');
            }
        });
    }
});
