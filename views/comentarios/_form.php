<?php
/* Formulario de creación y modificación de comenario */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */
/* @var $form yii\widgets\ActiveForm */

if ($model->isNewRecord) {
    $class_btn = 'btn btn-success';

} else {
    $class_btn = 'btn btn-sm btn-success';
}

?>

<div class="comentarios-form">

    <?php $form = ActiveForm::begin([
        'action'=>$action,
        'id'=>$id_form,
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
            $label,
            [
                'class'=>$class_btn,
                'id'=>$id_button,
            ]
        );
    ?>

    <?php ActiveForm::end(); ?>

</div>
