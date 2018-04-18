$(document).ready(function() {

    $('.tablero').hover(
        function() {
            $(this).fadeTo(500, 0.80);

        }, function() {
            $(this).fadeTo(100, 1);
        }
    )
})
