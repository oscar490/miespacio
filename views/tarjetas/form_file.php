<?php
/* Fromulario de subida de archivos */

/* @var $model app\models\Adjuntos */
/* @var $tarjeta app\models\Tarjetas */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;
use app\models\Adjuntos;

$url_upload = Url::to(['adjuntos/upload-file', 'id_tarjeta'=>$tarjeta->id]);
$url_render_form = Url::to(['tarjetas/render-form-file', 'id'=>$tarjeta->id]);

$this->registerJsFile(
    '/js/adjunto.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$model->scenario = Adjuntos::ESCENARIO_FILE;

$js = <<<EOT
    $(document).ready(function() {
        let form_file = $('#form_file_$tarjeta->id');

        subirArchivo('$url_upload', form_file, '$tarjeta->id',
            '$url_render_form');
    })
EOT;

$this->registerJs($js);

?>

<div class='panel panel-default'>
    <div class='panel-heading'>
        <strong>
            <?=
                MyHelpers::icon('glyphicon glyphicon-open-file')
                . ' ' . 'Adjuntar archivo'
            ?>
        </strong>
    </div>
    <div class='panel-body'>
        <div id='img_form_file_<?= $tarjeta->id ?>' class='centrado'>
            <?= Html::img(
                'images/file.png',
                [
                    'alt'=>'files',
                    'class'=>'logo-x2'
                ]
            ) ?>
        </div>
        <?= $this->render('/site/form_input_file', [
            'model'=>$model,
            'attribute'=>'archivo',
            'showUpload'=>false,
            'showPreview'=>false,
            'action'=>'',
            'id_form'=>"form_file_$tarjeta->id",
            'id_input'=>"input_$tarjeta->id",
            'btn_id'=>"btn_$tarjeta->id",
            'label'=>'Subir archivo'
        ]) ?>
    </div>
</div>
