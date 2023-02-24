var miStorage = window.localStorage;

const form = document.getElementById('contact-form');

if (miStorage.length > 0){
    setTimeout(myFunction, 2000)
    localStorage.clear();
}
function myFunction() {
    Toastify({

        text: "Correo enviado correctamente",

        duration: 3000

    }).showToast();
}
form.addEventListener('submit', function (event) {
  localStorage.setItem('msj', true);
}, false);