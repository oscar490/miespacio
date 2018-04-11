<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tarjetas-form">

    <?php $form = ActiveForm::begin([
        'action'=>['tarjetas/create'],
        'enableAjaxValidation' => true,
        'id'=>'create_tarjeta',
    ]); ?>

    <?= $form->field($model, 'denominacion', ['enableAjaxValidation' => true,])
        ->textInput(['maxlength' => true]) ?>

    <?= Html::hiddenInput('tablero_id', $tablero->id) ?>

    <div class="form-group">
        <?= MyHelpers::submit('Crear', ['id'=>'btn_tarjeta']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
