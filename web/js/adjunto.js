
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

    })
}
