$('.botonF1').hover(function(){
    $('.btn').addClass('animacionVer');
  })
  $('.contenedor').mouseleave(function(){
    $('.btn').removeClass('animacionVer');
  })

  document.addEventListener("DOMContentLoaded", function() {
    const cells = document.querySelectorAll('.menu th'); 

    function randomRotation() {
        const randomIndex = Math.floor(Math.random() * cells.length);
        const selectedCell = cells[randomIndex];

        selectedCell.classList.add('rotate');

        setTimeout(() => {
            selectedCell.classList.remove('rotate');
        }, 3000); 
    }
    setInterval(randomRotation, 10000);
});

/*BOTON POPUP*/
const openBtn = document.getElementById('openPopup');
const popup = document.getElementById('loginPopup');
const closeBtn = document.getElementById('closePopup');
  openBtn.addEventListener('click', () => {
    popup.classList.add('popup');
    popup.classList.remove('hidden');
  });

  closeBtn.addEventListener('click', () => {
    popup.classList.remove('popup');
    popup.classList.add('hidden');

  });
  
  window.addEventListener('click', (e) => {
    if (e.target === popup) {
      popup.classList.add('hidden');
    }
  });