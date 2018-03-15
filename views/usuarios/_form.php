<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */

?>

<!-- Formulario de registro de usuario nuevo -->
<div class='row'>
    <div class='col-md-5 col-md-offset-3'>
        <?php $form = ActiveForm::begin(); ?>

            <!-- Nombre de usuario -->
            <?= $form->field($model, 'nombre')->textInput([
                'maxlength' => true,
                'placeholder'=>'p.ej.: manuel',
            ]) ?>

            <!-- Contraseña -->
            <?= $form->field($model, 'password')->passwordInput([
                'maxlength' => true,
                'placeholder'=>'p. ej.: ··········',
            ]) ?>

            <!-- Contraseña confirmar -->
            <?= $form->field($model, 'password_repeat')->passwordInput([
                'maxlength' => true,
                'placeholder'=>'p. ej.: ··········',
            ]) ?>

            <!-- Dirección de correo electrónico -->
            <?= $form->field($model, 'email')->textInput([
                'maxlength' => true,
                'placeholder'=>'p. ej.: manuel@gmail.com',
            ]) ?>

            <!-- Botón de envio de formulario -->
            <?= Html::submitButton('Crear una cuenta nueva', [
                'class' => 'btn btn-success btn-block',
                'id'=>'envio',
            ]) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>
