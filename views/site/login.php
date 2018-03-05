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

    <div class='row'>
        <div class='col-md-3 col-md-offset-4'>
            <h1>
                <strong>
                    <?= Html::encode($this->title) ?>
                </strong>
            </h1>
        </div>
    </div>



    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>
        <div class='row'>
            <div class='col-md-5 col-md-offset-3'>
                <?= $form->field($model, 'username')->textInput([
                    'autofocus' => true,
                    'placeholder'=>'p. ej.: alberto',
                ]) ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-5 col-md-offset-3'>
                <?= $form->field($model, 'password')->passwordInput([
                    'placeholder'=>'p. ej.: ·········',
                ]) ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-5 col-md-offset-3'>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
        </div>


        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <?= Html::submitButton('Iniciar sesión', [
                    'class' => 'btn btn-primary btn-block',
                    'name' => 'login-button'
                ]) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>


</div>
