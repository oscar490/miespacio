<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar sesión';

?>

<div class="site-login">

    <!-- Título principal -->
    <div class='row'>
        <div class='col-md-7 col-md-offset-1'>
            <h2>
                <strong>
                    <?= Html::encode($this->title) ?>
                </strong>
            </h2>
        </div>
    </div>
    <br>
    <!-- Formulario de inicio de sesión -->
    <div class='row'>
        <div class='col-md-10 col-md-offset-1'>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'action'=>['site/login'],
            ]); ?>

                <!-- Nombre de usuario -->
                <?= $form->field($model, 'username')->textInput([
                    'placeholder'=>'p. ej.: alberto',
                ]) ?>

                <!-- Contraseña -->
                <?= $form->field($model, 'password')->passwordInput([
                    'placeholder'=>'p. ej.: ·········',
                ]) ?>

                <!-- Enlace para recuperación de contraseña -->
                <?= Html::a(
                    '¿Has olvidado la contraseña?',
                    ['site/solicitar-clave'])
                ?>

                <!-- Recordar la sesión -->
                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <!-- Botón de envio de formulario -->
                <?= Html::submitButton('Iniciar sesión', [
                    'class' => 'btn btn-primary btn-block',
                    'name' => 'login-button'
                ]) ?>


            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
