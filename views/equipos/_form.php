<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipos-form">
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <?= Html::encode('Crear nuevo equipo') ?>
                </div>
                <div class='panel-body'>
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'denominacion')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'descripcion')->textarea([
                        'row'=>4,
                    ]) ?>

                    <?= Html::hiddenInput('usuario_id', Yii::$app->user->id) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Crear equipo', ['class' => 'btn btn-success btn-block']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
