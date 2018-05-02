
//  Función de renderización cuando se realiza
//  el AJAX correctamente.
var func_success_tarjeta = function (data) {
    $('div#contenedor_general').html(data);
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

//  Modifica el nombre y la descripción de la tarjeta.
function updateTarjeta(url_update, form_p, id_tarjeta, url_render) {

    //  js/iteracion.js
    validarForm(form_p, url_update, 'POST', function (data) {

        let modal = $(`li[data-key='${id_tarjeta}'] div[role='dialog']`);

        modal.on('hidden.bs.modal', function() {
            sendAjax(url_render, 'GET', {}, function(data) {
                $('div#contenedor_general').html(data);
            })
        })

        $(`div#panel_descri_tarjeta_${id_tarjeta}`).html(data);

    });
}
