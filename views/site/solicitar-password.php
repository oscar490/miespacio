<?php
/* Formulario para correo electrónico donde enviar el correo
   de recuperación de contraseña */

/* @var $model app\models\Usuarios */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<!-- Información -->
<?=
    Html::tag(
        'p',
        'Envíe su dirección de correo electrónico y le reenviaremos
         un enlace para restablecer su contraseña ' .
         Html::a('ó iniciar sesión', ['site/login'])
    );
?>

<br>

<!-- Formulario de recuperación de contraseña -->
<?php $form = ActiveForm::begin([
    'method'=>'get',
]) ?>

    <!-- Dirección de correo electrónico -->
    <?= $form->field($model, 'email') ?>

    <!-- Botón de envio de formulario -->
    <?= Html::submitButton('Enviar', [
        'class'=>'btn btn-success btn-block'
    ]) ?>

<?php ActiveForm::end() ?>
