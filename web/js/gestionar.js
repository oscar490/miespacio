

$(document).ready(function() {

    let form = $('#form_create_equipo');

    $('#btn_create_equipo').on('click', function(e) {
        form.fadeToggle();
    });

    // $(document).on('click', function(e) {
    //     var boton = $('#btn_create_equipo');
    //
    //     if (!boton.is(e.target) && boton.has(e.target).length === 0) {
    //         form.fadeOut();
    //     }
    // })
})
