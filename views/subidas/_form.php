<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Subidas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subidas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'adjunto_id')->textInput() ?>

    <?= $form->field($model, 'tarjeta_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
