<?php

/* @var $model app\models\Equipos */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Tableros;

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

<div class='row'>
    <?= ListView::widget([
        'dataProvider'=>$tableros,
        'itemView'=>'_tablero',
        'summary'=>'',
    ]) ?>
</div>
<hr>
