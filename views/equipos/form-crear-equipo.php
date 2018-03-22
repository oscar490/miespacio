<?php
/* Formulario para la creación de un equipo */
/* @var $equipo app\models\Equipos */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>


<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($equipo, 'denominacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($equipo, 'descripcion')->textarea([
        'row'=>4,
    ]) ?>

    <?= Html::hiddenInput('usuario_id', Yii::$app->user->id) ?>

    <div class="form-group">
        <?= Html::submitButton('Crear equipo', ['class' => 'btn btn-success btn-block']) ?>
    </div>

<?php ActiveForm::end(); ?>
