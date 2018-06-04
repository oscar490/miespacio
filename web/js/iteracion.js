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
 * Se avisa, cambiando el color de fondo de enlace, de que hay mensajes
 * nuevos.
 * @param  {[type]} num_mensajes Número de mensajes nuevos.
 */
function indicarMensajes(num_mensajes) {
    let item_mensajes = $('a#index_mensajes').parent();

    if (num_mensajes > 0) {
        item_mensajes.removeClass('active');
        item_mensajes.addClass('aviso');

    } else {
        item_mensajes.removeClass('aviso');
        let url_search = window.location.search;

        if (url_search == '?r=mensajes%2Findex') {
            item_mensajes.addClass('active');
        }


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

function desactivarBotonForm(form) {
    let boton = form.find("button[type='submit']");

    form.on('beforeSubmit', function() {

        if (!$(this).find('.has-error').length) {
            boton.attr('disabled', "true");
        }

    });

}

function mostrar_imagen(url) {
    let imagen = $("<img>");
    imagen.attr('src', url);
    imagen.css({
        width: '400px',
        height: '300px',
    })

    krajeeDialog.alert(imagen);
}

/**
 * Valida formulario y envia archivos por AJAX.
 * @param  {[type]} url_send         Dirección URL para enviar.
 * @param  {[type]} form_p           Formulario a validar.
 * @param  {[type]} [success_p=null] Función a realizar si se hace
 *                                   bién la petición AJAX.
 */
function sendAjaxFile(url_send, form_p, type_p, success_p = null) {

    $.ajax({
        url: url_send,
        type: type_p,
        enctype: 'multipart/form-data',
        data: new FormData(form_p),
        success: success_p,
        dataType: 'json',
        contentType: false,
        processData: false,
    });

}

/**
 * Muestra un mensaje growl de tipo success.
 * @param  {[type]} mensaje Contenido del mensaje.
 * @return {[type]}         [description]
 */
function growl_success(mensaje) {
    $.growl.notice({
        title: "¡Muy bién!",
        message: mensaje,
    });
}

function growl_error(mensaje) {
    $.growl.error({
        title: "¡Lo siento!",
        message: mensaje,
    })
}
