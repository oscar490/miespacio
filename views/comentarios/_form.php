<?php
/* Formulario de creación y modificación de comenario */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */
/* @var $form yii\widgets\ActiveForm */

$enable = !$model->isNewRecord;
?>

<div class="comentarios-form">

    <?php $form = ActiveForm::begin([
        'action'=>$action,
        'id'=>$id_form,
        'enableAjaxValidation' => $enable,
    ]); ?>

    <?= $form->field($model, 'contenido', ['enableAjaxValidation' => $enable])
        ->textarea([
            'rows'=>5,
            'placeholder'=>'Escribe aqui tu comentario...',
        ])->label(false)
    ?>

    <?= Html::hiddenInput('tarjeta_id', $tarjeta->id) ?>

    <?= Html::hiddenInput('usuario_id', \Yii::$app->user->id) ?>


    <?php if ($model->isNewRecord): ?>
        <?=
            MyHelpers::submit(
                'Guardar',
                [
                    'class'=>'btn btn-success',
                    'id'=>'btn_add_comentario'
                ]
            );
        ?>

    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>
