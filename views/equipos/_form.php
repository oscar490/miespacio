<?php
/* Formulario para la creación de un equipo */

/* @var $equipo app\models\Equipos */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

if ($equipo->id !== null) {
    $action = ['equipos/update', 'id'=>$equipo->id];
    $label = 'Guardar configuración';
    $mostrar = true;
}
?>

<?php $form = ActiveForm::begin([
    'action'=>$action,
    'enableAjaxValidation' => true,
]); ?>

    <!-- Denominación  -->
    <?=
        $form->field(
            $equipo,
            'denominacion',
            ['enableAjaxValidation' => true]
        )
        ->textInput(['maxlength' => true])
    ?>

    <!-- Descripción -->
    <?=
        $form->field($equipo, 'descripcion')->textarea([
            'rows'=>3,
        ])
    ?>

    <div class="form-group">
        <?= Html::submitButton( $label, ['class' => 'btn btn-success btn-block']) ?>
    </div>

<?php ActiveForm::end(); ?>
