

function iteracionMain(id_tarjeta) {
    $(`#header_form_adjunto_${id_tarjeta}`).on('click', function() {
        $(this).next().slideToggle();
    })

    $(`#header_descri_tarjeta_${id_tarjeta}`).on('click', function() {
        $(this).next().next().slideToggle();
    })
}
