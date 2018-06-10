<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

$this->title = 'Iniciar sesión';
$this->params['breadcrumbs'][] = $this->title;

$js = <<<EOT

    $("#login-form").on('beforeSubmit', function() {
        $("#btn_login").attr('disabled', 'true');

        let imagen = $("<img>");
        imagen.attr('src', 'images/cargando.gif');
        imagen.addClass('logo-nav');

        $("#img_loading > .centrado").append(imagen);

    })

EOT;

$this->registerJs($js);

$this->registerJsFile(
    'js/google_login.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);
?>
<br>
<div class="site-login">
    <!-- Formulario de inicio de sesión -->
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='panel panel-primary'>
                <div class='panel-heading centrado'>
                    <?=
                        Html::tag(
                            'h3',
                            Html::img(
                                'images/logotipo.png',
                                ['class'=>'logo', 'alt'=>'logotipo']
                            ) .
                            Html::tag(
                                'strong',
                                $this->title
                            )
                        );
                    ?>
                </div>
                <div class='panel-body'>
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
                            ['site/solicitar-password'])
                        ?>

                        <!-- Recordar la sesión -->
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <!-- Iniciar sesión con Google -->
                        <div class='row'>
                            <div class='col-md-12 centrado'>
                                <div class="g-signin2" data-onsuccess="onSignIn"></div>
                            </div>
                        </div>
                        <br>
                        
                        <!-- Botón de envio de formulario -->
                        <div class='row'>
                            <div class='col-md-12'>
                                <?= Html::submitButton('Iniciar sesión', [
                                    'class' => 'btn btn-success btn-block',
                                    'name' => 'login-button',
                                    'id'=>'btn_login'
                                ]) ?>
                            </div>
                        </div>


                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Cargando login -->
    <div id='img_loading' class='row centrado'>
        <div class='col-md-5 centrado'>

        </div>
    </div>

</div>
