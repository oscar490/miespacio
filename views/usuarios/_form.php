<?php
/* Formulario de usuario */

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


if ($model->id === null) {
    $label = 'Crear una cuenta nueva';
    $action = ['usuarios/create'];
} else {
    $label = 'Guardar configuración';
    $action = ['usuarios/update', 'id'=>$model->id];
}
?>

<!-- Formulario de registro de usuario nuevo -->
<?php $form = ActiveForm::begin([
    'action'=>$action,
    'enableAjaxValidation' => true,
]); ?>

    <!-- Nombre de usuario -->
    <?= $form->field($model, 'nombre', ['enableAjaxValidation' => true])->textInput([
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
    <?= Html::submitButton($label, [
        'class' => 'btn btn-success btn-block',
        'id'=>'envio',
    ]) ?>

<?php ActiveForm::end(); ?>
