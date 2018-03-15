<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar sesión en MiEspacio';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-login">

    <!-- Título principal -->
    <div class='row'>
        <div class='col-md-3 col-md-offset-4'>
            <h1>
                <strong>
                    <?= Html::encode($this->title) ?>
                </strong>
            </h1>
        </div>
    </div>

    <!-- Formulario de inicio de sesión -->
    <div class='row'>
        <div class='col-md-5 col-md-offset-3'>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
            ]); ?>

                <!-- Nombre de usuario -->
                <?= $form->field($model, 'username')->textInput([
                    'autofocus' => true,
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
