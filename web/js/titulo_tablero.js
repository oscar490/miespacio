


function addEventBoton(id_tablero, es_favorito) {
    var boton_favorito = $(`#btn_favorite_${id_tablero}`);

    if (es_favorito) {
        console.log('entra');
        boton_favorito.css({color: "#f2d600"});

    } else {
        console.log('aqui');
        boton_favorito.hover(
            function() {
                $(this).css({color: "#f2d600"});

            }, function() {
                $(this).css({color: "black"});
            }
        )

    }

}

function addFavorito(id_tablero, id_usuario, url_send) {

    datos = {
        usuario_id: id_usuario,
        tablero_id: id_tablero
    };
    
    sendAjax(url_send, 'POST', datos, function(data) {
        addEventBoton(id_tablero, data);
    })
}
