$(document).ready(function () {

    //////////////////////////////////////////////////////7

    //Si ya cargaron los resultados
    //Una vez aparezcan los parametros del nuevo url
    //Ocultar la opcion seleccionada con display none
    //Activar la opcion de la categoria del Menu

    $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.has('showAreaGeografica') && urlParams.get('showAreaGeografica') === 'true') {
            $("#filtroareageografica").css("display", "none");
            $("#Menuareageografica").addClass("active");
            $("#XFiltroareageografica").css("display", "flex");
        }

        if (urlParams.has('showMunicipio') && urlParams.get('showMunicipio') === 'true') {
            $("#filtromunicipio").css("display", "none");
            $("#Menumunicipio").addClass("active");
            $("#XFiltromunicipio").css("display", "flex");
        }

        if (urlParams.has('showAnio') && urlParams.get('showAnio') === 'true') {
            $("#filtroanios").css("display", "none");
            $("#Menuanio").addClass("active");
            $("#XFiltroanios").css("display", "flex");
        }

        if (urlParams.has('showLugar') && urlParams.get('showLugar') === 'true') {
            $("#filtrolugares").css("display", "none");
            $("#Menulugares").addClass("active");
            $("#XFiltrolugares").css("display", "flex");
        }

        if (urlParams.has('showActividad') && urlParams.get('showActividad') === 'true') {
            $("#filtroactividades").css("display", "none");
            $("#Menuactividades").addClass("active");
            $("#XFiltroactividades").css("display", "flex");
        }

        if (urlParams.has('showEvento') && urlParams.get('showEvento') === 'true') {
            $("#filtroeventos").css("display", "none");
            $("#Menueventos").addClass("active");
            $("#XFiltroeventos").css("display", "flex");
        }

        if (urlParams.has('Relevante') && urlParams.get('showRelevante') === 'true') {
            $("#filtrorelevantes").css("display", "none");
            $("#Menurelevantes").addClass("active");
            $("#XFiltrorelevantes").css("display", "flex");
        }
    });
});



