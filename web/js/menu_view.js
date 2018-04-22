$(document).ready(function() {

    $('div#header_menu').on('click', function() {
        $(this).next().slideToggle();
    })

    $('#form_lista').on('beforeSubmit', function() {
        let form = $(this);
        let contenedor = $('div#container_listas');

        if (form.find('.has-error').length) {
            return false;
        }

        sendAjaxRenderizar(url_create, 'POST', form, contenedor);

        return false;
    })

})
