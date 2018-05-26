
/**
 * Cambiar la imágen una vez que se carga el documento.
 * @param  {[type]} tipo_adjunto  ID de Tipo de adjunto.
 * @param  {[type]} id_adjunto    ID de Adjunto.
 * @param  {[type]} url_direccion Dirección URL del Adjunto.
 */
function cambiarImagenAdjunto(tipo_adjunto, id_adjunto, url_direccion) {
    let src = '';

    switch(tipo_adjunto) {
        case '1' :
            src = url_direccion;
            break;

        case '2' :
            src = 'images/archivo.png';
            break;

        case '3' :
            src = 'images/enlace.png';
            break;

        default:
            src = 'images/archivo.png';
            break;
    };

    $(`#content_img_${id_adjunto} > img`).attr('src', src);
}
/**
 * Crea un nuevo adjunto por AJAX y renderiza el Formulario
 * de subida de archivos.
 * @param  {[type]} form_p     Formulario a validar.
 * @param  {[type]} url_send   Dirección URL para la petición.
 * @param  {[type]} id_tarjeta ID de la tarjeta.
 * @return {[type]}            [description]
 */
function createAdjunto(form_p, url_send, id_tarjeta, url_render) {

    validarForm(form_p, url_send, 'POST', function(data) {
        $(`div#lista_adjuntos_${id_tarjeta}`).html(data);

        addScroll($(`div#lista_adjuntos_${id_tarjeta}`));

        sendAjax(url_render, 'GET', {}, function (data) {
            $(`#div_form_enlace_${id_tarjeta}`).html(data);
        })

    });
}

/**
 * Sube un archivo a la aplicación. Una vez subida, renderiza el Formulario
 * de subida de archivos.
 * @param  {[type]} url_send   Dirección URL donde se envia el archivo.
 * @param  {[type]} form_p     Formulario de subida archivos.
 * @param  {[type]} id_tarjeta ID de tarjeta.
 * @param  {[type]} url_render Dirección URL para renderizar.
 */
function subirArchivo(url_send, form_p, id_tarjeta, url_render) {

    form_p.on('beforeSubmit', function(e) {

        if ($(this).find('.has-error').length) {
            return false;
        }

        $(this).find('button').attr('disabled', 'trie');

        $.ajax({
            url: url_send,
            type: 'POST',
            enctype: 'multipart/form-data',
            data: new FormData(this),
            success: function(data) {

                if (data) {
                    let contenedor_adjuntos = $(`div#lista_adjuntos_${id_tarjeta}`);
                    contenedor_adjuntos.html(data);
                    addScroll(contenedor_adjuntos);
                } else {
                    growl_error('ya existe ese archivo adjuntado en la tarjeta.');
                }

                sendAjax(url_render, 'POST', {}, function (data) {
                    $(`div#div_form_file_${id_tarjeta}`).html(data);
                });

            },
            beforeSend: function() {
                let imagen = $(`div#img_form_file_${id_tarjeta}`).find('img');
                imagen.attr('src', 'images/cargando.gif');

            },
            dataType: 'json',
            contentType: false,
            processData: false,
        });


        return false;
    })
}

function addScroll(elem_contenedor) {
    let num_adjuntos = elem_contenedor.find("div[data-key]").length;

    if (num_adjuntos > 2 && !elem_contenedor.hasClass('content-scroll')) {
        elem_contenedor.addClass('content-scroll');
    }
}
