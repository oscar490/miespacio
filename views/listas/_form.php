<?php
/* Formulario de creación de lisa */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Listas */
/* @var $form yii\widgets\ActiveForm */



?>

<div class="listas-form">

    <?php $form = ActiveForm::begin([
        'action'=>$action,
        'enableAjaxValidation' => true,
        'id' => 'form_lista'
    ]); ?>


        <?= $form->field($model, 'denominacion', ['enableAjaxValidation' => true])
            ->textInput([
                'maxlength' => true,
                'placeholder'=>'Título de la lista'
            ])->label(false) ?>

        <?= Html::hiddenInput('tablero_id', $tablero->id) ?>

        <?=
            MyHelpers::submit('Añadir lista', [
                'class'=>'btn btn-success btn-block',
                'id'=>'btn_create_list'
            ]);
        ?>



    <?php ActiveForm::end(); ?>

</div>
