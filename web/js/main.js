
/**
 * Indica si hay notificaciones pendientes.
 * @param  integer num_notificaciones Número de notificaciones.
 * @param  {[type]} url_send           Direccion URL para enviar peticiíon.
 */
function indicarNotificaciones(num_notificaciones, url_send) {

    let enlace = $("a[data-target='#modal_notificaciones']");
    let num = $(`<span>${num_notificaciones}</span>`);

    if (num_notificaciones > 0) {

        enlace.addClass('aviso');
        num.addClass('badge');
        enlace.append(num);

        eventoModal(url_send);

    } else {
        enlace.removeClass('aviso');
        enlace.find('.badge').remove();
    }

}

/**
 * Cuando se abre el modal, se envia una petición para marcar como leido
 * las notificaciones pendientes.
 * @param  {[type]} url_send [description]
 * @return {[type]}          [description]
 */
function eventoModal(url_send) {
    $('#modal_notificaciones').on('show.bs.modal', function() {
        sendAjax(url_send, 'GET', {}, function(data) {
            indicarNotificaciones(data);
        })
    })
}

/**
 * Se encarga de iniciar la gestión de ventanas para establecer estilo de web.
 * @param  {[type]} p_width   Anchura de ventana.
 * @param  {[type]} p_height  Altura de ventana.
 * @param  {[type]} p_top     Altura de ventana.
 * @param  {[type]} user_name Nombre de usuario logueado.
 */
function iniciarGestionVentanas(p_width, p_height, p_top, user_name) {

    $('#ventana_estilos').on('click', function() {
        let v_left = (screen.width/2) - (p_width/2);
        let v_right = (screen.height/2) - (p_height/2);

        let ventana = window.open(
            `../html/colores.php?user_name=${user_name}`,
            'Colores',
            `width=${p_width}px, height=${p_height}px, left=${v_left},
                right=${v_right}, top=${p_top}px`
        );
    })
}
