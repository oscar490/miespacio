<?php
/* Crear un nuevo adjunto */

/* @var $this yii\web\View */
/* @var $model app\models\Adjuntos */
/* @var $tarjeta app\models\Tarjetas */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

$url_create_adjunto = Url::to(['adjuntos/create']);

$this->registerJsFile(
    '/js/adjunto.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$js = <<<EOT
    $(document).ready(function() {
        let form_adjunto = $("#form_adjunto_create_$tarjeta->id");
        createAdjunto(form_adjunto, '$url_create_adjunto', '$tarjeta->id');
    })
EOT;

$this->registerJs($js);
?>
<div class='panel panel-default'>
    <div id='header_form_adjunto_<?= $tarjeta->id ?>'class='panel-heading'>
        <strong>
            <?=
                MyHelpers::icon('glyphicon glyphicon-link') .
                ' ' . 'Adjuntar un enlace'
            ?>
        </strong>
        <small>(click aquí)</small>
    </div>
    <div class='panel-body'>
        <?= $this->render('_form', [
            'model' => $model,
            'tarjeta'=>$tarjeta,
            'action'=>['adjuntos/validate-ajax'],
            'id_form'=>"form_adjunto_create_$tarjeta->id",
        ]) ?>
    </div>
</div>
