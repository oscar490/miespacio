
//  Función de renderización cuando se realiza
//  el AJAX correctamente.
var func_success_tarjeta = function (data) {
    $('div#contenedor_general').html(data);
}

var func_success_tarjeta_update = function (data) {
    $('div.modal-body').html(data);
}

/**
 * Eliminación de tarjeta por AJAX.
 * @param  {[type]} url_send [description]
 * @return {[type]}          [description]
 */
function eliminarTarjeta(boton, url_send) {

    //  js/iteracion.js
    eliminarElemento(boton, url_send, func_success_tarjeta);
}

function createTarjeta(url_send, form_p) {

    //  js/iteracion.js
    validarForm(form_p, url_send, 'POST', func_success_tarjeta);
}

function updateTarjeta(url_send, form_p) {
    
    //  js/iteracion.js
    validarForm(form_p, url_send, 'POST', func_success_tarjeta_update);
}
