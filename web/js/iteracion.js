$(document).ready(function() {

    seleccionarMenuUsuario();
})

/**
 * Cuando se selecciona una de las opciones del menú desplegable
 * de opciones de usuario, el color de fondo del elemento de menú
 * cambia de color para indicar que nos encontramos en esa posisción.
 * @return {[type]} [description]
 */
function seleccionarMenuUsuario() {
    let elementoActivo = $('ul.dropdown-menu .active');

    if (elementoActivo.length == 1) {
        elementoActivo.parent().prev().css('backgroundColor', '#75a4c1');
    }
}

/**
 * Cambia una imágen que se le pasa por parámetro por otra
 * imágen que ya existe.
 * @param  {[type]} imagen          Imágen nueva
 * @param  {[type]} selector_imagen Ubicación de imagen.
 */
function cambiarImagen(imagen, selector_imagen) {
    selector_imagen.attr('src', imagen);
}

/**
 * Se eliminar un elemento mediante ajax.
 * @param  {[type]} elem_boton elemento que inicia el borrado.
 * @param  {[type]} direccion  URL donde se envía la petición ajax.
 */
function eliminarElemento(elem_boton, direccion) {

    elem_boton.on('click', function() {
        krajeeDialog.confirm("¿Deseas de verdad eliminarlo?", function (result) {
            if (result) {
                $.ajax({
                    type: 'POST',
                    url: direccion
                });
            }
        });
    })
}
