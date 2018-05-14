<?php
/* Búsqueda de tableros */

/* @var $search app\models\TablerosSearch */
use yii\helpers\Html;
use yii\helpers\Url;



$this->registerCssFile(
    'css/search_tablero.css'
);


$url_search = Url::to(['tableros/search']);

$js = <<<EOT
    $(document).ready(function() {
        let input = $('#search_tablero').find('#denominacion');
        input.on('keyup', function() {

            datos = {
                denominacion: $(this).val()
            };

            sendAjax('$url_search', 'GET', datos, function(data) {
                let content_resultado = $("#result_search");
                content_resultado.html(data);

                if (content_resultado.find('form').length == 1) {
                    content_resultado.removeClass('content-scroll');
                    content_resultado.css('height', '200px');

                } else {
                    content_resultado.addClass('content-scroll');
                    content_resultado.css('height', '300px');
                }
            })
        })
    })

EOT;
$this->registerJs($js);

?>


<!-- Formulario de búsqueda de un tablero -->
<div class='row'>
    <div class='col-md-4 col-md-offset-4'>
        <?= $this->render('/tableros/form_search', [
            'search'=> $search,
        ]) ?>
    </div>
</div>

<br>

<!-- Contenido resultante de búsqueda -->
<div id='result_search'>
    <p>
        <strong class='centrado'>
            Busca tus tableros creados desde aqui, para tener un acceso rápido a ellos.
            En el caso de que no exista el tablero buscado, se podrá crear como nuevo
            desde esta sección.
        </strong>
    </p>

    <div id='img_search' class='centrado'>
        <br>
        <?= Html::img(
            'images/search.png',
            ['alt'=>'img_search']
        ) ?>
    </div>
</div>
