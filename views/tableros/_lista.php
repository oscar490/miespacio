<?php
/* Vista de una Lista */

/* @var $lista app\models\Listas */
/* @var $tarjeta app\models\Tarjetas */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\helpers\Url;

echo MyHelpers::alert('Información');

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
$url_content = Url::to(['tableros/render-contenido', 'id'=>$lista->tablero->id]);

$js = <<<EOT
    $(document).ready(function() {
        let selector = $("#form_create_tarjeta_$lista->id").parent()
            .find('#header_lista_titulo');

        efectoSortable('$url_update', '$url_content');
        iteracionFormTarjeta(selector);
    })
EOT;

$this->registerJs($js);

?>


<div class='col-md-4'>
    <div id="contenedor_lista_<?= $lista->id ?>" class='panel panel-default'>
        <!-- Título de la lista -->
        <div id="header_lista_titulo" class='panel-heading'>
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

        <!-- Formulario para crear tarjeta -->
        <div id="form_create_tarjeta_<?= $lista->id ?>" class='panel-footer'>
            <?= $this->render('/tarjetas/create', [
                'model'=>$tarjeta,
                'lista'=>$lista,
            ]) ?>
        </div>
    </div>
</div>
