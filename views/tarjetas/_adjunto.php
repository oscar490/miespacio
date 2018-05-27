<?php

/* Vista de un adjunto */

/* @var $model app\models\Adjuntos */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\popover\PopoverX;
use app\components\MyHelpers;

$this->registerJsFile(
    '/js/adjunto.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
    '/css/adjunto.css'
);

$url_adjunto = Url::to(['adjuntos/delete', 'id'=>$model->id]);
$tipo = $model->tipo;
$js = <<<EOT

    $(document).ready(function() {
        cambiarImagenAdjunto('$tipo->id', '$model->id',
            '$model->url_direccion');
    })

EOT;
$this->registerJs($js);

?>

<!-- Adjunto -->
<div class='row'>

    <!-- Imágen y nombre del adjunto -->
    <?= $this->render('elementos_adjunto', [
        'model'=>$model
    ]) ?>

    <!-- Botones de acción sobre adjunto -->
    <?= $this->render('botones_accion', [
        'model'=>$model,
    ]) ?>

</div>

<!-- Formulario update adjunto -->
<div class='row'>
    <div id="div_update_adjunto_<?= $model->id ?>"
            class='col-md-8 col-md-offset-2'>
        <?=
            $this->render('/adjuntos/update', [
                'model'=>$model,
            ]);
        ?>
    </div>
</div>
<hr>
