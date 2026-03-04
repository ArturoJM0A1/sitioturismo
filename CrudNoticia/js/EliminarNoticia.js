$(document).ready(function () {

    $('.fa-trash-can').on('click', function () {
        // Confirmación de eliminación
        if (confirm('¿Estás seguro de que deseas eliminar esta noticia?')) {
            var noticiaId = $(this).data('id');
            eliminarNoticia(noticiaId);
        }
    });

    function eliminarNoticia(id) {
        $.ajax({
            url: 'CrudNoticia/php/EliminarNoticia/php/EliminarNoticia.php',
            type: 'POST',
            data: { id: id },
            success: function (response) {
                if (response.trim().toLowerCase() === 'success_delate') {
                    location.reload();
                } else {
                    console.log('Hay un errror al eliminar la noticia: ' + response);
                    location.reload();
                }
            },
            error: function (xhr, status, error) {
                alert('Error en la solicitud AJAX:');
            }
        });
    }
});
