<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

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
<?php $form = ActiveForm::begin([
    'method'=>'get',
]) ?>

    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <?= $form->field($model, 'email') ?>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <?= Html::submitButton('Enviar', ['class'=>'btn btn-success']) ?>
        </div>
    </div>


<?php ActiveForm::end() ?>
