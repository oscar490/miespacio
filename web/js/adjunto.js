
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
            src = 'images/adjunto.png';
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
 * Crea un nuevo adjunto por AJAX.
 * @param  {[type]} form_p     Formulario a validar.
 * @param  {[type]} url_send   Dirección URL para la petición.
 * @param  {[type]} id_tarjeta ID de la tarjeta.
 * @return {[type]}            [description]
 */
function createAdjunto(form_p, url_send, id_tarjeta) {

    validarForm(form_p, url_send, 'POST', function(data) {
        $(`div#lista_adjuntos_${id_tarjeta}`).html(data);
        let divs_form = form_p.find('div.has-success');

        divs_form.removeClass('has-success');
        divs_form.find('input').val('');
        form_p.closest('.panel-body').hide();

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

    let enviando = false;

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

                let contenedor_adjuntos = $(`div#lista_adjuntos_${id_tarjeta}`);
                contenedor_adjuntos.html(data);
                let num_adjuntos = contenedor_adjuntos.find("div[data-key]").length;
                console.log(num_adjuntos);
                if (num_adjuntos > 2 && !contenedor_adjuntos.hasClass('content-scroll')) {
                    contenedor_adjuntos.addClass('content-scroll');
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
