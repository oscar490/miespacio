
/**
 * Por medio del efecto Sortable de Jquery-ui, cambia la lista
 * a la que pertenece la tarjeta.
 * @param  {[type]} url_tarjeta [description]
 * @return {[type]}             [description]
 */
function efectoSortable(url_tarjeta) {

    $("ul[id^='lista_']").sortable({
        connectWith: ".contenedor",
        revert: true,
        receive: function (event, ui) {
            let elem = ui.item;
            updateLista(elem, url_tarjeta);
        }
    })
}

function updateLista(elem, url_envio) {

    let id_tarjeta_p = elem.data('key');
    let id_lista = elem.parent().data('key')
    let primero = elem.parent().find('li').first();
    primero.before(elem);

    let url = url_envio + '&id_tarjeta=' + id_tarjeta_p;
    let data = {lista_id: id_lista};

    sendAjax(url, 'POST', data);
}

function iteracionFormTarjeta(selector) {

    selector.on('click', function() {
        $(this).parent().find('div.panel-footer').slideToggle();
    })
}
