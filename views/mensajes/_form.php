<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\DatosUsuarios;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $nuevo_mensaje app\models\Mensajes */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="mensajes-form">

    <?php $form = ActiveForm::begin([
        'action'=>['mensajes/create'],
        'enableAjaxValidation'=>true,
    ]); ?>

    <?=
        $form->field($nuevo_mensaje, 'receptor', ['enableAjaxValidation' => true])
        ->widget(Select2::classname(), [
            'data'=>$datos,
            'options'=>[
                'placeholder'=>'Selecciona un usuario'
            ],
        ])->label(false);
    ?>

    <?=
        $form->field($nuevo_mensaje, 'asunto')
            ->textInput([
                'maxlength' => true,
                'placeholder'=>'Asunto',
                ])
            ->label(false)
    ?>

    <?=
        $form->field($nuevo_mensaje, 'contenido')
            ->textarea([
                'placeholder'=>'Escribe aqui...',
                'rows'=>7
            ])
            ->label(false)
    ?>

    <?= Html::hiddenInput('emisor', Yii::$app->user->id) ?>




    <div class="form-group">
        <?= Html::submitButton(
            MyHelpers::icon('glyphicon glyphicon-send')
                . ' ' . 'Enviar',
            ['class' => 'btn btn-success btn-block']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
