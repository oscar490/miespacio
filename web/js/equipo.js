
/**
 * Cambia la imagen de equipo pr AJAX. Se valida
 * formulario por JavaScript.
 * @param  {[type]} url_send  Dirección URL para envíar petición.
 * @param  {[type]} id_equipo ID del equipo.
 */
function updateImagen(url_send, id_equipo) {

    let input_imagen = $(`#input_img_${id_equipo}`);
    let enviar = true;
    let mensaje = $('<div></div>');
    let en_proceso = false;
    mensaje.addClass('error');

    $('#btn-imagen').on('click', function() {
        let num_archivos = input_imagen[0].files.length;
        $('.error').remove();

        if (num_archivos != 0) {
            let archivo = input_imagen[0].files[0];
            console.log(archivo);
            if (archivo.type !== 'image/jpeg') {
                enviar = false;
                mensaje.text('Sólo se permite la extensión jpg.');
                $('div.file-input').after(mensaje);

            } else if (archivo.size > 2097152) {
                enviar = false;

                mensaje.text('El tamaño máximo debe ser de 2MB.');
                $('div.file-input').after(mensaje);

            } else {
                enviar = true;
                if (!en_proceso) {
                    $('div#img_equipo > img').attr('src', 'images/cargando.gif');
                }

            }

        } else {
            enviar = false;
            mensaje.text('No hay ningún archivo seleccionado.');
            $('div.file-input').after(mensaje);

        }
    });
    $(`#form_imagen_${id_equipo}`).on('submit', function(e) {

        if (enviar && (!en_proceso)) {
            en_proceso = true;
            $.ajax({
                url: url_send,
                type: 'POST',
                enctype: 'multipart/form-data',
                data: new FormData(this),
                success: function (data) {
                    en_proceso = false;
                    $('div#img_equipo > img').attr('src', data);

                },
                dataType: 'json',
                contentType: false,
                processData: false,
            });
        }
        e.preventDefault();

    })
}
