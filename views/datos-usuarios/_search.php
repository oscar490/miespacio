<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DatosUsuariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="datos-usuarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre_completo') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'registro') ?>

    <?= $form->field($model, 'ultimo_acceso') ?>

    <?php // echo $form->field($model, 'iniciales') ?>

    <?php // echo $form->field($model, 'usuario_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
