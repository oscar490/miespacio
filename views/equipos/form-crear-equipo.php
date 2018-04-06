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
    $mostrar = true;
}

?>
<div class='row'>
    <div class='col-xs-12'>
        <?php $form = ActiveForm::begin([
            'action'=>$action_form,
            'enableAjaxValidation' => true,
        ]); ?>

            <?= $form->field($equipo, 'denominacion', ['enableAjaxValidation' => true])
                ->textInput(['maxlength' => true, 'autofocus'=>true]) ?>

            <?= $form->field($equipo, 'descripcion')->textarea([
                'rows'=>7,
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton( $label_boton, ['class' => 'btn btn-success btn-block']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
