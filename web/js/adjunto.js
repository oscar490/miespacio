
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

function subirArchivo(url_send, form_p, id_tarjeta, url_render) {

    let enviando = false;

    form_p.on('beforeSubmit', function(e) {

        if ($(this).find('.has-error').length) {
            return false;
        }

        if (!enviando) {
            enviando = true;
            
            $.ajax({
                url: url_send,
                type: 'POST',
                enctype: 'multipart/form-data',
                data: new FormData(this),
                success: function(data) {
                    $(`div#lista_adjuntos_${id_tarjeta}`).html(data);

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
        }

        return false;
    })
}
