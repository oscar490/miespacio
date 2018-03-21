<?php

/* @var $model app\models\Equipos */
/* @var $tableroCrear app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Tableros;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

$tableros = new ActiveDataProvider([
    'query'=>Tableros::find()
        ->where(['equipo_id'=>$model->id]),
]);
?>

<!-- Nombre del equipo -->
<?=
    Html::tag(
        'h4',
        Html::tag(
            'span',
            '',
            ['class'=>'glyphicon glyphicon-list-alt']
        ) . ' ' .
        Html::tag(
            'strong',
            $model->denominacion
        )
    );
?>
<br>

<!-- Tableros pertenecientes al equipo -->
<?php if (!empty($tableros->query->all())): ?>
    <div class='row'>
        <?= ListView::widget([
            'dataProvider'=>$tableros,
            'itemView'=>'_tablero',
            'summary'=>'',
        ]) ?>
    </div>
<?php endif; ?>

<!-- Formulario para crear tableros en un equipo -->
<?php Modal::begin([
    'header'=>'<h4>Crear un nuevo tablero</h4>',
    'toggleButton'=>[
        'label'=>'Crear un nuevo tablero',
        'class'=>'btn-md btn-success',
    ],
    'size'=>Modal::SIZE_SMALL,
]) ?>

    <?php $form = ActiveForm::begin([
        'action'=>[
            'equipos/gestionar-tableros',
            'id_equipo'=>$model->id
        ],
        'enableAjaxValidation' => true,
    ]) ?>

        <?= $form->field($tableroCrear, 'denominacion', [
            'enableAjaxValidation' => true
            ])->textInput(['placeholder'=>'Añadir título del tablero',])
                ->label(false)
        ?>
        
        <?= Html::submitButton('Crear tablero', [
            'class'=>'btn-xs btn-success',
        ]) ?>

    <?php ActiveForm::end() ?>

<?php Modal::end() ?>
<hr>
