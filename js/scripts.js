//Botón de Regresar
let mybutton = document.getElementById("btnRegresar"); //Obtener el botón

window.onscroll = function() {scrollFunction()}; // Cuando el usuario haga scroll de 20px, se mostrará el botón

function scrollFunction() { // Cuando el usuario haga scroll de 30px, se mostrará el botón
    if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

function topFunction() { //Cuando el usuario haga click en el botón, se regreara al tope
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
//Fin Botón Regresar
//Prelaoder
var loader = document.getElementById("preloader");
window.addEventListener("load", function(){
    loader.style.display="none";
});
//Fin preloader
//Menu hamburguesa
const hamburguesa = document.querySelector(".hamburguesa");
const menu = document.querySelector(".barra ul");

hamburguesa.addEventListener("click", () => {
    hamburguesa.classList.toggle("active");
    menu.classList.toggle("active");
})

document.querySelectorAll(".barra ul li a").forEach(n => n.addEventListener("click", () => {
    hamburguesa.classList.remove("active");
    menu.classList.remove("active");
}));
//Fin menu hamburguesa
//Ordenar Menú
var contenido = document.getElementsByClassName("contenido"); // Obtiene todos los elementos de contenido
var contenidoArray = Array.from(contenido); // Convierte la colección de elementos en un array

// Manejador de evento para el botón "Ordenar"
document.getElementById("btnOrdenar").addEventListener("click", function() {
    // Alterna el estado del orden ascendente/descendente
    ordenAscendente = !ordenAscendente;
    
    // Invoca la función para ordenar por precio
    ordenarPorPrecio();
});

// Variable de estado para el orden ascendente o descendente
var ordenAscendente = true;

// Función para ordenar por precio
function ordenarPorPrecio() {
    // Ordena el array en orden ascendente por precio
    contenidoArray.sort(function(a, b) {
        var precioA = parseFloat(a.querySelector("h6").textContent.substring(1));
        var precioB = parseFloat(b.querySelector("h6").textContent.substring(1));
        if (ordenAscendente) {
            return precioA - precioB; // Orden ascendente
        } else {
            return precioB - precioA; // Orden descendente
        }
    });
    
    // Vuelve a agregar los elementos en el orden deseado
    var galeria = document.querySelector(".galeria");
    contenidoArray.forEach(function(elem) {
        galeria.appendChild(elem);
    });
}

// Función para ordenar por categorías
function ordenarPorCategorias() {
    // Obtiene todos los elementos de contenido
    var contenido = document.getElementsByClassName("contenido");
    
    // Convierte la colección de elementos en un array
    var contenidoArray = Array.from(contenido);
    
    // Ordena el array en orden ascendente por categoría
    contenidoArray.sort(function(a, b) {
        var categoriaA = a.querySelector("h4").textContent;
        var categoriaB = b.querySelector("h4").textContent;
        return categoriaA.localeCompare(categoriaB);
    });
    
    // Vuelve a agregar los elementos en el orden deseado
    var galeria = document.querySelector(".galeria");
    contenidoArray.forEach(function(elem) {
        galeria.appendChild(elem);
    });
}

// Manejador de evento cuando se cambia la opción seleccionada
document.querySelector("select[name='select']").addEventListener("change", function() {
    var selectedValue = this.value;
    var btnOrdenar = document.getElementById('btnOrdenar');
    var selectCat = document.getElementById('selectCat');
    
    if (selectedValue === "preci") {
        btnOrdenar.style.display = 'inline-block';
        selectCategorias.style.display = 'none';
        ordenarPorPrecio();
    } else if (selectedValue === "categ") {
        btnOrdenar.style.display = 'none';
        selectCategorias.style.display = 'inline-block';
        selectCategorias.style.width = 'auto';
        ordenarPorCategorias();
    }
});

//Filtrar por categorias
// Obtener referencia al combobox y al elemento de la galería
var selectCategorias = document.getElementById('selectCategorias');
var galeria = document.getElementById('galeria');

// Capturar el evento de cambio en el combobox
selectCategorias.addEventListener('change', function() {
    // Obtener el texto seleccionado del combobox
    var categoriaSeleccionada = selectCategorias.value;

    // Filtrar las cards según la categoría seleccionada
    var cards = galeria.getElementsByClassName('contenido');
    for (var i = 0; i < cards.length; i++) {
        var card = cards[i];

        // Mostrar todas las cards si se selecciona la opción "Mostrar todas"
        if (categoriaSeleccionada === 'todas') {
            card.style.display = 'block';
        } else {
            // Obtener la categoría de la card actual
            var categoriaCard = card.getElementsByTagName('h4')[0].textContent;

            // Ocultar la card si no coincide con la categoría seleccionada
            if (categoriaCard !== categoriaSeleccionada) {
                card.style.display = 'none';
            } else {
                card.style.display = 'block';
            }
        }
    }
});