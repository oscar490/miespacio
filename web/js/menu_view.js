/** menu_view.js **/

//  Renderización de listas.
var func_success_list_create = function (data) {

    let form = $('#form_lista');
    let input = form.find('input#denominacion');

    $('div#contenedor_general').html(data);

    input.val('');
    input.parent().removeClass('has-success');
    form.parent().hide();

}


/**
 * Muestra ú oculta el menú de creación de lista y el de
 * las propiedades del tablero.
 */
function iteracionMenu() {
    let header_menu = $('div#header_menu');

    header_menu.on('click', function() {
        $(this).next().slideToggle();
    })
}

function recargar_actividades(modal, url_send) {
    modal.on("show.bs.modal", function() {
        sendAjax(url_send, 'GET', {}, function (data) {
            $("#content-actividades").html(data);
        })

    })
}

/**
 * Usando AJAX, crea una lista.
 * @param  {[type]} url_p Dirección URL para realizar la petición.
 */
function createLista(url_p) {

    let form = $('#form_lista');
    let url = url_p;

    //  js/iteracion.js
    validarForm(form, url, 'POST', func_success_list_create);

}
