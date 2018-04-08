$(document).ready(function() {
    let input_imagen = $('#imagen_equipo');
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
    $('#form_imagen').on('submit', function(e) {
        console.log(enviar);
        e.preventDefault();
        if (enviar && (!en_proceso)) {
            en_proceso = true;
            $.ajax({
                url: direccion_url,
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


    })
})