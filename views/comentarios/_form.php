<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comentarios-form">

    <?php $form = ActiveForm::begin([
        'action'=>['comentarios/create'],
        'id'=>"form_create_comentario_$tarjeta->id",
    ]); ?>

    <?= $form->field($model, 'contenido')
        ->textarea([
            'rows'=>5,
            'placeholder'=>'Escribe aqui tu comentario...',
        ])->label(false)
    ?>

    <?= Html::hiddenInput('tarjeta_id', $tarjeta->id) ?>

    <?= Html::hiddenInput('usuario_id', \Yii::$app->user->id) ?>


    <?=
        MyHelpers::submit(
            'Guardar',
            [
                'class'=>'btn btn-success',
                'id'=>'btn_add_comentario'
            ]
        );
    ?>

    <?php ActiveForm::end(); ?>

</div>
