

function iteracionMain(id_tarjeta) {

    $(`#header_form_adjunto_${id_tarjeta}`).on('click', function() {
        $(this).next().slideToggle();
    })

    $(`#panel_descri_tarjeta_${id_tarjeta}`).find('.panel-heading')
        .on('click', function() {
            $(this).parent().find('.panel-footer').slideToggle();
        })
}
