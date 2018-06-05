<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mapas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapas-form">

    <?php $form = ActiveForm::begin([
        'action'=>['mapas/create']
    ]); ?>

    <?= $form->field($model, 'ubicacion')->textInput([
        'maxlength' => true,
        'id'=>"pac-input",
        ]) ?>

    <?= $form->field($model, 'latitud')->textInput() ?>

    <?= $form->field($model, 'longitud')->textInput() ?>

    <?= Html::hiddenInput('tarjeta_id', $tarjeta->id) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
