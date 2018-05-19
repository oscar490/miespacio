<?php
/* Formulario de tablero */
/* @var $equipos app\models\Equipos */
/* @var $tablero app\models\Tableros */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\MyHelpers;

$js = <<<EOT
    desactivarBotonForm($('#form_create_tablero'));
EOT;

$this->registerJs($js);

if ($tablero->isNewRecord) {
    $label = 'Crear tablero';
    $action = ['tableros/create'];
}

?>

<?php $form = ActiveForm::begin([
    'action'=>$action,
    'enableAjaxValidation' => true,
    'id'=>'form_create_tablero',
]); ?>

    <!-- Denominación -->
    <?= $form->field(
            $tablero,
            'denominacion',
            ['enableAjaxValidation' => true]
        )->textInput([
            'maxlength' => true,
            'placeholder'=>'Nombre del tablero'
        ])->label(false);
    ?>

    <!-- Tipo de visibilidad -->
    <?= Html::hiddenInput('visibilidad_id', 2) ?>

    <!-- Equipo -->
    <?php if (!isset($equipos)): ?>
        <?= Html::hiddenInput('equipo_id', $equipo->id) ?>

    <?php else: ?>
        <?=
            $form->field($tablero, 'equipo_id')->dropdownList([
                'Equipos'=>$equipos
            ])->label(false);
        ?>

    <?php endif; ?>

    <!-- Botón de submit -->
    <div class="form-group">
        <?= MyHelpers::submit($label, [
            'class' => 'btn btn-success btn-block'
        ]) ?>
    </div>

<?php ActiveForm::end(); ?>
