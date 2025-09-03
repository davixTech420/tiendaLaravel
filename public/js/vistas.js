

 /*
  */
/*este codig es para activar el dark mode en el panel del administrado*/ 
/** */
/**
 *  
 * /** */

var body = document.getElementsByTagName('body')[0];
var darkMode = localStorage.getItem('darkMode');

// Comprueba si el usuario tiene una preferencia de tema oscuro
if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    body.classList.add('dark-mode');
}

// Si se ha almacenado una preferencia en el localStorage, se aplicará automáticamente
if (darkMode === 'true') {
    body.classList.add('dark-mode');
} else if (darkMode === 'false') {
    body.classList.remove('dark-mode');
}

// Cuando se hace clic en el botón, cambia el modo y almacena el nuevo estado en localStorage
document.getElementById('dark-mode-toggle').addEventListener('click', function () {
    if (body.classList.contains('dark-mode')) {
        body.classList.remove('dark-mode');
        localStorage.setItem('darkMode', 'false');
    } else {
        body.classList.add('dark-mode');
        localStorage.setItem('darkMode', 'true');
    }
});
/** */
/**
 * * 
 * */
/**Aca termina la activacion del dark mode del pane del administrador*/

var boton = document.getElementById('dark-mode-toggle');
var icono = document.createElement('i');

// Verifica el modo oscuro almacenado en localStorage
var isDarkMode = localStorage.getItem('darkMode') === 'true';

// Establece el ícono inicial
icono.className = isDarkMode ? 'fas fa-sun' : 'fas fa-moon';

icono.style.color = isDarkMode ? 'black' : 'white';
boton.style.backgroundColor = isDarkMode ? 'white' : 'black';

// Agrega el ícono al botón
boton.appendChild(icono);

// Agrega el evento onclick al botón
boton.onclick = function() {
  // Cambia el valor de isDarkMode
  isDarkMode = !isDarkMode;

  // Actualiza el ícono
  icono.className = isDarkMode ? 'fas fa-sun' : 'fas fa-moon';

  // Actualiza el color del texto del icono
  icono.style.color = isDarkMode ? 'black' : 'white';
  boton.style.backgroundColor = isDarkMode ? 'white' : 'black';
  

  // Aplica una transición al cambio de estilo
  icono.style.transition = 'color 0.8s ease';

  // Almacena el nuevo estado en localStorage
  localStorage.setItem('darkMode', isDarkMode);

  // Almacena los estilos en localStorage
  localStorage.setItem('darkModeIconColor', boton.style.background);
};


/**
 * 
 * aca termina el dark mode
 * 
 */


   /**
 * 
 * estilo y fncionalidad del sweetalert2 
 * 
 */

   window.onload = function() {
    // Para los botones con la clase 'elim'
    const elimButtons = document.querySelectorAll('.elim');
    elimButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.form.submit();
                }
            });
        });
    });

    // Para los botones con la clase 'inac'
    const inacButtons = document.querySelectorAll('.inac');
    inacButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Puedes Desahibilitarle Del Sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, Inactivar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = button.href
                }
            });
        });
    });
}
/**
* aca termina sweetalert2
*/











