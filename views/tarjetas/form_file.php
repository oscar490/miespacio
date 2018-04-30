<?php
/* Subida de archivos */

/* @var $model app\models\Adjuntos */
/* @var $tarjeta app\models\Tarjetas */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

$url_upload = Url::to(['adjuntos/upload-file', 'id_tarjeta'=>$tarjeta->id]);

$this->registerJsFile(
    '/js/adjunto.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$js = <<<EOT
    $(document).ready(function() {
        let form_file = $('#form_file_$tarjeta->id');

        subirArchivo('$url_upload', form_file, '$tarjeta->id');
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
