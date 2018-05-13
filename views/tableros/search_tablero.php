<?php
/* Búsqueda de tableros */

/* @var $search app\models\TablerosSearch */
use yii\helpers\Html;

$css = <<<EOT
    #result_search {
        height: 200px;
    }

    #img_search > img{
        width: 150px;
        height: 150px;
    }
EOT;

$js = <<<EOT
    $(document).ready(function() {
        let input = $('#search_tablero').find('#denominacion');
        input.on('keyup', function() {
            console.log($(this).val());
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

<div class='row'>
    <div class='col-md-8 col-md-offset-2'>
            <div id='result_search' >
                <p>
                    <strong class='centrado'>
                        Busca tus tableros creados desde aqui, para tener un acceso rápido a él.
                    </strong>
                </p>

                <div id='img_search' class='centrado'>
                    <?= Html::img(
                        'images/search.png',
                        ['alt'=>'img_search']
                    ) ?>
                </div>
            </div>

        </div>
    </div>
</div>
