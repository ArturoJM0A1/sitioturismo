(() => {
  // Función para cargar las imágenes desde imagenes.php
  const cargarImagenes = () => {
    fetch(`EventosPublicados/CompletoEvento/sliderGaleria/php/imagenes.php?id=${eventoId}`) // Ruta al archivo PHP que devuelve el JSON de imágenes con el ID del evento
      .then(response => response.json()) // Parsear la respuesta como JSON
      .then(data => {
        // Llamar a la función para crear la estructura HTML y pasar los datos obtenidos
        createHtmlStructure('.slider', data);
      })
      .catch(error => {
        console.error('Error al cargar las imágenes:', error);
      });
  };

  // Función para crear la estructura HTML
  const createHtmlStructure = (sliderSelector, images) => {
    const parent = document.querySelector(sliderSelector);

    // Limpiar el contenido del slider
    parent.innerHTML = '';

    // Slides
    images.forEach((slideImg, index) => {
      const { img } = slideImg;
      const slideItem = `
        <div
          class="item"
          style="background-image: url('${img}')"
          data-attribute="${index}"
        >
        </div>
      `;
      const divFragment = document.createRange().createContextualFragment(slideItem);
      parent.appendChild(divFragment);
    });

    // Botones
    const html = `
      <div class="buttonsGaleriaEvento">
      
        <button class="cardboton prev"> 
        <i class="fa-solid fa-angle-left"></i>
        </button>

        <button class="cardboton next"> 
        <i class="fa-solid fa-angle-right"></i>
        </button>

      </div>
    `;
    const fragment = document.createRange().createContextualFragment(html);
    parent.parentElement.appendChild(fragment);

    // Referencias
    const $slider = document.querySelector('.slider'); 
    const $next = document.querySelector('.next');
    const $prev = document.querySelector('.prev');

    // Event listeners
    $next.addEventListener('click', () => {
      const items = document.querySelectorAll('.item');
      $slider.appendChild(items[0]);
    });

    $prev.addEventListener('click', () => {
      const items = document.querySelectorAll('.item');
      $slider.prepend(items[items.length - 1]);
    });
  };

  // Llamar a la función para cargar las imágenes cuando se cargue la página
  cargarImagenes();
})();
