<?php
/* Formulario de tablero */
/* @var $equipos app\models\Equipos */
/* @var $tablero app\models\Tableros */

use yii\widgets\ActiveForm;
use yii\helpers\Html;


if ($tablero->isNewRecord) {
    $label = 'Crear';
    $mostrar = true;
    $action = ['tableros/create'];
} else {
    $label = 'Modificar';
    $mostrar = false;
    $action = ['tableros/update', 'id'=>$tablero->id];
}

?>

<?php $form = ActiveForm::begin([
    'action'=>$action,
    'enableAjaxValidation' => true,
]); ?>

    <?= $form->field(
            $tablero,
            'denominacion',
            ['enableAjaxValidation' => true]
        )->textInput(['maxlength' => true, 'placeholder'=>'Nombre del tablero']);
    ?>

    <?php if ($mostrar): ?>
        <?= Html::hiddenInput('equipo_id', $equipo->id) ?>

    <?php else: ?>
        <?=
            $form->field($tablero, 'equipo_id')->dropdownList([
                'Equipos'=>$equipos
            ]);
        ?>

    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($label, ['class' => 'btn btn-success btn-block']) ?>
    </div>

<?php ActiveForm::end(); ?>
