<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<!-- Información -->
<div class='row'>
    <div class='col-md-6 col-md-offset-3'>
        <?=
            Html::tag(
                'p',
                'Envíe su dirección de correo electrónico y le reenviaremos
                 un enlace para restablecer su contraseña'
            );
        ?>
    </div>
</div>
<br>

<!-- Formulario de recuperación de contraseña -->
<div class='row'>
    <div class='col-md-6 col-md-offset-3'>

        <?php $form = ActiveForm::begin([
            'method'=>'get',
        ]) ?>

            <!-- Dirección de correo electrónico -->
            <?= $form->field($model, 'email') ?>

            <!-- Botón de envio de formulario -->
            <?= Html::submitButton('Enviar', ['class'=>'btn btn-success']) ?>

        <?php ActiveForm::end() ?>
    </div>
</div>
