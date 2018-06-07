<?php
/* Vista del contenido de una tarjeta */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\components\MyHelpers;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */


$url_adjunto = Url::to(['adjuntos/create-ajax']);

$this->registerCssFile(
    'css/view_tarjeta.css'
);

$js = <<<EOT
    $(document).ready(function() {
        $(`#header_form_adjunto_$model->id`).on('click', function() {
            $(this).next().slideToggle();
        })
    })
EOT;
$this->registerJs($js);

if ($model->contieneMapa) {
    $label = 'Ver adjunto de ubicación';
    $url = ['mapas/update', 'id_tarjeta'=>$model->id];

} else {
    $label = 'Añadir nuevo adjunto de ubicación';
    $url = ['mapas/create', 'id_tarjeta'=>$model->id];
}
?>

<!-- Título y descripción de la tarjeta -->
<div id="panel_descri_tarjeta_<?= $model->id ?>">
    <?= $this->render('descripcion_tarjeta', [
        'tarjeta'=>$model
    ]) ?>
</div>

<!-- Resto de contendo -->
<div class='row'>
    <div class='col-md-8'>

        <!-- Lista de adjuntos de la tarjeta -->
        <?= $this->render('adjuntos_tarjeta',[
            'model'=>$model,
        ]) ?>

        <!-- Adjuntar una ubicación -->
        <div class='row'>
            <div class='col-md-6'>
                <?=
                    Html::a(
                        MyHelpers::icon('glyphicon glyphicon-map-marker')
                            . ' ' . "<strong>$label</strong>",
                        $url,
                        ['class'=>'btn btn-default']
                    )
                ?>
            </div>
        </div>
    </div>

    <!-- Formulario de adjuntar -->
    <div class='col-md-4'>

        <!-- Enlace -->
        <div id='div_form_enlace_<?= $model->id ?>'>
            <?= $this->render('/adjuntos/create', [
                'model'=>$adjunto,
                'tarjeta'=>$model
            ]) ?>
        </div>

        <!-- Archivo -->
        <div id='div_form_file_<?= $model->id ?>'>
            <?= $this->render('form_file', [
                'model'=>$adjunto,
                'tarjeta'=>$model,
            ]) ?>
        </div>
    </div>
</div>
