
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

        jQuery.noticeAdd({
            text: mensaje,
            stay: false,
            type: 'notice'
        });



    })
}

function changeVisible(id_tablero, url_send, boton) {

    sendAjax(url_send, 'POST', {}, function(data) {
        let nombre = ' Público';
        let icon = 'glyphicon glyphicon-globe';

        if (data == 2) {
            nombre = ' Privado';
            icon = 'glyphicon glyphicon-lock';
        }

        
        let elem_span = $('<span></span>');
        elem_span.addClass(icon);

        boton.children('span').replaceWith(elem_span);

    })
}
