<?php
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;
use app\components\MyHelpers;



?>

<?php $form = ActiveForm::begin([
    'id'=>$id_form,
    'action'=>$action,
]) ?>

     <?= $form->field($model, $attribute)->widget(FileInput::className(), [
         'options'=>['accept'=>'image/*', 'id'=>$id_input],
         'pluginOptions'=>[
             'showUpload'=>$showUpload,
             'showPreview'=>$showPreview,
             'browseLabel'=>'',
             'browseIcon'=> '<i class="glyphicon glyphicon-picture"></i>',
         ],
     ]);
     ?>

    <?php /**
    <?php if (isset($tarjeta)): ?>
        <?= Html::hiddenInput('tarjeta_id', $tarjeta->id); ?>
    <?php endif; ?>
    **/ ?>

     <?= MyHelpers::submit($label, [
         'class'=>'btn btn-success btn-block',
         'id'=>$btn_id
     ]) ?>

<?php ActiveForm::end() ?>
