<?php
/* Formulario de creación de lisa */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Listas */
/* @var $form yii\widgets\ActiveForm */

?>

<?php $form = ActiveForm::begin([
    'action'=>$action,
    'enableAjaxValidation' => true,
    'id' => $id_form_lista,
]); ?>

    <!-- Denominación -->
    <?= $form->field($model, 'denominacion', ['enableAjaxValidation' => true])
        ->textInput([
            'maxlength' => true,
            'placeholder'=>'Título de la lista'
        ])->label(false) ?>

    <!-- ID del Tablero -->
    <?= Html::hiddenInput('tablero_id', $tablero->id) ?>

    <!-- Botón de envio -->
    <?php if ($model->isNewRecord): ?>
        <?=
            MyHelpers::submit($label, [
                'class'=>'btn btn-success btn-block',
                'id'=>'btn_create_list'
            ]);
        ?>

    <?php endif; ?>

<?php ActiveForm::end(); ?>
