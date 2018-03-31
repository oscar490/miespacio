<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<!-- Formulario para restablecer nueva contraseña -->
<div class='row'>
    <div class='col-md-6 col-md-offset-3'>
        <?php $form = ActiveForm::begin() ?>

            <!-- Contraseña -->
            <?= $form->field($model, 'password')->passwordInput() ?>

            <!-- Contraseña a repetir -->
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>

            <!-- Botón de envio de formulario -->
            <?= Html::submitButton('Enviar', ['class'=>'btn btn-success'])?>

        <?php ActiveForm::end() ?>
    </div>
</div>
