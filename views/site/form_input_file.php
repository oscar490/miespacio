<?php
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;



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

     <?= Html::submitButton('Cambiar imágen',[
             'class'=>'btn btn-success btn-block',
             'id'=>$btn_id,
         ])
     ?>

<?php ActiveForm::end() ?>
