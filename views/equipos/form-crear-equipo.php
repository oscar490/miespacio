<?php
/* Formulario para la creación de un equipo */
/* @var $equipo app\models\Equipos */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

if ($equipo->id === null) {
    $action_form = ['equipos/create'];
    $label_boton = 'Crear equipo';
} else {
    $action_form = ['equipos/update', 'id'=>$equipo->id];
    $label_boton = 'Guardar configuración';
}

?>

<div class='form'>
    <?php $form = ActiveForm::begin([
        'action'=>$action_form,
        'enableAjaxValidation' => true,
    ]); ?>

        <?= $form->field($equipo, 'denominacion', ['enableAjaxValidation' => true])
            ->textInput(['maxlength' => true]) ?>

        <?= $form->field($equipo, 'descripcion')->textarea([
            'row'=>4,
        ]) ?>

        <?= $form->field($equipo, 'imagen')->fileinput() ?>

        <?= Html::hiddenInput('usuario_id', Yii::$app->user->id) ?>

        <div class="form-group">
            <?= Html::submitButton( $label_boton, ['class' => 'btn btn-success btn-block']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
