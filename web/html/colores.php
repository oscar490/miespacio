<?php

    $user_name = $_GET['user_name'];
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta charset="utf-8">
        <title>
            Colores
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="/css/colores.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {

                $('button').on('click', function() {
                    let color = $(this).data('color');
                    let tableros = window.opener.$("div[id='tablero']");
                    let otros = window.opener.$("div[class='panel-primary']");
                    let navBar = window.opener.$(".navbar-inverse");
                    let footer = window.opener.$(".footer");
                    let label = window.opener.$(".label-primary");
                    let migas = window.opener.$("ul.breadcrumb li > a");

                    console.log(opener.document);

                    tableros.css('backgroundColor', color);
                    tableros.css('borderColor', color);
                    tableros.parent().css('borderColor', color);
                    changeColorElem(navBar, color);
                    changeColorElem(footer, color);
                    changeColorElem(label, color);
                    migas.css('color', color);



                    window.localStorage.setItem('<?= $user_name ?>', color);

                });

            })

            function changeColorElem(elem, color) {
                elem.css({
                    'backgroundColor': color,
                    'borderColor': color,
                });
            }


        </script>
    </head>

    <body>
        <div class='container'>
            <div class='row'>
                <div class='col-xs-12 col-md-6'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            Seleccionar un color de estilo
                        </div>

                        <div class='panel-body'>
                            <button type="button" class='btn btn-success btn-block'
                                data-color="#5cb85c">
                                Estilo 1
                            </button>
                            <hr>

                            <button type="button" class='btn btn-primary btn-block'
                                data-color="#0266a0">
                                Estilo 2
                            </button>
                            <hr>

                            <button type="button" class='btn btn-info btn-block'
                                data-color="#31b0d5">
                                Estilo 3
                            </button>
                            <hr>

                            <button type="button" class='btn btn-warning btn-block'
                                data-color="#f0ad4e">
                                Estilo 4
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>
