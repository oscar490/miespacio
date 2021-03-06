
/**
 * Por medio del efecto Sortable de Jquery-ui, cambia la lista
 * a la que pertenece la tarjeta.
 * @param  {[type]} url_tarjeta [description]
 * @return {[type]}             [description]
 */
function efectoSortable(url_tarjeta, url_render) {

    $("ul[id^='lista_']").sortable({
        connectWith: ".contenedor",
        revert: true,
        receive: function (event, ui) {
            let elem = ui.item;
            updateLista(elem, url_tarjeta, url_render);
        }
    })
}

/**
 * Modifica la lista a la que pertenece la tarjeta. Si ya existe
 * una tarjeta con el mismo nombre en la lista, se notifica por un
 * mensaje.
 * @param  {[type]} elem       [description]
 * @param  {[type]} url_envio  [description]
 * @param  {[type]} url_render [description]
 * @return {[type]}            [description]
 */
function updateLista(elem, url_envio, url_render, url_refrescar) {

    let id_tarjeta_p = elem.data('key');
    let id_lista = elem.parent().data('key')
    let primero = elem.parent().find('li').first();
    primero.before(elem);

    let url = url_envio + '&id_tarjeta=' + id_tarjeta_p;
    let data = {lista_id: id_lista};

    $(`button[data-target='#modal_view_tarjeta_${id_tarjeta_p}']`)
            .attr('disabled', true);

    sendAjax(url, 'POST', data, function (data) {

        sendAjax(url_render, 'GET', {}, function(data) {
            $('div#contenedor_general').html(data);
        });

        if (!data) {
            krajeeDialog.alert(
                "Ya existe una tarjeta con ese nombre"
            );
        }

    });
}

function iteracionFormTarjeta(selector, id_tarjeta) {

    selector.on('click', function() {
        $(`#form_create_tarjeta_${id_tarjeta}`).slideToggle();
    })
}
