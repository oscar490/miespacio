<?php
/* Búsqueda de tableros */

/* @var $search app\models\TablerosSearch */
use yii\helpers\Html;
use yii\helpers\Url;

$css = <<<EOT
    #result_search {

    }

    #img_search > img{
        width: 150px;
        height: 150px;
    }
EOT;

$url_search = Url::to(['tableros/search']);

$js = <<<EOT
    $(document).ready(function() {
        let input = $('#search_tablero').find('#denominacion');
        input.on('keyup', function() {

            datos = {
                denominacion: $(this).val()
            };

            sendAjax('$url_search', 'GET', datos, function(data) {
                $("#result_search").html(data);
            })
        })
    })

EOT;
$this->registerJs($js);

$this->registerCss($css);
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
<div id='result_search' >
    <p>
        <strong class='centrado'>
            Busca tus tableros creados desde aqui, para tener un acceso rápido a ellos.
        </strong>
    </p>

    <div id='img_search' class='centrado'>
        <?= Html::img(
            'images/search.png',
            ['alt'=>'img_search']
        ) ?>
    </div>
</div>
