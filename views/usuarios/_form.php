<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>


        <?php $form = ActiveForm::begin(); ?>

        <div class='row'>
            <div class='col-md-4'>
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-4'>
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
            </div>
        </div>

        <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
