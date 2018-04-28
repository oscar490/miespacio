<?php
/* Vista de tarjeta */

/* @var $tarjeta app\models\Tarjetas */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

$css = <<<EOT
    #item {
        list-style: none;

    }

    .tarjeta {
        background-color: #f5f5f5;
        padding: 10px 15px;
        border-color: #ddd;
        box-shadow: 2px 2px 5px #999;
    }

    div[id^='form_update'] {
        display: none;
    }
EOT;

$this->registerCss($css);

$this->registerJsFile(
    '/js/tarjeta.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$url_delete_tarjeta = Url::to(['tarjetas/delete', 'id'=>$tarjeta->id]);
$js = <<<EOT
    $(document).ready(function() {
        let boton_delete = $("#btn_delete_tarjeta_$tarjeta->id");
        let boton_update = $("#btn_update_tarjeta_$tarjeta->id");
        let url = '$url_delete_tarjeta';

        eliminarTarjeta(boton_delete, url);
    })

EOT;
$this->registerJs($js);


?>
<li id='item' data-key="<?= $tarjeta->id ?>">
    <div class='panel panel-default tarjeta'>
        <div class='row'>
            <!-- Nombre de tarjeta -->
            <div class='col-xs-7 col-md-7'>
                <?= Html::encode($tarjeta->denominacion) ?>
            </div>

            <!-- Contenido de tarjeta -->
            <div class='col-xs-5 col-md-5'>

                <?= $this->render('contenido_tarjeta', [
                    'tarjeta' => $tarjeta,
                    'adjunto' => $adjunto,
                ]) ?>

            </div>
        </div>
        <div id="form_update_<?= $tarjeta->id ?>" class='panel-body'>
            <div class='row'>
                <?= $this->render('/tarjetas/update', [
                    'model'=>$tarjeta,
                ]) ?>
            </div>
        </div>
    </div>

</li>
