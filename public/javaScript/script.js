console.log('tes')
const dark = document.querySelector(".js_dark_mode"); // je declare ma const via la class js_dark_mode

const body = document.querySelector('.js_body'); //je selectionne le body via .js_body

if (localStorage.getItem('night')==='true'){ //je verifie dans le local storage si le mode night est activé
   body.classList.add('night');
}

dark.addEventListener('click', function () {

   if (body.classList.contains('night')) { //si le body as deja la classe night,
      body.classList.remove('night')// je lui enleve
      localStorage.removeItem('night'); // je le desactive dans le local storage
   } else {
      body.classList.add('night');//sinon, je lui ajoute
      localStorage.setItem('night', 'true');//je le sauvegarde en local storage
   }
})

//---------------------------------------------------------------------------
   const sidenav = document.getElementById("mySidenav");
   const openBtn = document.getElementById("openBtn");
   const closeBtn = document.getElementById("closeBtn");

   openBtn.onclick = openNav;
   closeBtn.onclick = closeNav;

   function openNav() {
      sidenav.classList.add("active");
   }
   
   function closeNav() {
      sidenav.classList.remove("active");
   }








