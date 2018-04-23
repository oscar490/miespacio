$(document).ready(function() {

    $('div#header_menu').on('click', function() {
        $(this).next().slideToggle();
    })

    $('#form_lista').on('beforeSubmit', function() {
        let form = $(this);
        let contenedor = $('div#contenedor_general');

        if (form.find('.has-error').length) {
            return false;
        }

        sendAjaxRenderizar(url_create, 'POST', form, contenedor);

        let input = form.find('input#denominacion');

        input.val('');
        input.parent().removeClass('has-success');

        return false;
    })

})
