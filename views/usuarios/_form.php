<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */

?>

<!-- Formulario de registro de usuario nuevo -->
<div class="usuarios-create">
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <h4>
                        <span class='glyphicon glyphicon-registration-mark'>
                        </span>
                        <strong>
                            <?= Html::encode($this->title)?>
                        </strong>
                    </h4>
                </div>
                <div class='panel-body'>
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
        </div>
    </div>

</div>
