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
    $id = 'update_equipo';

} else {
    $id = 'create_equipo';
}

$js = <<<EOT
    bloquearSubmit($("#$id"));

EOT;

$this->registerJs($js);
?>

<?php $form = ActiveForm::begin([
    'action'=>$action,
    'enableAjaxValidation' => true,
    'id'=>$id,
]); ?>

    <!-- Denominación  -->
    <?=
        $form->field(
            $equipo,
            'denominacion',
            ['enableAjaxValidation' => true]
        )
        ->textInput([
            'maxlength' => true,
            'placeholder'=>'Nombre del equipo',
        ])->label(false);
    ?>

    <!-- Descripción -->
    <?=
        $form->field($equipo, 'descripcion')->textarea([
            'maxlength'=>true,
            'rows'=>4,
            'placeholder'=>'Descripción (opcional)'
        ])->label(false);
    ?>

    <!-- Propietario del equipo -->
    <?= Html::hiddenInput('propietario_id', Yii::$app->user->id); ?>

    <div class="form-group">
        <?=
            MyHelpers::submit($label, [
                'class'=>'btn btn-success btn-block',
                'id'=>'btn_create_equipo'
            ]);
        ?>
    </div>

<?php ActiveForm::end(); ?>
