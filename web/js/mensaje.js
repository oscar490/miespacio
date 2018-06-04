
function avisoMensajes(num_mensajes) {
    let item_mensajes = $('a#index_mensajes').parent();

    if (num_mensajes > 0) {
        item_mensajes.removeClass('active');
        item_mensajes.addClass('aviso');

    } else {
        item_mensajes.removeClass('aviso');
        item_mensajes.addClass('active');
    }
}
