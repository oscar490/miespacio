
function indicarNotificaciones(num_notificaciones, url_send) {

    let enlace = $("a[data-target='#modal_notificaciones']");
    let num = $(`<span>${num_notificaciones}</span>`);

    if (num_notificaciones > 0) {

        enlace.css('backgroundColor','red');
        num.addClass('badge');
        enlace.append(num);

        eventoModal(url_send);

    } else {
        enlace.css('backgroundColor','#0266a0');
        enlace.find('.badge').remove();
    }


}

function eventoModal(url_send) {
    $('#modal_notificaciones').on('show.bs.modal', function() {
        sendAjax(url_send, 'GET', {}, function(data) {
            indicarNotificaciones(data);
        })
    })
}
