<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'action'=>$action,
    'enableAjaxValidation' => true,
    'id'=>$id
]); ?>

    <!-- Denominacioón de la tarjeta -->
    <?= $form->field($model, 'denominacion', ['enableAjaxValidation' => true,])
        ->textInput([
            'maxlength' => true,
            'placeholder'=>'Nombre de la tarjeta'
        ])->label(false)
    ?>

    <!-- Descripción de la tarjeta -->
    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, 'descripcion')->textarea([
            'rows'=>5,
            'placeholder'=>'Añadir una descripción más detallada'
        ])->label(false) ?>
    <?php endif; ?>

    <!-- ID de lista -->
    <?= Html::hiddenInput('lista_id', $lista->id) ?>


    <div class="form-group">
        <?=
            MyHelpers::submit($label,
                ['class'=>"btn btn-success btn-block"]
            );
        ?>
    </div>

<?php ActiveForm::end(); ?>
