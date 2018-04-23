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
        'action'=>['tarjetas/validate-ajax'],
        'enableAjaxValidation' => true,
        'id'=>"form_tarjeta_$lista->id"
    ]); ?>

        <div class='row'>
            <div class='col-md-4'>
                <?= $form->field($model, 'denominacion', ['enableAjaxValidation' => true,])
                    ->textInput([
                        'maxlength' => true,
                        'placeholder'=>'Nombre de la tarjeta'
                    ])->label(false)
                ?>
            </div>

            <?php if (!$model->isNewRecord): ?>
                <?= $form->field($model, 'descripcion')->textarea([
                    'rows'=>5
                ]) ?>
            <?php endif; ?>

            <?= Html::hiddenInput('lista_id', $lista->id) ?>

            <div class='col-md-2'>
                <div class="form-group">
                    <?=
                        MyHelpers::submit($label,
                            ['class'=>"btn btn-success"]
                        );
                    ?>
                </div>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
