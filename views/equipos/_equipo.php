<?php

/* @var $model app\models\Equipos */

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

<!-- Tableros -->
<?php if (!empty($tableros->query->all())): ?>
    <div class='row'>
        <?= ListView::widget([
            'dataProvider'=>$tableros,
            'itemView'=>'_tablero',
            'summary'=>'',
        ]) ?>
    </div>
<?php endif; ?>

<?php $form = ActiveForm::begin([
    'options'=>['class'=>'form-inline'],
    'action'=>['equipos/index', 'id_equipo'=>$model->id],
]) ?>

    <?= $form->field($tableroCrear, 'denominacion')->textInput([
            'placeholder'=>'Añadir título del tablero',
        ])
        ->label(false)
    ?>
    <?= Html::submitButton('Crear tablero', ['class'=>'btn-xs btn-success']) ?>

<?php ActiveForm::end() ?>
<hr>
