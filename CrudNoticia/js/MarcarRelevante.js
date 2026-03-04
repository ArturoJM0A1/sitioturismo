function marcarComoRelevante(idNoticia) {
    alert("Cambiando relevancia");
    var iconoEstrella = $(".fa-star[data-id='" + idNoticia + "']");
    console.log("Icono Estrella:", iconoEstrella);

    if (iconoEstrella.hasClass("Relevante")) {
        $.ajax({
            type: "POST",
            url: 'CrudNoticia/php/MarcarRelevante.php',
            data: { idNoticia: idNoticia },
            success: function(response) {
                console.log(response);
                iconoEstrella.removeClass("Relevante");
                location.reload(); // Recargar la página después de quitar la relevancia
            }
        });
    } else {
        $.ajax({
            type: "POST",
            url: 'CrudNoticia/php/MarcarRelevante.php',
            data: { idNoticia: idNoticia },
            success: function(response) {
                console.log(response);
                iconoEstrella.addClass("Relevante");
                location.reload(); // Recargar la página después de marcar como relevante
            }
        });
    }
}
