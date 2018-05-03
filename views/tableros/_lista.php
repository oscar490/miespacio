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

$url_refrescar = Url::to(['tableros/refrescar', 'id'=>$lista->tablero->id]);
$url_update = Url::to(['tarjetas/update-lista']);
$url_content = Url::to(['tableros/render-contenido', 'id'=>$lista->tablero->id]);

$js = <<<EOT
    $(document).ready(function() {
        let selector = $("#btn_add_tarjeta_$lista->id");

        efectoSortable('$url_update', '$url_content', '$url_refrescar');
        iteracionFormTarjeta(selector, '$lista->id');
    })
EOT;

$this->registerJs($js);

?>

<!-- Lista -->
<div class='col-md-4'>
    <div id="contenedor_lista_<?= $lista->id ?>" class='panel panel-default'>

        <!-- Título de la lista -->
        <div id="header_lista_titulo" class='panel-heading'>
            <div class='row'>

                <!-- Nombre -->
                <div class='col-xs-8 col-md-8'>
                    <strong>
                        <?=
                            MyHelpers::icon('glyphicon glyphicon-th-list') . ' ' .
                            Html::encode($lista->denominacion)
                        ?>
                    </strong>
                </div>

                <!-- Botones de acción sobre lista -->
                <div class='col-xs-4 col-md-4'>
                    <?= $this->render('botones_accion_lista', [
                        'lista' => $lista
                    ]) ?>
                </div>
            </div>
        </div>

        <!-- Update Lista -->
        <div id="lista_update_<?= $lista->id ?>" class='panel-heading'>
            <?= $this->render('/listas/update', [
                'lista'=>$lista
            ]) ?>
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
