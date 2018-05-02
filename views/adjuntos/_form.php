<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Adjuntos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adjuntos-form">

    <?php $form = ActiveForm::begin([
        'action'=>$action,
        'enableAjaxValidation'=>true,
        'id'=>$id_form,
    ]); ?>

    <?=
        $form->field($model, 'nombre')->textInput([
            'maxlength' => true,
            'placeholder'=>'Nombre (opcional)'
        ])->label(false);
    ?>

    <?php if ($model->isNewRecord): ?>
        <?= $form->field($model, 'url_direccion', ['enableAjaxValidation'=>true,])->textInput([
            'maxlength' => true,
            'placeholder'=>'Pega un vínculo aqui...'
        ]) ?>
    

    <?php endif; ?>

    <?= Html::hiddenInput('tarjeta_id', $tarjeta->id) ?>

    <div class="form-group">
        <?= MyHelpers::submit($label, ['class'=>'btn btn-default btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
