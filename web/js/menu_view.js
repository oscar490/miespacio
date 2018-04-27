/** menu_view.js **/

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

/**
 * Usando AJAX, crea una lista.
 * @param  {[type]} url_p Dirección URL para realizar la petición.
 */
function createLista(url_p) {

    let form = $('#form_lista');
    let url = url_p;
    let selector = $('div#contenedor_general');
    let input = form.find('input#denominacion');

    validarForm(form, url, 'POST', selector, input);

}
