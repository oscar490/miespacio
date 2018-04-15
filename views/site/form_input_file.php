<?php
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;

if ($action === ['adjuntos/create']) {
    $label = 'Adjuntar';
    $class = 'btn btn-default btn-block';
} else {
    $label = 'Cambiar imágen';
    $class = 'btn btn-success btn-block';
}

?>

<?php $form = ActiveForm::begin([
    'id'=>"form_imagen_$id_form",
    'action'=>$action,
]) ?>

     <?= $form->field($model, $attribute)->widget(FileInput::className(), [
         'options'=>['accept'=>'image/*', 'id'=>$id_form],
         'pluginOptions'=>[
             'showUpload'=>$showUpload,
             'showPreview'=>$showPreview,
             'browseIcon'=> '<i class="glyphicon glyphicon-picture"></i>',
         ],
     ]);
     ?>

    <?php if (isset($tarjeta)): ?>
        <?= Html::hiddenInput('tarjeta_id', $tarjeta->id); ?>
    <?php endif; ?>

     <?= Html::submitButton($label,[
             'class'=>$class,
             'id'=>$btn_id,
         ])
     ?>

<?php ActiveForm::end() ?>
