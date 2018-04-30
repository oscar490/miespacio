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
 * Realiza una petición AJAX simple.
 * @param  {[type]} url_p  Dirección URL para enviar petición.
 * @param  {[type]} type_p Tipo de petición.
 * @param  {[type]} data_p Datos que se envía en la peticiión.
 */
function sendAjaxSimple(url_p, type_p, data_p, function_p = null) {

    $.ajax({
        url: url_p,
        type: type_p,
        data: data_p,
        success: function_p
    });
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
 * Envia una petición AJAX y renderizar una vista.
 * @param  {[type]} url_p    Dirección URL
 * @param  {[type]} type_p   Tipo de petición
 * @param  {[type]} form_p   Formulario
 * @param  {[type]} selector Selector donde se renderiza la vista.

 */
function sendAjaxRenderizar(url_p, type_p, form_p, selector) {
    $.ajax({
        url: url_p,
        type: type_p,
        data: form_p.serialize(),
        success: function(data) {
            selector.html(data);
        },
    });
}

/**
 * Valida un formulario y realiza una petición ajax.
 * @param  {[type]} form_p    Formulario a validar.
 * @param  {[type]} url_p     Dirección URL para enviar petición.
 * @param  {[type]} type_p    Typo de petición.
 * @param  {[type]} success_p Función ha realizar cuando se hace la petición
 *                            AJAX correctamente.
 */
function validarForm(form_p, url_p, type_p, success_p) {

    form_p.on('beforeSubmit', function() {
        let form = $(this);

        if (form_p.find('.has-error').length) {
            return false;
        }

        sendAjax(url_p, type_p, form.serialize(), success_p);

        return false;
    })
}

/**
 * Se eliminar un elemento mediante ajax.
 * @param  {[type]} elem_boton elemento que inicia el borrado.
 * @param  {[type]} direccion  URL donde se envía la petición ajax.
 */
function eliminarElemento(elem_boton, direccion, func_success = null) {

    elem_boton.on('click', function() {
        krajeeDialog.confirm("¿Deseas de verdad eliminarlo?", function (result) {
            if (result) {
                sendAjax(direccion, 'POST', {}, func_success);
            }
        });
    })
}

/**
 * Realiza una petición AJAX.
 * @param  {[type]} url_p               Dirección URL de peticiión.
 * @param  {[type]} type_p              Tipo de petición.
 * @param  {[type]} data_p              Datos que se envía en la petición.
 * @param  {[type]} [success_p=null]    Función ha realizar si se hace
 *                                      la petición AJAX correctamente.
 * @param  {[type]} [beforeSend_p=null] Función ha realizar antes de realizar
 *                                      la petición AJAX.
 */
function sendAjax(url_p, type_p, data_p, success_p = null,
        beforeSend_p = null) {

    $.ajax({
        url: url_p,
        type: type_p,
        data: data_p,
        beforeSend: beforeSend_p,
        success: success_p
    });
}

/**
 * Valida formulario y envia archivos por AJAX.
 * @param  {[type]} url_send         Dirección URL para enviar.
 * @param  {[type]} form_p           Formulario a validar.
 * @param  {[type]} [success_p=null] Función a realizar si se hace
 *                                   bién la petición AJAX.
 */
function uploadFile(url_send, form_p, success_p = null, beforeSend_p = null) {

    form_p.on('beforeSubmit', function(e) {

        if ($(this).find('.has-error').length) {
            return false;
        }

        $.ajax({
            url: url_send,
            type: 'POST',
            enctype: 'multipart/form-data',
            data: new FormData(this),
            beforeSend: beforeSend_p,
            success: success_p,
            dataType: 'json',
            contentType: false,
            processData: false,
        });

        return false;
    })
}
