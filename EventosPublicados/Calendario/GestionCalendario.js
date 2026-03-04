var $todosLosEventos = $('#todosLosEventos'); // Definir aquí para hacerlo accesible en toda la función

$(function () {
    // Función para obtener los eventos del servidor y actualizar el calendario
    function obtenerYActualizarEventos(categoriaSeleccionada, internoExternoSeleccionado, month, year) {
        $.get('./EventosPublicados/Calendario/DatosEventosCalendario.php', { categoria: categoriaSeleccionada, internoExterno: internoExternoSeleccionado }, function (data) {
            var codropsEvents = JSON.parse(data);
            console.log(codropsEvents);

            var transEndEventNames = {
                'WebkitTransition': 'webkitTransitionEnd',
                'MozTransition': 'transitionend',
                'OTransition': 'oTransitionEnd',
                'msTransition': 'MSTransitionEnd',
                'transition': 'transitionend'
            };
            var transEndEventName = transEndEventNames[Modernizr.prefixed('transition')];
            var $wrapper = $('#custom-inner');
            var $calendar = $('#calendar');
            var cal = $calendar.calendario({
                onDayClick: function ($el, $contentEl, dateProperties) {
                    if ($contentEl.length > 0) {
                        showEvents($contentEl, dateProperties);
                    }
                    if (dateProperties.day === 18 && dateProperties.month === 6 && dateProperties.year === 2024) {
                        console.log('¡Evento!');
                    }
                    $todosLosEventos.addClass('claseCalendarOverflowY');
                },
                caldata: codropsEvents,
                displayWeekAbbr: true
            });
            var $month = $('#custom-month').html(cal.getMonthName());
            var $year = $('#custom-year').html(cal.getYear());
            $('#custom-next').on('click', function () {
                cal.gotoNextMonth(updateMonthYear);
            });
            $('#custom-prev').on('click', function () {
                cal.gotoPreviousMonth(updateMonthYear);
            });

            // Actualizar el calendario con el mes y año seleccionados
            actualizarCalendario(month, year);

            // Definición de la función para actualizar el calendario con el mes y año seleccionados
            function actualizarCalendario(month, year) {
                if (typeof cal !== 'undefined') {
                    cal.goto(month - 1, year, updateMonthYear);
                }
            }

            function updateMonthYear() {
                $month.html(cal.getMonthName());
                $year.html(cal.getYear());
            }

            function showEvents($contentEl, dateProperties) {
                hideEvents();
                var $events = $('<div id="custom-content-reveal" class="custom-content-reveal"><h4>Eventos de ' + dateProperties.monthname + ' ' + dateProperties.day + ', ' + dateProperties.year + '</h4></div>');
                var $close = $('<span class="custom-content-close" id="cerrarEvento"></span>').on('click', hideEvents);
                $events.append($contentEl.html(), $close).insertAfter($wrapper);
                setTimeout(function () {
                    $events.css('top', '0%');
                }, 25);
            }

            function hideEvents() {
                var $events = $('#custom-content-reveal');
                if ($events.length > 0) {
                    $events.css('top', '100%');
                    Modernizr.csstransitions ? $events.on(transEndEventName, function () { $(this).remove(); }) : $events.remove();
                }
            }
        });
    }

    // Evento click para el botón "Actualizar"
    $('#actualizarBtn').on('click', function () {
        var categoriaSeleccionada = $('#categoria').val();
        var internoExternoSeleccionado = $('#internoExterno').val();
        var month = $('#month').val(); // Obtener el valor seleccionado del menú de meses
        var year = $('#year').val();   // Obtener el valor seleccionado del menú de años
        obtenerYActualizarEventos(categoriaSeleccionada, internoExternoSeleccionado, month, year);
    });

    $(document).on('click', '#cerrarEvento', function () {
        $todosLosEventos.removeClass('claseCalendarOverflowY');
    });
});
