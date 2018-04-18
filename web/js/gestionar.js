

$(document).ready(function() {

    let form = $('#form_create_equipo');

    $('#btn_create_equipo').on('click', function() {
        form.fadeToggle();
    });

    $('#tablero').parent().hover(
        function() {
            $(this).fadeTo(100, 0.80);
        },
        function() {
            $(this).fadeTo(100, 1);
        }
    );

})
