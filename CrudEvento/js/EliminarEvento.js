$(document).ready(function () {

    $('.fa-trash-can').on('click', function () {
        // Confirmación de eliminación
        if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
            var idEvento = $(this).data('id');
            eliminarEvento(idEvento);
        }
    });

    function eliminarEvento(id) {
        $.ajax({
            url: 'CrudEvento/php/EliminarEvento/php/EliminarEvento.php',
            type: 'POST',
            data: { id: id },
            success: function (response) {
                if (response.trim().toLowerCase() === 'success_delate') {
                    location.reload();
                } else {
                    console.log('Hay un errror al eliminar el evento: ' + response);
                    location.reload();
                }
            },
            error: function (xhr, status, error) {
                alert('Error en la solicitud AJAX:');
            }
        });
    }
});
