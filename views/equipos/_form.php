<?php
/* Formulario para la creación de un equipo */

/* @var $equipo app\models\Equipos */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\MyHelpers;

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

    <!-- Propietario del equipo -->
    <?= Html::hiddenInput('propietario_id', Yii::$app->user->id); ?>

    <div class="form-group">
        <?=
            MyHelpers::submit($label, ['class'=>'btn btn-success btn-block']);
        ?>
    </div>

<?php ActiveForm::end(); ?>
