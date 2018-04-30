<?php

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

$this->registerJsFile(
    '/js/view_tarjeta.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
    'css/view_tarjeta.css'
);

$js = <<<EOT
    $(document).ready(function() {
        iteracionMain('$model->id');
    })
EOT;
$this->registerJs($js);
?>
<!-- Título de la tarjeta -->
<div class='row'>
    <div class='col-md-9 titulo'>
        <h4>
            <strong>
                <?= Html::encode($model->denominacion) ?>
            </strong>
            <small>
                en lista
                <?=
                    Html::encode($model->lista->denominacion)
                ?>
            </small>
        </h4>
    </div>
</div>

<div class='row'>
    <!-- Descripción de la tarjeta -->
    <div class='col-md-8'>
        <?= $this->render('descripcion_tarjeta', [
            'tarjeta'=>$model
        ]) ?>

        <!-- Lista de adjuntos de la tarjeta -->
        <?= $this->render('adjuntos_tarjeta',[
            'model'=>$model,
        ]) ?>
    </div>

    <!-- Formulario de adjuntar -->
    <div class='col-md-4'>
        <!-- Enlace -->
        <?= $this->render('/adjuntos/create', [
            'model'=>$adjunto,
            'tarjeta'=>$model
        ]) ?>

        <!-- Archivo -->
        <?= $this->render('form_file', [
            'model'=>$adjunto,
            'tarjeta'=>$model,
        ]) ?>
    </div>
</div>
