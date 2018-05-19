
function addEventBoton(id_tablero, es_favorito) {
    var boton_favorito = $(`#btn_favorite_${id_tablero}`);

    if (es_favorito) {
        boton_favorito.css('color',"#f2d600");
    } else {
        boton_favorito.css('color',"black");
    }
}

function addFavorito(id_tablero, id_usuario, url_send) {

    datos = {
        usuario_id: id_usuario,
        tablero_id: id_tablero
    };

    sendAjax(url_send, 'POST', datos, function(data) {
        addEventBoton(id_tablero, data);
        let mensaje = '';

        if (data) {
            mensaje = "Se ha añadido como tablero favorito.";
        } else {
            mensaje = "Se ha borrado como tablero favorito";
        }

        growl_success(mensaje);

    })
}

function changeVisible(id_tablero, url_send, boton) {

    sendAjax(url_send, 'POST', {}, function(data) {

        boton.empty();

        let nombre = $('<span></span>');
        let icono = $('<span></span>');

        let clase = 'glyphicon glyphicon-globe';
        let texto = ' Público';

        if (data == '1') {
            texto = ' Privado';
            clase = 'glyphicon glyphicon-lock';
        }

        nombre.text(texto);
        icono.addClass(clase);

        boton.append(icono, nombre);

        growl_success(`Este tablero es ha establecido como ${texto}`);

    })
}
