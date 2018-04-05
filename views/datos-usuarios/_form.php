<?php
/* Formulario de datos de usuario */

/* @var $this yii\web\View */
/* @var $model app\models\DatosUsuarios */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

?>

<div class="datos-usuarios-form">

    <?php $form = ActiveForm::begin([
        'action'=>['datos-usuarios/update', 'id'=>$model->id],
    ]); ?>

        <?= $form->field($model, 'nombre_completo')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'descripcion')->textarea([
            'rows'=>5,
        ]) ?>

        <?= $form->field($model, 'avatar')->widget(FileInput::className(), [
            'options'=>['accept'=>'image/*'],
            'pluginOptions'=>[
                'showUpload'=>false,
                'browseIcon'=> '<i class="glyphicon glyphicon-picture"></i>',
            ],
        ]);
        ?>

        <div class="form-group">
            <?= Html::submitButton('Guardar perfil', [
                'class' => 'btn btn-success btn-block'
            ]) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
