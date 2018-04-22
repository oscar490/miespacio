$(document).ready(function() {
    
    $("div#titulo_lista").on('click', function() {
        $(this).parent().find('#form_create').slideToggle();
    })

})
