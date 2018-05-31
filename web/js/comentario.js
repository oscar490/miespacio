
/**
 * Elimina un comentario por AJAX.
 * @param  {[string]} url_delete    Dirección URL para eliminar el comentario.
 * @param  {[integer]} id_comentario ID del Comentario.
 * @return {[type]}               [description]
 */
function deleteComentario(url_delete, id_comentario, id_tarjeta, elem_btn, url_render) {

    eliminarElemento(elem_btn, url_delete, function(data) {
        $(`span#${id_tarjeta}`).text(data);


        if (data == 0) {
            sendAjax(url_render, 'GET', {}, function(data) {
                $(`#container_comentarios_${id_tarjeta}`).html(data);
            })
        } else {
            $(`div[data-key='${id_comentario}']`).fadeOut('slow');
        }
    });
}
