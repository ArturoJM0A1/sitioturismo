var mensajesMostrados = {
  todasNoticias: false,
  todosEventosExternos: false
};

function scrollingHandler(elemento, clase, mensajeMostradoKey) {
  if (!mensajesMostrados[mensajeMostradoKey]) {
    var elementoContenedor = document.querySelector(elemento);
    var rectContenedor = elementoContenedor.getBoundingClientRect();
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > rectContenedor.top && scrollTop < rectContenedor.bottom) {
      mensajesMostrados[mensajeMostradoKey] = true;

      var elementosScrolling = document.querySelectorAll(clase);
      elementosScrolling.forEach(function(elementoScrolling) {
        elementoScrolling.classList.add('aparecer');
      });

      setTimeout(function() {
        elementosScrolling.forEach(function(elementoScrolling) {
          elementoScrolling.classList.remove('aparecer');
          elementoScrolling.classList.add('desaparecer');
        });
      }, 1550);
    }
  }
}

function scrollingTodasNoticias() {
  scrollingHandler('#TodasNoticias', '.scrollingx1', 'todasNoticias');
}

function scrollingTodosEventosExternos() {
  scrollingHandler('.TodosEventosExternos', '.scrollingx2', 'todosEventosExternos');
}

function scrollingTodosEventosInternos() {
  scrollingHandler('.todosEventosInternos', '.scrollingx3', 'todosEventosInternos');
}


window.addEventListener('scroll', scrollingTodasNoticias);
window.addEventListener('scroll', scrollingTodosEventosExternos);
window.addEventListener('scroll', scrollingTodosEventosInternos);
