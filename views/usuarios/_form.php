<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */

?>

    <?php $form = ActiveForm::begin(['id'=>'registro']); ?>

        <div class='row'>
            <div class='col-md-4 col-md-offset-4'>
                <?= $form->field($model, 'nombre')->textInput([
                    'maxlength' => true,
                    'placeholder'=>'p.ej.: manuel',
                ]) ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-4 col-md-offset-4'>
                <?= $form->field($model, 'password')->passwordInput([
                    'maxlength' => true,
                    'placeholder'=>'p. ej.: ··········',
                ]) ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-4 col-md-offset-4'>
                <?= $form->field($model, 'password_repeat')->passwordInput([
                    'maxlength' => true,
                    'placeholder'=>'p. ej.: ··········',
                ]) ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-4 col-md-offset-4'>
                <?= $form->field($model, 'email')->textInput([
                    'maxlength' => true,
                    'placeholder'=>'p. ej.: manuel@gmail.com',
                ]) ?>
            </div>
        </div>


        <div class="form-group">
            <div class='col-md-4 col-md-offset-4'>
                <?= Html::submitButton('Crear una cuenta nueva', [
                    'class' => 'btn btn-success btn-block',
                    'id'=>'envio',
                    // 'disabled'=>true,
                ]) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
