<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="tarjetas-form">

    <?php $form = ActiveForm::begin([
        'action'=>$action,
        'enableAjaxValidation' => true,
        'id'=>"form_tarjeta_$model->id"
    ]); ?>

        <?= $form->field($model, 'denominacion', ['enableAjaxValidation' => true,])
            ->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'descripcion')->textarea([
            'rows'=>5
        ]) ?>

        <?= Html::hiddenInput('tablero_id', $tablero->id) ?>


        <div class="form-group">
            <?=
                MyHelpers::submit($label,
                    (!$model->isNewRecord) ?
                        ['id'=>"btn_tarjeta_$model->id"]: []
                );
            ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
