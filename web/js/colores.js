$(document).ready(function() {

    $('button').on('click', function() {
        let color = $(this).data('color');
        let tableros = window.opener.$("div[id='tablero']");
        let otros = window.opener.$("div[class='panel-primary']");

        tableros.css('backgroundColor', color);
        tableros.css('borderColor', color);
        tableros.parent().css('borderColor', color);

        window.localStorage.setItem('estilo', color);

    });


})
