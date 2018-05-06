
function addEventKey(input, url_search, id_equipo, form) {
    form.on('submit', function() {
        return false;
    });

    input.on('keyup', function() {
        datos = {
            nombre: input.val(),
            id_equipo: id_equipo,
        };
        cadena = $.trim(input.val());

            sendAjax(url_search, 'GET', datos, function (data) {
                
                    $("#content_miembros").html(data);

            });

    })
}
