<?php
/* Formulario de tablero */
/* @var $equipos app\models\Equipos */
/* @var $tablero app\models\Tableros */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\MyHelpers;



if ($tablero->isNewRecord) {
    $label = 'Crear';
    $action = ['tableros/create'];
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

    <?php if (!isset($equipos)): ?>
        <?= Html::hiddenInput('equipo_id', $equipo->id) ?>

    <?php else: ?>
        <?=
            $form->field($tablero, 'equipo_id')->dropdownList([
                'Equipos'=>$equipos
            ]);
        ?>

    <?php endif; ?>

    <div class="form-group">
        <?= MyHelpers::submit($label, [
            'class' => 'btn btn-success btn-block'
        ]) ?>
    </div>

<?php ActiveForm::end(); ?>
