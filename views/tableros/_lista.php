<?php
/* Vista de una Lista */

/* @var $lista app\models\Listas */
/* @var $tarjeta app\models\Tarjetas */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\helpers\Url;

$this->registerJsFile(
    '/js/jquery-ui/jquery-ui.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '/js/lista.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
    '/css/lista.css'
);


$url_update = Url::to(['tarjetas/update-lista']);

$js = <<<EOT
    $(document).ready(function() {
        let selector = $("#form_create_tarjeta_$lista->id").parent()
            .find('.panel-heading');

        efectoSortable('$url_update');
        iteracionFormTarjeta(selector);
    })
EOT;

$this->registerJs($js);

?>

<!-- Contenido de la Lista -->
<div class='col-md-4'>
    <div id="contenedor_lista_<?= $lista->id ?>" class='panel panel-default'>
        <!-- Título de la lista -->
        <div class='panel-heading'>
            <div class='row'>
                <div class='col-md-11'>
                    <strong>
                        <?=
                            MyHelpers::icon('glyphicon glyphicon-th-list') . ' ' .
                            Html::encode($lista->denominacion)
                        ?>
                    </strong>
                    <small>
                        (click aquí para crear tarjeta)
                    </small>
                </div>
                <div class='col-md-1'>

                </div>
            </div>
        </div>

        <!-- Conjunto de tarjetas de la lista -->
        <div class='panel-body'>
            <?= $this->render('lista_de_tarjetas', [
                'lista' => $lista,
                'adjunto'=>$adjunto,
            ]) ?>
        </div>

        <!-- Formulario para crear lista -->
        <div id="form_create_tarjeta_<?= $lista->id ?>" class='panel-footer'>
            <?= $this->render('/tarjetas/create', [
                'model'=>$tarjeta,
                'lista'=>$lista,
            ]) ?>
        </div>
    </div>
</div>
