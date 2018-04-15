<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Adjuntos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adjuntos-form">

    <?php $form = ActiveForm::begin([
        'action'=>$action,
        'enableAjaxValidation'=>true,
    ]); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_direccion', ['enableAjaxValidation'=>true,])->textInput([
        'maxlength' => true,
        'placeholder'=>'Pega un vínculo aqui...'
    ]) ?>

    <?= Html::hiddenInput('tarjeta_id', $tarjeta->id) ?>

    <div class="form-group">
        <?= MyHelpers::submit('Adjuntar', ['class'=>'btn btn-default btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
