
function addEventKey(input, url_search, id_equipo) {
    input.on('keyup', function() {

        datos = {
            nombre: $(this).val(),
            id_equipo: id_equipo,
        };
        sendAjax(url_search, 'GET', datos, function (data) {

            $("#content_miembros").html(data);
        })
    })
}
