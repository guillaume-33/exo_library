const dark = document.querySelector(".js_dark_mode"); // je dclare ma const via la class js_dark_mode


dark.addEventListener('click', function (){

   const body = document.querySelector('.js_body'); //je selectionne le body via .js_body
   if(body.classList.contains('night')){ //si le body as deja la classe night,
      body.classList.remove('night')// je lui enleve
   }else {
      body.classList.add('night');//sinon, je lui ajoute
   }
})






