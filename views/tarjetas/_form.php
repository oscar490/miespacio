<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tarjetas-form">

    <?php $form = ActiveForm::begin([
        'action'=>['tarjetas/create'],
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'denominacion', ['enableAjaxValidation' => true,])
        ->textInput(['maxlength' => true]) ?>

    <?= Html::hiddenInput('tablero_id', $tablero->id) ?>

    <div class="form-group">
        <?= Html::submitButton('Crear', [
            'class' => 'btn btn-success btn-block'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
